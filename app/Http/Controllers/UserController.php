<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;
use Hash;
class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showLoginForm()
    {
      return view('login');
    }

    public function login(Request $request)
    {
      $validateData = $request->validate([
        'email' =>'required|email',
        'password' => 'required|min:6'
      ]);
      $email = $request->input('email');


      $password = $request->input('password');


        $user = DB::table('users')->where('email', $email)->first();

      if (Hash::check($password, $user->password)) {
            return redirect('/home');
      }
        return redirect('/');
    }



    public function register()
    {
      return view('register');
    }

    public function registerPost(Request $request)
    {
      $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

      $name = $request->input('name');
      $email = $request->input('email');
      $password = $request->input('password');

      $user = DB::table('users')->where('email', $email)->first();
      if($user){
        dd($user);
      }else{
        DB::table('users')->insert([
          ['name' => $name,
          'email' => $email,
          'password' =>Hash::make($password)]
        ]);
      }
      return view('login');

    }

    public function index()
    {
        return view('home');
    }
    

}
