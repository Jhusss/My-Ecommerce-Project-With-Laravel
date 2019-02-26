<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use Auth;
use App\Cart;
use Session;
use App\Country;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function userLoginRegister() 
    {
        $categories = Category::get();
        return view('users.login-register', compact('categories'));
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email, 'password' => $request->password])){
            
            $userStatus = User::where('email', $request->email)->first();
            if($userStatus->status == 0){
                return back()->with('error', 'Your account is not activated yet. Please check your email.');
            }
            Session::put('frontSession', $request->email);

            if(!empty(Session::get('session_id'))){
                $session_id = Session::get('session_id');
                // Cart::where('session_id',$session_id)->update(['user_email'=>$request->email]);
                DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$request->email]);
            }
            return redirect('/cart');
        } else {
            return back()->with('error', 'Invalid username or password!');
        }
    } 
    public function register(Request $request)
    {
        if($request->isMethod('post')){
            
            $usersCount = User::where('email',$request->email)->count();
            if($usersCount>0){
                return back()->with('error','Email already exist!');
            } else {

                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();

                // //send register email
                // $email = $request->email;
                // $messageData = ['email' => $request->email, 'name' => $request->name];
                // Mail::send('emails.register',$messageData, function($message) use($email){
                //     $message->to($email)->subject('Registration with Ailoveyu International Website');

                // });
                

                //Send confirmation email
                $email = $request->email;
                $messageData = ['email' => $request->email, 'name' => $request->name,'code'=>base64_encode($request->email)];
                Mail::send('emails.confirmation',$messageData, function($message) use($email){
                    $message->to($email)->subject('Confirm your Ailoveyu International Account');

                });

                return back()->with('success', 'Please confirm your email to activate your account');

                if(Auth::attempt(['email'=>$request->email, 'password' => $request->password])){
                    Session::put('frontSession', $request->email);

                    if(!empty(Session::get('session_id'))){
                        $session_id = Session::get('session_id');
                        // Cart::where('session_id',$session_id)->update(['user_email'=>$request->email]);
                        DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$request->email]);
                    }
                    return redirect('/cart');
                }
            }
        }

        
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            // echo "<pre>"; print_r($request->all()); die;
            $userCount = User::where('email', $request->email)->count();
            if($userCount == 0){
                return back()->with('error', 'Email does not exist!');
            }
            $userDetails = User::where('email', $request->email)->first();

            //Generate Random password
            $random_password = str_random(8);

            //Encode/Secure Password
            $new_password = bcrypt($random_password);

            //Update Password
            User::where('email', $request->email)->update(['password'=>$new_password]);

            //Send Forgot Password Email Code
            $email = $request->email;
            $name = $userDetails->name;
            $messageData = [
                'email'=>$email,
                'name'=>$name,
                'password'=>$random_password
            ];

            Mail::send('emails.forgotpassword', $messageData, function($message)use($email){

                $message->to($email)->subject('New Password - Ailoveyu International Website');


            });

            return redirect()->route('login-register-user')->with('success', 'Successfully changed password, Please check your email');
        }
        $categories = Category::all();
        return view('users.forgot_password',compact('categories'));
    }

    public function confirmAccount($email)
    {
        $email = base64_decode($email);
        $userCount = User::where('email', $email)->count();
        if($userCount > 0){
            $userDetails = User::where('email', $email)->first();
            if($userDetails->status == 1){
                return redirect('login-register')->with('success', 'Your account is already activated. Login your account');
            }else {
                User::where('email', $email)->update(['status' => 1]);

                // Send Welcome email
                
                $messageData = ['email' => $email, 'name' => $userDetails->name];
                Mail::send('emails.welcome',$messageData, function($message) use($email){
                    $message->to($email)->subject('Welcome to Ailoveyu International!');

                });
                return redirect('login-register')->with('success', 'Your account has been activated. Login your account');
            } 
        } else {
            abort(404);
        }
    }
    public function logout() 
    {   
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    }

    public function account(Request $request){
        
        $userDetails = User::find(Auth::user()->id);
        
        if($request->isMethod('post')){

            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'country' => 'required',
                'mobile' => 'required'
            ]);

            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->country = $request->country;
            $user->pincode = $request->pincode;
            $user->mobile = $request->mobile;
            $user->save();

            return back()->with('success', 'Account details updated successfully');
        }
        

        $countries = Country::get();
        $categories = Category::get();
        return view('users.account',compact('categories','countries', 'userDetails'));
    }

    public function chkUserPassword(Request $request)
    {
        // $data = $request->all();
        // echo "<pre>"; print_r($data); die;    

        $current_password = $request->current_pwd;
        $check_password = User::where('id', Auth::user()->id)->first();

        if(Hash::check($current_password, $check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request)
    {
        $old_pwd = User::where('id', Auth::user()->id)->first();
        $current_pwd = $request->current_pwd;
        if(Hash::check($current_pwd, $old_pwd->password)){
            $new_pwd = bcrypt($request->new_pwd);
            User::where('id', Auth::user()->id)->update(['password' => $new_pwd]);

            return back()->with('success', 'Password updated successfully.');
       
        } else {
            return back()->with('error', 'Current password is incorrect.');
        }
    }

    public function checkEmail(Request $request)
    {            
            $usersCount = User::where('email',$request->email)->count();
            if($usersCount>0){
                echo "false";
            } else {
                echo "true";
            }

    }
}
