<?php

namespace App\Http\Controllers;

use App\Tester;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TesterController extends Controller
{
    public function __construct() {
        $this->middleware('IsManager');
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Tester::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           return '
                           <button class="btn btn-info btn-sm mr-1" onclick="modal_detail(\''.route('tester.show', $data->id).'\', \'Detail data ' . $data->name . '\')"><i class="fa fa-fw fa-list"></i></button>

                           <a href="'.route('tester.edit', $data->id).'" class="btn btn-warning btn-sm mr-1"><i class="fa fa-fw fa-edit"></i></a>

                           <button class="btn btn-danger btn-sm" onclick="confirm_delete(\''.route('tester.destroy', $data->id).'\', \'Are you sure want to delete ' . $data->name . '?\')"><i class="fa fa-fw fa-trash"></i></button>
                            ';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('tester.index');
    }

    public function store(Request $request) {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'name' => 'required',
            ], [],
            [
                'username' => 'Username',
                'password' => 'Password',
                'password_confirmation' => 'Confirm Password',
                'name' => 'Name',
            ]);
        DB::beginTransaction();
        try{
            $tester = Tester::create($request->all());
            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $tester->name . ' Added Successfully']]);
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error occurs']]);
        }
    }

    public function show(Tester $tester) {
        return view('tester.detail', ['data' => $tester]);
    }

    public function edit(Tester $tester) {
        return view('tester.edit', ['data' => $tester]);
    }

    public function update(Request $request, Tester $tester) {
        $request->validate(
            [
                'username' => 'required',
                'name' => 'required',
            ], [],
            [
                'username' => 'Username',
                'name' => 'Name',
            ]);
        if($request->password || $request->password_confirmation){
            $request->validate(
                [
                    'password' => 'required|confirmed',
                    'password_confirmation' => 'required',
                ], [],
                [
                    'password' => 'Password',
                    'password_confirmation' => 'Confirm Password',
                ]);
        }
        DB::beginTransaction();
        try{
            if($request->password || $request->password_confirmation){
                $tester->update($request->all());
            }else{
                $tester->update($request->except(['password']));
            }
            DB::commit();
            return redirect()->route('tester.index')->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $tester->name . ' Updated Successfully']]);
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error occurs']]);
        }
    }

    public function destroy(Tester $tester) {
        DB::beginTransaction();
        try{
            $tester->delete();
            DB::commit();
            session()->flash('msg', ['type' => 'success', 'msg' => 'Data ' . $tester->name . ' Deleted Successfully']);
            return responseApi(200, route('tester.index'), 'ok');
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Terjadi kesalahan tidak terduga']]);
        }
    }
}
