<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Products;

class StripeChargeController extends Controller
{
    // To list product details
	public function index(){
		//$data['products'] = Products::orderBy('id','desc')->paginate(5); 
		$data['products'] = Products::orderBy('id','desc')->get(); 
		return view('products.index', $data);
	}
	
	// Display the product detail with a Stripe credit card form
	public function paymentPage(){
		return view('products.payment');
	}
	
	public function charge(String $product, $price)
	{
		$user = Auth::user();
		return view('products.payment',[
			'user'=>$user,
			'intent' => $user->createSetupIntent(),
			'product' => $product,
			'price' => $price
		]);
	}
	
	public function processPayment(Request $request, String $product, $price)
	{
		$user = Auth::user();
		$paymentMethod = $request->input('payment_method');
		$user->createOrGetStripeCustomer();
		$user->addPaymentMethod($paymentMethod);
		try
		{
			$user->charge($price*100, $paymentMethod);
		}
		catch (\Exception $e)
		{
			//echo "dadsasd";exit;
			return back()->withErrors(['message' =>  $e->getMessage()]);
		}
		return redirect('index');
	}
}
