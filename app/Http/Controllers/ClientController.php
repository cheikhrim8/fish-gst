<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Client;
use App\Models\Poisson;
use App\Models\Reception;
use App\Models\PoissonsReception;
use App\Models\Retire;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
class ClientController extends Controller
{
    private $module = 'clients';
    private $link = 'clients';
    public function index()
    {
        return view($this->module.'.index');
    }

    public function getDT($selected = 'all')
    {

        $clients = Client::all();
        if ($selected != 'all')
            $clients = Client::orderByRaw('id = ? desc', [$selected]);
        return DataTables::of($clients)
            ->addColumn('actions', function (Client $client) {
                $actions = collect();
                $actions->push([
                    'icon' => 'show',
                    'href' => "#!",
                    'onClick' => "openObjectModal(" . $client->id . ",'clients',
                    '#datatableshow','main', 1,'xl')",
                    'class' => '', 'title' => trans('text.visualiser')
                ]);
                $actions->push([
                    'icon' => 'delete',
                    'href' => "#!",
                    'onClick' => "deleteObject('" . url($this->module."/delete/" . $client->id) . "',
                    '" . __('text.confirm_suppression') . ' "client :"' . $client->nom . "')",
                    'class' => '', 'title' => __('text.supprimer')
                ]);
                return view('actions-btn', ["actions" => $actions])->render();
            })
            ->setRowClass(function ($testIem) use ($selected) {
                return $testIem->id == $selected ? 'alert-success' : '';
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
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required'
        ]);

        $client = Client::create([
            "nom" => $request->input('nom'),
            "prenom" => $request->input('prenom'),
            "tel" => $request->input('telephone'),
        ]);

        return response()
            ->json($client->id, 200);
    }

    public function edit(Request $request): JsonResponse
    {
        $client = Client::find($request->id);

        $client->update([
            "nom" => $request->input('nom'),
            "prenom" => $request->input('prenom'),
            "tel" => $request->input('telephone'),
        ]);
        return response()->json('Done', 200);
    }

    public function get($id)
    {
        $lib = trans('text.lib');

        $client = Client::find($id);
        $tablink = 'clients/getTab/' . $id;
        $tabs = [
            '<i class="fa fa-info-circle"></i> ' . trans('text.info') => $tablink . '/1',
            '<i class="fa fa-list"></i> ' . trans('Reception') => $tablink . '/2',
            '<i class="fa fa-list"></i> ' . trans('Mise en plat') => $tablink . '/3',
            '<i class="fa fa-list"></i> ' . trans('Etat client') => $tablink . '/4',
            '<i class="fa fa-list"></i> ' . trans('sortie') => $tablink . '/5',
            '<i class="fa fa-list"></i> ' . trans('etat stock generale') => $tablink . '/6',
            '<i class="fa fa-list"></i> ' . trans('transfere') => $tablink . '/7',
        ];

        $modal_title = '<span>' . __('Client') .
            '</span><strong>: ' . $client->nom . '</strong>';

        return view('tabs', [
            'tabs' => $tabs,
            'modal_title' => $modal_title,
            'numbre' => null
        ]);
    }

    public function getTab($id, $tab)
    {
        $client = Client::find($id);
        switch ($tab) {
            case 1:
                $parametres = ['client' => $client];
            break;
            case 2:
               $parametres = ['client' => $client];
            break;
            case 3:
               $parametres = ['client' => $client];
            break;
            case 4:
                // $client = Client::find($id_client);
                $receptions = $client->receptions->where('etat',5)->pluck('id');
                $stock_poisson = array();
                foreach (Poisson::all() as $key => $value) {
                     array_push($stock_poisson,["nom"=>$value->libelle , "stock"=>$value->get_sum_stock($receptions)]);
                 }
               $parametres = ['client' => $client,"stock_poisson"=>$stock_poisson];
            break;
            case 5:

                $parametres = ['client' => $client,'poissons'=>Poisson::all()];
            break;
            case 6:
                $parametres = ['client' => $client];
            break;
            case 7:
                $parametres = ['client' => $client];
            break;

            default :
                $parametres = ['client' => $client];
            break;
        }
        return view($this->module.'.tabs.tab' . $tab, $parametres);
    }

    public function delete($id)
    {
        $client = Client::destroy($id);

        return response()->json([
            'success' => 'true', 'msg' => trans('supprimer client'),
        ], 200);


    }

     public function get_form_add_detaill($client_id){
     return view('clients.ajax.add_reception',["client"=>Client::find($client_id) , "poissons"=>Poisson::whereNotIn('id', [5,6])->get() ]);
    }
    public  function add_detaille_receptions(Request $request){
        $this->validate($request,[
            'poisson.*' => 'required',
            'quatite.*' => 'required',
        ]);

        if(!isset($request->poisson))
            return response()->json(['error'=>['veuiller mettre des detaille pour nouvelle reception ']],422);
        $reception = new Reception;
        //$reception->etat = 1;
        $reception->client_id = $request->client_id;
        $reception->client_id = $request->client_id;
        $reception->date_reception = date("Y-m-d");
        $reception->save();
        for ($i=0; $i < count($request->poisson) ; $i++) {
           $poissons_reception =  new PoissonsReception;
           $poissons_reception->reception_id = $reception->id;
           $poissons_reception->poisson_id = $request->poisson[$i];
           $poissons_reception->poid = $request->quatite[$i];
           $poissons_reception->save();
        }
        $client_reception =  ["reception"=> $reception->id , "client"=>$request->client_id];
        return response()->json($client_reception,200);
    }

     public function get_detaille_reception($id_reception){
        return view('clients.ajax.liste_reception',["reception"=>Reception::find($id_reception) ,"poissons"=>Poisson::all() ]);
    }
    public function edit_reception(Request $request){
        //  $this->validate($request,[
        //     'poisson.*' => 'required',
        //     'quatite.*' => 'required',
        // ]);
        $array= ['',null];
        $reception = Reception::find($request->recep);

        foreach ($reception->poissons as $poisson) {
            if(in_array($request->get('poisson'.$poisson->id),$array) || in_array($request->get('quatite'.$poisson->id),$array) ){
                 return response()->json(['error'=>['veuiller ramlire tous les champs']],422);
            }
        }
        foreach($reception->poissons as $poisson) {
               $rp = PoissonsReception::where(['poisson_id'=>$poisson->id,'reception_id'=>$reception->id])->first();
               if($rp){
                $rp->poid = $request->get('quatite'.$poisson->id);
                $rp->save();
               }


                // PoissonsReception::updateOrCreate(['poisson_id'=>$poisson->id,'reception_id'=>$reception->id],['poid'=>$request->get('quatite'.$poisson->id)]) ;

        }
        if(isset($request->poisson))
            for ($i=0; $i < count($request->poisson) ; $i++) {
               $poisson_reception =  new PoissonsReception;

               $poisson_reception->reception_id = $reception->id;
               $poisson_reception->poisson_id = $request->poisson[$i];
               $poisson_reception->poid = $request->quatite[$i];
               $poisson_reception->save();
            }
        $client_reception =  ["reception"=> $reception->id , "client"=>$reception->client->id];
        return response()->json($client_reception,200);
    }
     public function get_reception_pdf($reception_id){
        $reception = Reception::find($reception_id);
        $code =  $this->last_code($reception->id);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
        $mpdf->SetAuthor('SIDGCT');
        $mpdf->SetTitle('');
        $mpdf->SetSubject('');
        $mpdf->SetFont('arial', '', 10);
        $mpdf->SetMargins(0, 0, 5, 0);
        $mpdf->SetFontSize('10px');
        $mpdf->AddPage('P', 'A4');
        $mpdf->writeHTML(view('clients.export.reception_pdf',[
        'reception' => $reception,
        'client' => $reception->client,
        'code' => $code
        ])->render());
        return $mpdf->Output();
    }

    public function last_code($id_model)
    {
        $date_now_year = Carbon::now()->year;
        $date_now_year1 = substr($date_now_year, -2);
        if ($id_model > 1) {
                //dd($i);
                if ($id_model < 10) {
                    $num = '00000' . $id_model;
                    $num_recu = "$num/$date_now_year";
                } elseif ($id_model >= 10 and $id_model < 100) {
                    $num = '0000' . $id_model;
                    $num_recu = "$num/$date_now_year";
                } elseif ($id_model >= 100 and $id_model < 1000) {
                    $num = '000' . $id_model;
                    $num_recu = "$num/$date_now_year";
                } elseif ($id_model >= 1000 and $id_model < 10000) {
                    $num = '00' . $id_model;
                    $num_recu = "$num/$date_now_year";
                } elseif ($id_model >= 10000 and $id_model < 100000) {
                    $num = '0' . $id_model;
                    $num_recu = "$num/$date_now_year";
                } else {
                    $num = $id_model;
                    $num_recu = "$date_now_year/$num";
                }



        } else {

            $num = '000001';
            $num_recu = "$num/$date_now_year";
        }
        return $num_recu;
    }
    public function ajouter_traitement($id_reception){
        $reception = Reception::find($id_reception);
        return view('clients.ajax.traitement_poisson',["reception"=>$reception]);
    }
    public function delete_detaille_reception($poisson_id,$reception_id){
        $pr = PoissonsReception::where(['reception_id'=>$reception_id,'poisson_id'=>$poisson_id])->first();
        return $pr->forceDelete();
    }

    public function edit_reception_traitement(Request $request){
        // $this->validate($request,[
        //     'recep_tr'=>'required',
        //     'quatite.*'=>'required',
        // ]);
        $reception = Reception::find($request->recep_tr);
        //dd($reception)
        $array = [0,'',null];
        foreach ($reception->poissons as $poisson) {
            if(in_array($request->get('quatite'.$poisson->id),$array))
               return response()->json(['error'=>['veuillez remplire tous le formulaire']],422);
           else{
              if($request->get('quatite'.$poisson->id) >  $poisson->pivot->poid)
                return response()->json(['error'=>["l'un des quantités reél est superieur aux quatité total"]],422);
           }
        }
        foreach ($reception->poissons as $poisson) {
            $pr = PoissonsReception::where(['reception_id'=>$reception->id,'poisson_id'=>$poisson->id])->first();
            if($pr){
                $pr->poid_reel = $request->get('quatite'.$poisson->id);
                $pr->save();
            }
        }
        $reception->etat = 2;
        $reception->save();
        return response()->json($reception->id,200);
    }

    public function get_pdf_traitement($reception){

        $reception = Reception::find($reception);
        $code = $this->last_code($reception->id);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetAuthor('SIDGCT');
        $mpdf->SetTitle('');
        $mpdf->SetSubject('');
        $mpdf->SetFont('arial', '', 10);
        $mpdf->SetMargins(0, 0, 5, 0);
        $mpdf->SetFontSize('10px');
        $mpdf->AddPage('P', 'A5');
        $mpdf->writeHTML(view('clients.export.traitement_reception_pdf',[
        'reception' => $reception,
        'code' => $code
      ])->render());
        $mpdf->Output();
      return $pdf->stream();
    }
     public function get_fiche_stock_client($id_client){
        $client = Client::find($id_client);
        $receptions = $client->receptions->where('etat',5)->pluck('id');
        $tab = array();
        foreach (Poisson::all() as $key => $value) {
             array_push($tab,["nom"=>$value->libelle , "stock"=>$value->get_sum_stock($receptions)]);
         }

         $now =date('Y-m-d');

         $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $mpdf->SetAuthor('SIDGCT');
        $mpdf->SetTitle('');
        $mpdf->SetSubject('');
        $mpdf->SetFont('arial', '', 10);
        $mpdf->SetMargins(0, 0, 5, 0);
        $mpdf->SetFontSize('10px');
        $mpdf->AddPage('P', 'A4');
        // $mpdf->AddPage('P', 'A4');
        $mpdf->writeHTML(view($this->module.'.export.stock_client', ["stocks"=>$tab,
        'client'=>$client,
        'now'=>$now])->render());
        $mpdf->Output();

    }

       public function retirer_carton(Request $request){

        $array = ['',null];

        $client =  Client::find($request->cl_id);
        foreach (Poisson::all() as $key => $poisson) {
            if(!in_array($request->get('nb_c'.$poisson->id) , $array )) {

                $get_nb =  $poisson->get_stock_client_global($client->id);
                    if($request->get('nb_c'.$poisson->id) > $get_nb)
                       return  response()->json(['error'=>["cette quantite pour ce poisson  ".$poisson->libelle ." depasse la quanite stock" ]],422);
            }
        }
        $tab = array() ;
        $i = 0;
        foreach (Poisson::all() as $key => $poisson) {
            if(!in_array($request->get('nb_c'.$poisson->id) , $array )) {
                $get_nb =  $poisson->get_stock_client_global($client->id);
                $retire = new Retire;
                $retire->nb_carton = $request->get('nb_c'.$poisson->id);
                $retire->client_id = $client->id;
                $retire->poisson_id = $poisson->id;
                $retire->save();
                 array_push($tab,$retire->id);
                $i++;
            }
        }

        return $tab;
    }

    public function get_bon_sortie($id_retire){
        $ids =  explode(',', $id_retire);
        $retire = Retire::find($ids[0]);
        $code = $this->last_code($retire->id);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',]);
        $mpdf->SetAuthor('SIDGCT');
        $mpdf->SetTitle('');
        $mpdf->SetSubject('');
        $mpdf->SetFont('arial', '', 10);
        $mpdf->SetMargins(0, 0, 5, 0);
        $mpdf->SetFontSize('10px');
        $mpdf->AddPage('P', 'A5');
        $mpdf->writeHTML(view($this->module.'.export.retire', ['retires' => Retire::whereIn('id',$ids)->get() , 'retire'=>$retire,'code'=>$code])->render());
        $mpdf->Output();
      //   $pdf = PDF_html::loadView('fichier_pdf.retire',[
      //   'retires' => Retire::whereIn('id',$ids)->get() , 'retire'=>$retire,'code'=>$code
      //   ]);
      // return $pdf->stream();
    }
}



