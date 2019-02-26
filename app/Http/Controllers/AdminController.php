<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if($request->isMethod('post')){
        $adminCount = Admin::where(['username' => $request->username, 'password' => md5($request->password), 'role_id' => 1])->count();
            // if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 1])){
            if($adminCount > 0){
                Session::put('adminSession', $request->username);
                return redirect('/admin/dashboard');
            } else { 
                return back()->with('error', 'Invalid username or password!');
            }

        }
        
        return view('admin.admin_login');
    }

    public function dashboard(){

        // if(Session::has('adminSession')){
        
        // }else {
            return view('admin.index');
        // }
        
    }

    public function logout()
    {
        Session::forget('adminSession');
        return redirect()->route('admin')->with('success', 'Log out successfully!');
    }

    public function settings()
    {
        $adminDetails = Admin::where(['username' => Session::get('adminSession')])->first();
        return view('admin.settings');
    }

    public function chkPassword(Request $request)
    {
        // $current_password = $request->current_pwd;
        $adminCount = Admin::where(['username' => Session::get('adminSession'), 'password' => md5($request->current_pwd)])->count();
        if($adminCount == 1){
            echo "true"; die;
        }else {
            echo "false"; die;
        }
    }

    public function updatePassword (Request $request){
        if($request->isMethod('post')){

            $adminCount = Admin::where(['username' => Session::get('adminSession'), 'password' => md5($request->current_pwd)])->count();
    
            if($adminCount == 1){
                // if($request->new_pwd != $request->confirm_pwd){

                //     return back()->with('error', 'New password do not match!');

                // }else {
                    $password = md5($request->new_pwd);
                    Admin::where('username', Session::get('adminSession'))->update(['password' => $password]);
    
                    return back()->with('success', 'Password updated successfully!');
                } else{
                return back()->with('error', 'Invalid current password!');
            }
        }
    
    }
}
