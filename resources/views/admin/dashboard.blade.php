@extends('admin.layouts.app')
@include('admin.parts.nav')

@section('content')
	<div class="container">
		<div class="row justify-content-center text-info">
			<h1>Hi, {{ Auth::user()->email }} (:</h1>
		</div>
	</div>
@endsection
