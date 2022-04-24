<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestController extends Controller
{
    public function index()
    {
        return view('test.index');
    }

    public function getDT($test, $selected = 'all')
    {

        $tests = Test::all();
        if ($selected != 'all')
            $tests = Test::orderByRaw('id = ? desc', [$selected]);

        return DataTables::of($tests)
            ->addColumn('actions', function (Test $test) {
                $actions = collect();
                $actions->push([
                    'icon' => 'show',
                    'href' => "#!",
                    'onClick' => "openObjectModal(" . $test->id . ",'tests',
                    '#datatableshow','main', 1,'lg')",
                    'class' => '', 'title' => trans('text.visualiser')
                ]);
                $actions->push([
                    'icon' => 'delete',
                    'href' => "#!",
                    'onClick' => "deleteObject('" . url("tests/delete/" . $test->id) . "',
                    '" . __('text.confirm_suppression') . ' "element du test :"' . $test->libelle . "')",
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
        return view('test' . '.add');
    }

    public function add(Request $request)
    {

//        dd($request->role);
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $test = Test::create([
            "title" => $request->input('title'),
            "description" => $request->input('description'),
        ]);

//        dd($test->role);

        return response()
            ->json($test->id, 200);
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
        $lib = trans('text.lib');

        $test = Test::find($id);
        $tablink = 'tests/getTab/' . $id;
        $tabs = [
            '<i class="fa fa-info-circle"></i> ' . trans('text.info') => $tablink . '/1',
            '<i class="fa fa-list"></i> ' . trans('test.children') => $tablink . '/2',
        ];

        $modal_title = '<span>' . __('Test') .
            '</span><strong>: ' . $test->title . '</strong>';

        return view('tabs', [
            'tabs' => $tabs,
            'modal_title' => $modal_title,
            'numbre' => null
        ]);
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
