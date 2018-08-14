@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle')
	Inicio de sesión
@stop

{{-- Content --}}
@section('content')
	<div class="container-fluid">
		<div class="row">
			{{-- Login Form --}}
			<div class="col-md-5 offset-md-1">
				<candidate-login></candidate-login>
			</div>
		</div>
	</div>
@stop