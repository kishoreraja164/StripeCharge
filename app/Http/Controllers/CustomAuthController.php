<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use DateTime;
//use App\Http\Traits\DataTrait;

class CustomAuthController extends Controller
{
	
	// Use Traits
	//use DataTrait;
	
    public function index(){
		return view('auth.login');
	}
	
	public function customLogin(Request $request){
			$request->validate([
				'email' => 'required',
				'password' => 'required',
			]);
			
			$credentials = $request->only('email','password');
			if(Auth::attempt($credentials)){
				return redirect()->intended('dashboard')
							->withSuccess('Signed in');
			}
			return redirect("login")->withSuccess('Not valid login details');
	}
	
	public function registration(){
		return view('auth.registration');
	}
	
	public function customRegistration(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'password' => 'required'
		]);
		$data = $request->all();
		$check = $this->create($data);
		return redirect("dashboard")->withSuccess('You have signed in');
	}
	
	public function create(array $data){
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password'])
		]);
	}
	
	public function dashboard(){
		if(Auth::check()){
			//$products = DB::table('products')->get();			
			//return view('auth.dashboard', ['products' => $products]);
			return view('auth.dashboard');
		}
		return redirect("login")->withSuccess('You are not signedin');
	}
	public function signOut(){
		Session::flush();
		Auth::logout();
		return Redirect('login');
	}
}
