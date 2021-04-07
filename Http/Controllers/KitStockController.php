<?php

namespace App\Http\Controllers;

use App\KitStock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KitStockController extends Controller
{
    public function __construct() {
        $this->middleware('IsManager');
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $data = KitStock::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           return '
                           <button class="btn btn-info btn-sm mr-1" onclick="modal_detail(\''.route('kit_stock.show', $data->id).'\', \'Detail data ' . $data->name . '\')"><i class="fa fa-fw fa-list"></i></button>

                           <a href="'.route('kit_stock.edit', $data->id).'" class="btn btn-warning btn-sm mr-1"><i class="fa fa-fw fa-edit"></i></a>

                           <button class="btn btn-danger btn-sm" onclick="confirm_delete(\''.route('kit_stock.destroy', $data->id).'\', \'Are you sure want to delete ' . $data->name . '?\')"><i class="fa fa-fw fa-trash"></i></button>
                            ';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('kit_stock.index');
    }

    public function store(Request $request) {
        $request->validate(
            [
                'code' => 'required',
                'name' => 'required',
                'stock' => 'required',
            ], [],
            [
                'code' => 'Code',
                'name' => 'Name',
                'stock' => 'Stock',
            ]);
        DB::beginTransaction();
        try{
            $kitStock = KitStock::create($request->all());
            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $kitStock->name . ' Added Successfully']]);
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error occurs']]);
        }
    }

    public function show(KitStock $kitStock) {
        return view('kit_stock.detail', ['data' => $kitStock]);
    }

    public function edit(KitStock $kitStock) {
        return view('kit_stock.edit', ['data' => $kitStock]);
    }

    public function update(Request $request, KitStock $kitStock) {
        $request->validate(
            [
                'code' => 'required',
                'name' => 'required',
                'stock' => 'required',
            ], [],
            [
                'code' => 'Code',
                'name' => 'Name',
                'stock' => 'Stock',
            ]);
        DB::beginTransaction();
        try{
            $kitStock->update($request->all());
            DB::commit();
            return redirect()->route('kit_stock.index')->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $kitStock->name . ' Updated Successfully']]);
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error occurs']]);
        }
    }

    public function destroy(KitStock $kitStock) {
        DB::beginTransaction();
        try{
            $kitStock->delete();
            DB::commit();
            session()->flash('msg', ['type' => 'success', 'msg' => 'Data ' . $kitStock->name . ' Deleted Successfully']);
            return responseApi(200, route('kit_stock.index'), 'ok');
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Terjadi kesalahan tidak terduga']]);
        }
    }
}
