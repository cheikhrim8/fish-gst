<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Tinele;
use App\Models\Chario;
use App\Models\CharioTinele;
use App\Models\Reception;
use App\Models\CharioReceptionPoisson;
use App\Models\PoissonsReception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TinelleController extends Controller
{
     private $module = 'tineles';
    public function index()
    {
        return view($this->module.'.index');
    }

    public function getDT($selected = 'all')
    {

        $tineles = Tinele::all();
        if ($selected != 'all')
            $tineles = Tinele::orderByRaw('id = ? desc', [$selected]);

        return DataTables::of($tineles)
            ->addColumn('actions', function (Tinele $tinele) {
                $actions = collect();
                $actions->push([
                    'icon' => 'show',
                    'href' => "#!",
                    'onClick' => "openObjectModal(" . $tinele->id . ",'tineles',
                    '#datatableshow','main', 1,'lg')",
                    'class' => '', 'title' => trans('text.visualiser')
                ]);
                if($tinele->charios->count())
                    $actions->push([
                        'icon' => 'file-pdf',
                        'href' => "#!",
                        'onClick' => "get_fichier_tinele_etat(" . $tinele->id . ")",
                        'class' => '', 'title' => trans('exporter')
                    ]);
                $actions->push([
                    'icon' => 'delete',
                    'href' => "#!",
                    'onClick' => "deleteObject('" . url("tineles/delete/" . $tinele->id) . "',
                    '" . __('text.confirm_suppression') . ' "element du tinele :"' . $tinele->libelle . "')",
                    'class' => '', 'title' => __('text.supprimer')
                ]);

                return view('actions-btn', ["actions" => $actions])->render();
            })
            ->setRowClass(function ($tinele) use ($selected) {
                return $tinele->id == $selected ? 'alert-success' : '';
            })
            ->rawColumns(['id', 'actions'])
            ->make(true);
    }

    public function formAdd()
    {
        return view($this->module .'.add');
    }

    public function add(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'nb_charios' => 'required'
        ]);

        $tinele = Tinele::create([
            "nom" => $request->nom,
            "nb_charo_place" => $request->nb_charios,
        ]);

