@extends('layouts.default')
@section('content')

<div class="row">

    <div class="col-6 offset-3">
        <h4>Latest Statuses</h4>
        @foreach ($userFollowings->followings as $follow)
            @foreach ($follow->statuses as $status)        
        <div class="card bg-light mb-3">
            <div class="card-body">
                <p class="card-text"><a class="text-decoration-none text-body" href="{{ route('status.page',[ $status->id, $status->user->name ]) }}">{{ \Str::limit($status->body,30) }}</a></p>
                <h6 class="card-title">by: <a class="text-decoration-none text-body" href="{{ route('user.profile', $status->user->name) }}">{{ $status->user->name }}</a></h6>
            </div>
            <div class="card-footer">
                <small class="card-title float-right">Share on: {{ $status->created_at->diffForHumans() }}</small>
            </div>
        </div>
            @endforeach
        @endforeach
    </div>
</div>

@endsection