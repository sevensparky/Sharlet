@extends('layouts.default')
@section('content')
    
<div class="jumbotron mt-4">
    <div class="container">
        <h1 class="display-4 font-weight-bold">Welcome to FaceBook </h1>
        <p class="lead">Welcome to the premier palce to talk about Laravel with others. </p>
        <p class="lead">Why don't you sing up to see what all the fuss is about?</p>
        <p class="lead">
            @guest
            <a class="btn btn-primary btn-md" href="{{ route('register') }}" role="button">Sign up!</a>
            @else            
            @endguest
        </p>
        
    </div>
</div>
@include('statuses.all')

@endsection