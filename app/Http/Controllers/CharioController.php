<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Chario;
use App\Models\Client;
use App\Models\CharioReceptionPoisson;
use App\Models\PoissonsReception;
use App\Models\Reception;
use App\Models\CharioTinele;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class CharioController extends Controller
{
    private $module = 'charios';
    private $link = 'charios';
    public function index()
    {
        return view($this->module.'.index');
    }

    public function getDT($tinele ="all",$selected = 'all')
    {

        $Charios = Chario::all();
        if($tinele !="all")
            $Charios = $Charios->whereIn('id',CharioTinele::where('tinele_id',$tinele)->pluck('chario_id'));
        if ($selected != 'all')
            $Charios = Chario::orderByRaw('id = ? desc', [$selected]);
        return DataTables::of($Charios)
            ->addColumn('actions', function (Chario $chario) use ($tinele){
                $actions = collect();
                $actions->push([
                    'icon' => 'show',
                    'href' => "#!",
                    'onClick' => "openObjectModal(" . $chario->id . ",'charios',
                    '#datatableshow1','main', 1,'lg')",
                    'class' => '', 'title' => trans('text.visualiser')
                ]);
                if($tinele == "all")
                    $actions->push([
                        'icon' => 'delete',
                        'href' => "#!",
                        'onClick' => "deleteObject('" . url("charios/delete/" . $chario->id) . "',
                        '" . __('text.confirm_suppression') . ' "element du chario :"' . $chario->code . "')",
                        'class' => '', 'title' => ('text.supprimer')
                    ]);
                else{
                    $actions->push([
                        'icon' => 'delete',
                        'href' => "#!",
                        'onClick' => "deleteObjectCharioOftinele('" . url("tineles/dissociation_chario/" . $chario->id ."/".$tinele )."')",
                        'class' => '', 'title' => ('text.supprimer')
                    ]);
                }
                return view('actions-btn', ["actions" => $actions])->render();
            })
            ->addColumn('rest_plat_disponible', function (Chario $chario) {
                return $chario->rest_plat_disponible();
            })
            ->setRowClass(function ($chario) use ($selected) {
                return $chario->id == $selected ? 'alert-success' : '';
            })
            ->rawColumns(['id', 'actions'])
            ->make(true);
    }
    public function formAdd()
    {
        return view($this->module. '.add');
    }

    public function add(Request $request)
    {

        $request->validate([
            'code' => 'required|unique:charios,code',
            'nb_plat' => 'required'
        ]);
        $chario = new Chario();
        $chario->code = $request->code;
        $chario->nb_plat = $request->nb_plat;
        $chario->save();
        //$chario = Chario::create(["code" => $request->code,"nb_plat" => $request->nb_plat]);
        return response()
            ->json($chario->id, 200);
    }

    public function edit(Request $request): JsonResponse
    {
        $request->validate([
            'code' => 'required',
            'nb_plat' => 'required'
        ]);
        $chario = Chario::find($request->id);
        $chario->update([
            "code" => $request->input('code'),
            "nb_plat" => $request->input('nb_plat'),
        ]);

        return response()
            ->json('Done', 200);

    }

    public function get($id)
    {
        $lib = trans('text.lib');

        $chario = Chario::find($id);
        $tablink = 'charios/getTab/' . $id;
        $tabs = [
            '<i class="fa fa-info-circle"></i> ' . trans('text.info') => $tablink . '/1',
        ];

        $modal_title = '<span>' . __('Chario') .
            '</span><strong>: ' . $chario->code . '</strong>';

        return view('tabs', [
            'tabs' => $tabs,
            'modal_title' => $modal_title,
            'numbre' => null
        ]);
    }

    public function getTab($id, $tab)
    {
        $chario = Chario::find($id);

        switch ($tab) {
            default :
                $parametres = [
                    'chario' => $chario,
                ];
                break;
        }
        return view($this->module.'.tabs.tab' . $tab, $parametres);
    }

    public function delete($id)
    {
        $test = Test::destroy($id);

        return response()->json([
            'success' => 'true', 'msg' => trans('well deleted'),
        ], 200);


    }

    public function get_form_affecte_poissons(){
        return view($this->module. '.form_add_fish_in_chario',["clients"=>Client::whereIn('id',Reception::whereIn('etat',[2,3])->pluck('client_id'))->get()]);
    }
    public function get_receptions($id_client){
        $client = Client::find($id_client);
        $options = '';
        foreach ($client->receptions->whereIn('etat',[2,3]) as $reception) {
            $options .='<option value="'.$reception->id.'">'.$reception->id.') '.$reception->date_reception.'</option>';
        }
        $block = '<label for="reception_ids">Receptions <span class="required_field" data-toggle="tooltip" data-placement="right" title="obligatoire">*</span></label>
                    <select id="reception_ids" onchange="get_form_cp()" name="reception_ids" class="form-control selectpicker bordered"  title="Selectionner... "data-live-search="true"> 
                        '.$options.'
                    </select>';
        return $block ;
    }

    public function get_form_affecte_poisson($reception_id){
        $reception = Reception::find($reception_id);
        $data = collect();
        foreach ($reception->poissons_receptions as  $pr) {
            $p =  $pr->poisson;
            //$cpr = $pr->chario_reception_poissons;
            $charios = '';
            $nb_plat = '';
            if($pr->chario_reception_poissons->count())
                foreach ($pr->chario_reception_poissons as $cpr) {
                    $charios .=', '.$cpr->chario->code;
                    $nb_plat .= ', '.$cpr->nb_table;       
                }   
            $m =["id"=>$pr->id, 'poisson'=>$p->libelle, 'quatite'=>$pr->poid_reel, "charios"=>$charios , "nb_plat"=>$nb_plat ];
            $data->push($m);
        }
         return view($this->module.'.ajax.form_affecte_poisson_chario',["reception"=>$data]);
    }

    public function get_chario_disponible($reception_poisson_id){
        $charios  = Chario::all()->reject(function ($chario) {
                    return $chario->rest_plat_disponible() <  1;
                })->map(function ($chario) {
                    return $chario;
                });
        $pr = PoissonsReception::find($reception_poisson_id);
        $etat = false;

           $nb_plat_d =   CharioReceptionPoisson::where('poissons_reception_id',$reception_poisson_id)->sum('nb_table'); 
        if($nb_plat_d >= ($pr->poid_reel / 10) ) $etat = true;
        return view($this->module.'.get',["charios"=>$charios,"reception_poisson_id"=>$reception_poisson_id,"etat"=>$etat]);       
        // $options = '';
        // foreach ($charios as $chario) {
        //     $options .= '<option value="'.$chario->id.'">'.$chario->code.'</option>';
        // }
        // return  '<select id="chario_libre" onchange="get_nb_plat('.$reception_poisson_id.')" name="chario_libre[]" class="form-control selectpicker bordered"  multiple="multiple" title="Selectionner..." data-live-search="true">' 
        //     .$options.'</select>
        //     <br/>
        // <input type="number" onKeyup="printInputNbChario('.$reception_poisson_id.')" name="take_table" id="take_table'.$reception_poisson_id.'" class="form-control bordered">
        //         <button onclick="add_poisson_to_chario('.$reception_poisson_id.')" class="btn btn-primary btn-sm float-right pt-1 ">
        //             <i class="main-icon fas fa-save"></i>                  
        //             <span class="spinner-border spinner-border-sm" style="display:none" role="status" aria-hidden="true"></span>
        //             <i class="answers-well-saved text-success fa fa-check" style="display:none" aria-hidden="true"></i>
        //         </button>
        // <div id="nb_plat_"></div>';
    }
    public function get_nb_plat_disponible($chario_ids){
        $ids = explode(',', $chario_ids);
        $nb = 0;
        $tr = false;
        $chrios = '';
        foreach (Chario::whereIn('id',$ids)->get() as $ch){
                $nb +=  $ch->rest_plat_disponible();
                if($tr)
                   $chrios .= ','.$ch->code; 
               else
                   $chrios .= $ch->code; 
               $tr = true;
        }
        return ['NB charios: '.$nb , $chrios ] ;
    }

    public function verif_if_contenir($list_chario , $nb_plat){
        $nb = 0;
        foreach (Chario::whereIn('id' , $list_chario)->get() as $ch) {
            $nb +=  $ch->rest_plat_disponible();
        }
        if($nb >= $nb_plat )
            return true;
        else
            return false;
    }
    public function add_poisson_to_chario(Request $request){
        $request->validate([
            'chario_libre' => 'required',
            'nb_plat' => 'required'
        ]);
        if(!$this->verif_if_contenir($request->chario_libre , $request->nb_plat)) 
            return  response()->json(['error'=>["Les charios ne contient pas de place pour cette quantite" ]],422); 
        $nbp =  $request->nb_plat ;
        foreach (Chario::whereIn('id' , $request->chario_libre)->get() as $ch) {
            $nb_diponible = $ch->rest_plat_disponible();
            if($nbp -  $nb_diponible >= 0 ){
               $crp= new CharioReceptionPoisson();
               $crp->poissons_reception_id = $request->reception_poisson_id;
               $crp->chario_id = $ch->id;
               $crp->nb_table = $nb_diponible;
               $crp->save();
               $nbp -=  $nb_diponible;
               if($nbp==0)  break;
            }
            else
            {
                if($nbp -  $nb_diponible < 0){
                   $crp= new CharioReceptionPoisson();
                   $crp->poissons_reception_id = $request->reception_poisson_id;
                   $crp->chario_id = $ch->id;
                   $crp->nb_table = $nbp;
                   $crp->save();
                   $nbp =  0;
                   break;   
                }   
            }
        }
        $this->changer_etat_reception_chario($request->reception_poisson_id);
        return response()->json('Done', 200);
    }

    public function changer_etat_reception_chario($reception_poisson_id){
        $rp =  PoissonsReception::find($reception_poisson_id);
        $reception = $rp->reception;
        $poisson_receptions = $reception->poissons_receptions;
        $etat_reception = true;
        foreach ($poisson_receptions as $poi_rece) {
            if($poi_rece->chario_reception_poissons->sum('nb_table') < ($poi_rece->poid_reel/10)){
                $etat_reception = false;
                break;
            } 
        }
        if($etat_reception){
            $reception->etat = 3;
            $reception->save();
        }
    }

    public function get_info_chario_poisson($rp){
         $first = true;
          $charios = '';
          $nb_plat = CharioReceptionPoisson::where( 'poissons_reception_id',$rp)->sum('nb_table');
          foreach (CharioReceptionPoisson::where( 'poissons_reception_id',$rp)->get() as  $value) {
            if($first){
                $first = false;
              $charios .= $value->chario->code;
            }
            else
              $charios .= ','.$value->chario->code;

          }
          return view($this->module.'.ajax.info_poisson_chario',["charios"=>$charios , "nb_palt"=>$nb_plat]);
    }
    public function valider_reception_charios($reception){
        $reception =Reception::find($reception);
        $etat_poisson_chario = true;
        foreach ($reception->poissons_receptions as $rp) {
            if($rp->chario_reception_poissons->sum('nb_table') < ($rp->poid_reel/10)){
                $etat_poisson_chario = false;
                break;
            }
        }
        if($etat_poisson_chario){
            $reception->etat = 4;
            $reception->save();
            return response()->json([
                'success' => 'true', 'msg' => "l'etat de reception est valider",
            ], 200);
        }
             
        else
             return response()->json([
                'success' => 'false', 'msg' => "l'operation de l'afectaion n'est pas terminer ",
            ], 200);
    }
    public function get_fichier_info_charios(){
        // $tinele = Tinele::find($id_tnelle);
        // $charios =  $tinele->charios;
        $crp = CharioReceptionPoisson::whereIn('poissons_reception_id',
            PoissonsReception::whereIn('reception_id',Reception::whereIn('etat',[3,4])->pluck('id') )->pluck('id'));
        $charios = Chario::whereIn('id',$crp->pluck('chario_id'));
         $tab = [];
        foreach ($charios->get() as  $p) {
            $poissons = array();
             foreach ($p->chario_reception_poissons as  $value) {
                 array_push($poissons , ['nom_poisson'=>$value->poissons_reception->poisson->libelle, 'nb_plat'=>$value->nb_table]); 
             }
            array_push($tab , ['nom_chario'=>$p->code, 'poissons'=>$poissons]) ;
        }
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
        $mpdf->SetAuthor('SIDGCT');
        $mpdf->SetTitle('charios');
        $mpdf->SetSubject('charios');
        $mpdf->SetFont('arial', '', 10);
        $mpdf->SetMargins(0, 0, 5, 0);
        $mpdf->SetFontSize('10px');
        // $mpdf->AddPage('P', 'A4');
        $mpdf->writeHTML(view($this->module.'.export.info_chario', [
        'charios_info' => $tab])->render());

        $mpdf->Output();
    }
}
