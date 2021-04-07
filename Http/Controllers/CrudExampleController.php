<?php

namespace App\Http\Controllers;

use App\Models\Tingkat;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CrudExampleController extends Controller {
    // public function __construct() {
    //     $this->middleware('IsGuru');
    // }
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Tingkat::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           return '
                           <button class="btn btn-info btn-sm mr-1" onclick="modal_detail(\''.route('tingkat.show', $data->id).'\', \'Detail data ' . $data->nama . '\')"><i class="fa fa-fw fa-list"></i></button>

                           <a href="'.route('tingkat.edit', $data->id).'" class="btn btn-warning btn-sm mr-1"><i class="fa fa-fw fa-edit"></i></a>

                           <button class="btn btn-danger btn-sm" onclick="confirm_delete(\''.route('tingkat.destroy', $data->id).'\', \'Yakin ingin menghapus data ' . $data->nama . '?\')"><i class="fa fa-fw fa-trash"></i></button>
                            ';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('tingkat.index');
    }

    public function store(Request $request) {
        $request->validate(
            [
                'nama' => 'required',
            ], [],
            [
                'nama' => 'Nama',
            ]);
        DB::beginTransaction();
        try{
            $tingkat = Tingkat::create($request->all());
            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $tingkat->nama . ' berhasil ditambahkan']]);
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Terjadi kesalahan tidak terduga']]);
        }
    }

    public function show(Tingkat $tingkat) {
        return view('tingkat.detail', ['data' => $tingkat]);
    }

    public function edit(Tingkat $tingkat) {
        return view('tingkat.edit', ['data' => $tingkat]);
    }

    public function update(Request $request, Tingkat $tingkat) {
        $request->validate(
            [
                'nama' => 'required',
            ], [],
            [
                'nama' => 'Nama',
            ]);
        DB::beginTransaction();
        try{
            $tingkat->update($request->all());
            DB::commit();
            return redirect()->route('tingkat.index')->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $tingkat->nama . ' berhasil diperbaharui']]);
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Terjadi kesalahan tidak terduga']]);
        }
    }

    public function destroy(Tingkat $tingkat) {
        DB::beginTransaction();
        try{
            $tingkat->delete();
            DB::commit();
            session()->flash('msg', ['type' => 'success', 'msg' => 'Data ' . $tingkat->nama . ' berhasil dihapus']);
            return responseApi(200, route('tingkat.index'), 'ok');
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Terjadi kesalahan tidak terduga']]);
        }
    }
}
