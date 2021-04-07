<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginSetupController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:tester,tester_officer,tester_manager,patient')->except('logout');
    }

    public function form_login() {
        return view('auth.pages.login');
    }

    public function filter_login(Request $request) {
        if ( ! in_array($request->login_as, ['tester','tester_officer','tester_manager','patient']))
         return redirect()->back()->withInput()->with('error', 'What re u doin?');
        if (auth()->guard($request->login_as)->attempt($request->only('username', 'password'))) {
            if(auth()->guard('tester')->user()){
                return redirect()->route('patient.index');
            }
            else if(auth()->guard('tester_officer')->user()){
                return redirect()->route('patient_test.export');
            }
            else if(auth()->guard('tester_manager')->user()){
                return redirect()->route('tester.index');
            }
            else{
                return redirect()->route('patient.history');
            }
            // return redirect()->route('dasboard.index');
        } else {
            return redirect()->back()->withInput()->with('error', 'Login Failed.');
        }
    }
    public function logout() {
        auth()->guard('tester')->logout();
        auth()->guard('tester_officer')->logout();
        auth()->guard('tester_manager')->logout();
        auth()->guard('patient')->logout();
        return redirect()->route('form_login');
    }
}
