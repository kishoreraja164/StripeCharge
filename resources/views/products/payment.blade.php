<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Stripe credit card form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Stripe Credit Card Form</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="{{ route('products') }}"> Back</a>
</div>
</div>
</div>
<div>&nbsp</div>
@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<form action="{{route('processPayment', [$product, $amount])}}" method="POST" id="subscribe-form">
<div class="form-group">
	<div class="row">
		<div class="col-md-4">
				<label for="card-holder-name"><b>Product: </b></label>
				{{$product}}
		</div>
	</div>
</div>
<div class="form-group">
	<div class="row">
		<div class="col-md-4">
				<label for="plan-silver">
					<span class="plan-price"><b>Price:</b> {{$amount}}</span>
				</label>
		</div>
	</div>
</div>
<div class="form-group">
	<div class="row">
		<div class="col-md-4">
			<label for="card-holder-name"><b>Card Holder Name</b></label>
			<input id="card-holder-name" type="text" value="{{$user->name}}" disabled>
		</div>
	</div>
</div>
@csrf
<div class="form-group">
	<div class="row">
		<div class="col-md-4">
			<label for="card-element"><b>Credit card</b></label>
			<div id="card-element" class="form-control">   </div>
			<!-- Used to display form errors. -->
			<div id="card-errors" role="alert"></div>
		</div>
	</div>
</div>
<div class="stripe-errors"></div>
@if (count($errors) > 0)
	<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
		{{ $error }}<br>
		@endforeach
	</div>
@endif

<div class="form-group">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group text-center">
				<button type="button"  id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-success btn-block">SUBMIT</button>
			</div>
		</div>
	</div>
</div>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
	var stripe = Stripe('{{ env('STRIPE_KEY') }}');
	console.log(stripe);
	var elements = stripe.elements();
	var style = {
		base: {
		color: '#32325d',
		fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
		fontSmoothing: 'antialiased',
		fontSize: '16px',
		'::placeholder': {
		color: '#aab7c4'
		}
		},
		invalid: {
		color: '#fa755a',
		iconColor: '#fa755a'
		}
	};
	
	var card = elements.create('card', {hidePostalCode: true, style: style});
	card.mount('#card-element');
	console.log(document.getElementById('card-element'));
	
	card.addEventListener('change', function(event) {
	var displayError = document.getElementById('card-errors');
		if (event.error) {
			displayError.textContent = event.error.message;
		} else {
			displayError.textContent = '';
		}
	});
	
	const cardHolderName = document.getElementById('card-holder-name');
	const cardButton = document.getElementById('card-button');
	const clientSecret = cardButton.dataset.secret;   

	cardButton.addEventListener('click', async (e) => {
	
	const { setupIntent, error } = await stripe.confirmCardSetup(
		clientSecret, {
		payment_method: {
		card: card,
		billing_details: { name: cardHolderName.value }
		}
		}
	);       

	if (error) {
		var errorElement = document.getElementById('card-errors');
		errorElement.textContent = error.message;
	}
	else {
		paymentMethodHandler(setupIntent.payment_method);
	}
	});
	
	function paymentMethodHandler(payment_method) {
		var form = document.getElementById('subscribe-form');
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'payment_method');
		hiddenInput.setAttribute('value', payment_method);
		form.appendChild(hiddenInput);
		form.submit();
	}
</script>
</body>
</html>