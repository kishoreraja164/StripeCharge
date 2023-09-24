<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>StripeCharge</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
<div class="container">
<a class="navbar-brand mr-auto" href="#">Stripe Charge</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
@guest
<li class="nav-item">
<a class="nav-link" href="{{ route('login') }}">Login</a>
</li>
<li class="nav-item">
<a class="nav-link" href="{{ route('register-user') }}">Register</a>
</li>
@else
<li class="nav-item">
<a class="nav-link" href="{{ route('signout') }}">Logout</a>
</li>
@endguest
</ul>
</div>
</div>
</nav>
@yield('content')
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">

@if(session('status'))
	<div class="alert alert-success mb-1 mt-1">
		{{ session('status') }}
	</div>
@endif


<h2>StripeCharge - List Products</h2>
</div>
</div>
</div>

<div>
<h3>List Products</h3>

<table class="table table-bordered">
<tr>
<th>S.No</th>
<th>Name</th>
<th>Price</th>
<th>Action</th>
</tr>
@foreach($products as $key=>$product)
<tr>
	<td>{{ $key+1 }}</td>
	<td>{{ $product->name }}</td>
	<td>{{ $product->price }}</td>
	<td> 
	<a href="{{route('goToPayment', [ $product->name, $product->price ])}}"><button>Buy Now</button></a> &nbsp;
	</td>
</tr>
@endforeach
</table>

</div>
