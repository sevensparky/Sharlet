@extends('layouts.default')
@section('content')

<div class="jumbotron mt-4">
    <div class="container">
        <h1 class="display-4 font-weight-bold">Welcome to FaceBook </h1>
        <p class="lead">Welcome to the premier palce to talk about with other users. </p>
        <p class="lead">Why don't you sing up to see what all the fuss is about?</p>
        <p class="lead">
          @guest
            <a class="btn btn-primary btn-md" href="{{ route('register') }}" role="button">Sign up!</a>
          @else
          @endguest
        </p>
    </div>
</div>
<div class="row">

    <div class="col-10 offset-1">
        <h4>Latest Statuses</h4>

         @foreach ($statuses as $status)
         <div class="card mb-3" >
            <div class="row no-gutters">
              <div class="col-md-2">
                @if ($status->user->image != null)
                <img src="{{ imageProfilePath($status->user->image) }}" alt="{{ $status->user->name }}" class="rounded-circle img-avatar" width="64" height="64">
                @else
                <img src="{{ asset('default.png') }}" alt="{{ $status->user->name }}" class="rounded-circle img-avatar" width="64" height="64">
                @endif
              </div>
              <div class="col-md-10">
                <div class="card-body">
                  <h6 class="card-title">by: <a class="text-decoration-none text-body" href="{{ route('user.profile', $status->user->name) }}">{{ $status->user->name }}</a></h6>
                  <p class="card-text">
                      <a class="text-decoration-none text-body" href="{{ route('status.page',[ $status->id, $status->user->name ]) }}">{!! \Str::limit($status->body,30) !!}</a>
                  </p>
                  <p class="card-text"><small class="text-muted">Likes: {{ likeNumbers($status) }}</small></p>
                </div>
                <div class="card-footer">
                    <small class="card-title float-right">Share on: {{ $status->created_at->diffForHumans() }}</small>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          {{ $statuses->links() }}
    </div>
</div>

@endsection
