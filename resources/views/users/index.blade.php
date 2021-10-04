@extends('layouts.default')
@section('content')

<div class="row">

    @foreach (\App\Models\User::all() as $user)
    <div class="col-3 mb-4">
        <div class="card text-center" style="width: 12rem;border: none">
            <div class="card-body">
              <p class="card-text"><div class="user three"></div></p>
              <a href="{{ route('user.profile',$user->name) }}" class="card-title">{{ $user->name }}</a>
            </div>
        </div>
    </div>
    @endforeach
    
</div>

@endsection