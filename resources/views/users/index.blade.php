@extends('layouts.default')
@section('content')

<div class="row">

    @foreach ($users as $user)
    <div class="col-3 mb-4">
        <div class="card text-center" style="width: 12rem;border: none">
            <div class="card-body">
              <p class="card-text"><div class="user" @if($user->image != null) style="background-image: url('{{ imageProfilePath($user->image) }}')" @else style="background-image: url('{{ asset('default.png') }}')" @endif></div></p>
              <a href="{{ route('user.profile',$user->name) }}" class="card-title text-decoration-none text-body">{{ $user->name }}</a>
            </div>
        </div>
    </div>
    @endforeach
    
</div>

@endsection