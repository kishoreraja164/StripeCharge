<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Company Form - Laravel 10 CRUD</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left mb-2">
<h2>Edit Company</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
</div>
</div>
</div>
<div>&nbsp</div>
@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif

<form action="{{ route('companies.update', $company->id) }}" method="POST">
@csrf
@method('PUT')
<div class="form-group mb-3">
<input type="text" placeholder="Company Name" id="company_name" class="form-control" name="company_name" value="{{ $company->company_name}}">
@if ($errors->has('company_name'))
<span class="text-danger">{{ $errors->first('company_name') }}</span>
@endif
</div>
<div class="d-grid mx-auto">
<button type="submit" class="btn btn-dark btn-block">Save</button>
<button type="cancel" class="btn btn-dark btn-block">Cancel</button>
</div>

</form>