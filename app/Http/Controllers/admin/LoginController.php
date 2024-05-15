<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(){
        return view('admin.login');
    }
    public function register(){
        return view('admin.register');
    }
    public function authenticate(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('admin.dashboard');
        }else{
            session()->flash('error','Please Enter Valid email & password');
            return redirect()->back();
        }
    }

        public function logout(){
             Auth::logout();
             session()->flash('success','Logout Successfully');
            return redirect()->route('admin.login');
        }
    //Register User
    public function registerUser(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'phone'=>'required|numeric|min:10',
            'address'=>'required',
            'password'=>'required|min:6'
        ]);
        if($validator->passes()){
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->address=$request->address;
            $user->password=Hash::make($request->password);
            $user->save();
            session()->flash('success','User Register Successfully');
            return response()->json([
                'status'=>true,
                'success'=>'Register Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'error'=>$validator->errors()
            ]);
        }
    }
}
