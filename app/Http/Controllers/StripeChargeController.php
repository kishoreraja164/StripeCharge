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
	
	// Product price charge function
	public function charge(String $product, $price)
	{
		$user = Auth::user();
		return view('products.payment',[
			'user'=>$user,
			'amount' => $price,
            'currency' => 'usd',
			'intent' => $user->createSetupIntent(),
			'product' => $product,
			//'amount' => $price*100
		]);
	}
	
	// Product price charge payment process
	public function processPayment(Request $request, String $product, $price)
	{
		$user = Auth::user();
		$paymentMethod = $request->input('payment_method');
		$user->createOrGetStripeCustomer();
		$stripeCustomer = $user->asStripeCustomer();
		//echo'<pre>';print_r($stripeCustomer);exit;
		$user->addPaymentMethod($paymentMethod);
		try
		{
			$user->charge($price, $paymentMethod,['off_session' => true]);
		}
		catch (\Exception $e)
		{
			return back()->withErrors(['message' =>  $e->getMessage()]);
		}
		return redirect()->route('products')->withStatus('Payment has done successfully');

	}
}
