@extends('layouts.default')
@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Hello {{ auth()->user()->name }}!</h1>
        <h1 class="display-5">We are happy for you to join our team</h1>
        <p class="lead">You must activate your account before any activity</p>
    </div>
</div>

@endsection