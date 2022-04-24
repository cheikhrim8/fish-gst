<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\PoissonsReception;
use App\Models\Reception;
use App\Models\Poisson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CartonController extends Controller
{
    private $module = 'cartons';
    public function index()
    {
        return view($this->module.'.index');

    }

    public function getDT()
    {

        $cartons = PoissonsReception::whereIn('reception_id',Reception::where('etat',5)->pluck('id'));
        return DataTables::of($cartons)
            ->addColumn('actions', function (PoissonsReception $pr) {
                $actions = collect();
                $actions->push([
                    'icon' => 'show',
                    'href' => "#!",
                    'onClick' => "openObjectModal(" . $pr->id . ",'cartons','','main','1','sm')",
                    'class' => '', 'title' => trans('visualiser')
                ]);
                return view('actions-btn', ["actions" => $actions])->render();
            })
            ->addColumn('poisson', function (PoissonsReception $pr) {

                return $pr->poisson->libelle;
            })
            ->rawColumns(['id', 'actions'])
            ->make(true);
    }

    public function formAdd()
    {
        return view($this->module.'.get');
    }
    public function get_stock_generaleDT(){
        $poisson  = Poisson::all()->reject(function ($poisson) {
                    return $poisson->get_sum_stock_global() <  1;
                })->map(function ($poisson) {
                    return $poisson;
                });
        return DataTables::of($poisson)
             ->addColumn('carton_stock', function (Poisson $poisson) {
                return $poisson->get_sum_stock_global();
            })
            ->make(true);
    }
    public function stock_generale(){
        return view($this->module.'.stock_generale');
    }
    public function add(Request $request)
    {
        $request->validate([
            'nb_carton' => 'required',
        ]);

        $reception_poisson = PoissonsReception::find($request->recep_poiss);
        if($request->nb_carton > ($reception_poisson->poid_reel/20) )
            return  response()->json(['error'=>["le nombre mis de carton depasse la quatite /20" ]],422); 
        $reception_poisson->nb_carton = $request->nb_carton;
        $reception_poisson->save();
        return response()
            ->json($reception_poisson->id, 200);
    }

    public function edit(Request $request): JsonResponse
    {
        $test_item = Test::find($request->id);

        $test_item->update([
            "title" => $request->input('title'),
            "description" => $request->input('description'),
        ]);

        return response()
            ->json('Done', 200);

    }

    public function get($id)
    {   
        return view($this->module.'.get',['reception_poisson'=> PoissonsReception::find($id)]);
    }

    public function getTab($id, $tab)
    {
        $test = Test::find($id);
        switch ($tab) {
            default :
                $parametres = [
                    'test' => $test,
                    'tests' => Test::all()
                ];
                break;
        }
        return view('test.tabs.tab' . $tab, $parametres);
    }

    public function delete($id)
    {
        $test = Test::destroy($id);

        return response()->json([
            'success' => 'true', 'msg' => trans('well deleted'),
        ], 200);


    }
}
