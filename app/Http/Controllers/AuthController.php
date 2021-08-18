<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use DB;
use Auth;
use App\User;

class AuthController extends BaseController
{
	public function createRegister()
    {
      return view('web.register');
    }
    public function storeRegister(Request $request)
    {
        $info = $request->validate([
            'user_name' => 'required',
            'user_email' => 'required',
            'user_phone' => 'required',
            'user_password' => 'required',
        ]);
        $info['user_password'] = bcrypt($request->input('user_password'));
        $data = DB::table('tbl_user')->insert($info);
        if($data == 1)
        {
            return redirect()->route('register')->with('message','Registration Done Successfully');
        }else
        {
            return redirect('register')->with('error','Not Registered');
        }
    }
    public function createAuthenticate(Request $request)
    {	
        $request->validate([
            'user_phone' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('user_phone', 'password');

        if ($user = User::where('user_phone', request()->user_phone)->where('user_password', request()->password)->first()) {

            Auth::login($user);
            
             return redirect()->intended('/');
           
        }

        return redirect('front/login')->with('error', 'Oppes! You have entered invalid credentials');
    }
}