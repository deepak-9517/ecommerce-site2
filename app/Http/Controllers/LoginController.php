<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('user.login');
    }

    public function authenticate(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('home');
        }else{
            session()->flash('error','Please Enter Valid email & password');
            return redirect()->back();
        }
    }

    public function register(){
        return view('user.register');
    }

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

    // this is logout function

    public function logout(){
        Auth::logout();
        session()->flash('success','Logout Successfully');
       return redirect()->route('home');
   }
}
