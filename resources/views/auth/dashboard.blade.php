<!DOCTYPE html>
<html>
<head>
<title>Stripe Charge</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
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
			<div class="pull-left mb-2">
				<h2>Welcome to Stripe Charge</h2>
			</div>
		<div class="pull-right">
		</div>
		</div>
	</div>
<a class="nav-link" href="{{ route('products') }}">Click here to List Products</a>

<script type="text/javascript"> 
function addNode() { 
	var newP = document.createElement("p"); 
	var textNode = document.createTextNode("This is a new text node"); 
	newP.appendChild(textNode); document.getElementById("firstP").appendChild('newP'); 
} 
</script> 
</body>
</html>