//        dd($test->role);

        return response()
            ->json($tinele->id, 200);
    }

    public function edit(Request $request): JsonResponse
    {
        $tinele = Tinele::find($request->id);

        $tinele->update([
            "nom" => $request->nom,
            "nb_charios" => $request->nb_charios,
        ]);

        return response()
            ->json('Done', 200);

    }

    public function get($id)
    {
        $lib = trans('Info');

        $tinele = Tinele::find($id);
        $tablink = 'tineles/getTab/' . $id;
        $tabs = [
            '<i class="fa fa-info-circle"></i> ' . trans('info') => $tablink . '/1',
            '<i class="fa fa-list"></i> ' . trans('Ajouter des charios') => $tablink . '/2',
        ];

        $modal_title = '<span>' . __('Tinele') .
            '</span><strong>: ' . $tinele->nom . '</strong>';

        return view('tabs', [
            'tabs' => $tabs,
            'modal_title' => $modal_title,
            'numbre' => null
        ]);
    }

    public function getTab($id, $tab)
    {
        $tinele = Tinele::find($id);

        switch ($tab) {
            case 1:
                $parametres = [
                    'tinele' => $tinele,
                ];
            break;
            case 2:
                $charios = Chario::whereNotIn('id',CharioTinele::all()->pluck('chario_id'));
                $charios = $charios->whereIn('id',CharioReceptionPoisson::pluck('chario_id')); 
                $parametres = [
                    'tinele' => $tinele,
                    'charios'=>$charios->get(),
                ];
            break;
            default :
                $parametres = [
                    'tinele' => $tinele,
                ];
                break;
        }
        return view($this->module.'.tabs.tab' . $tab, $parametres);
    }

    public function delete($id)
    {
        $test = Tinele::destroy($id);

        return response()->json([
            'success' => 'true', 'msg' => trans('well deleted'),
        ], 200);


    }

    public function change_etat_reception_to_tinelle($charios){
       $pr =  PoissonsReception::whereIn('id',CharioReceptionPoisson::whereIn('chario_id',$charios)->pluck('poissons_reception_id'));

       foreach (Reception::whereIn('id',$pr->pluck('reception_id'))->get() as $reception) {
            $this->change_etat_reception($reception->id);
       }
    }

    public function add_charios_in_tinele(Request $request){
        $validated = $request->validate([
            'tinelle_id' => 'required',
            'chario.*' => 'required',
        ]);
        $tinele =  Tinele::find($request->tinelle_id);
        if($tinele->charios_tineles->count('chario_id') >=  $tinele->nb_charo_place){
            return  response()->json(['error'=>["le tinelle est saturee" ]],422); 
        }
        if(isset($request->chario))
            for ($i=0; $i < count($request->chario) ; $i++) { 
                $chariotinele = new CharioTinele;
                $chariotinele->tinele_id = $request->tinelle_id ;
                $chariotinele->chario_id = $request->chario[$i];
                $chariotinele->save();
            }
        $this->change_etat_reception_to_tinelle($request->chario);
        return response()->json($request->tinelle_id,200);
    }
        

    public function change_etat_reception($id_reception){
        $reception = Reception::find($id_reception);
        $receptionPoisson = PoissonsReception::where('reception_id', $id_reception)->pluck('id');
        if(!CharioReceptionPoisson::whereIn('poissons_reception_id',$receptionPoisson)->count()){
            $reception->etat = 4;
            $reception->save();
        }
    }
    public function dissociation_chario_of_tinelle($chario_id,$tinele_id){
        $chario = Chario::find($chario_id);
        $ct = CharioTinele::where(['chario_id'=>$chario_id, 'tinele_id'=>$tinele_id])->first();
        //vider les charios de poisson
        foreach (CharioReceptionPoisson::where('chario_id',$chario_id)->get() as  $v) {
            $v->forceDelete();
        }
        foreach ($chario->chario_reception_poissons as $crp)
        {
            $pr=$crp->poissons_reception;
            $crp->forceDelete();
            $this->change_etat_reception_to_carton($pr->reception_id);
        }


        $ct->forceDelete();
        return response()->json($tinele_id,200);
    }
    public function vider_tinelle($tinele_id){
        $ch_tinel = CharioTinele::where('tinele_id',$tinele_id);
        if($ch_tinel->count()){
            $crp =  PoissonsReception::whereIn('id', CharioReceptionPoisson::whereIn('chario_id',$ch_tinel->pluck('chario_id'))->pluck('poissons_reception_id')) ;
            //vider les charios de poisson
            foreach (CharioReceptionPoisson::whereIn('chario_id',$ch_tinel->pluck('chario_id'))->get() as  $v) {
                $v->forceDelete();
            }
            $receptions =  Reception::whereIn('id',$crp->pluck('reception_id'))->get();
            $this->change_etat_reception_to_carton($receptions);
            foreach(CharioTinele::where('tinele_id',$tinele_id)->get() as  $ct) {
                $ct->forceDelete();
            }
            return true;
        }
        return false;
    }

    public function change_etat_reception_to_carton($receptions){
        foreach ($receptions as $reception) {
            $reception->etat = 5;
            $reception->save();
        }
    }

    public function get_fichier_info_tinele($id_tnelle){
        $tinele = Tinele::find($id_tnelle);
        $charios =  $tinele->charios;
        $crp = CharioReceptionPoisson::whereIn('chario_id',$charios->pluck('id'));
         $receptions = Reception::whereIn('id',PoissonsReception::whereIn('id',$crp->pluck('poissons_reception_id'))->pluck('reception_id'));
         $tab = [];
        foreach ($receptions->get() as $key =>  $p) {
             array_push($tab , ['nom_prenom'=>$p->client->nom.' '.$p->client->prenom, 'rece'=>$p]) ;
        }
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
        $mpdf->SetAuthor('SIDGCT');
        $mpdf->SetTitle('' . $tinele->nom . '');
        $mpdf->SetSubject('' . $tinele->nom . '');
        $mpdf->SetFont('arial', '', 10);
        $mpdf->SetMargins(0, 0, 5, 0);
        $mpdf->SetFontSize('10px');
        // $mpdf->AddPage('P', 'A4');
        $mpdf->writeHTML(view($this->module.'.export.info_tinele', [
        'receptions' => $tab,"tunelle"=>Tinele::find($id_tnelle)])->render());

        $mpdf->Output();
    }

    

}
