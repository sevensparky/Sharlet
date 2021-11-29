@extends('layouts.layout')
@section('content')

@include('layouts.partials.nav')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="post-content">
              <img src="https://via.placeholder.com/400x150/FFB6C1/000000" alt="post-image" class="img-responsive post-image">
              <div class="post-container">
                <img src="{{ asset('default.png') }}" alt="user" class="profile-photo-md pull-left">
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="{{ route('user.profile', $status->user->name) }}" class="profile-link text-decoration-none text-white">{{ $status->user->name }}</a></h5>
                    @if ($user->id == auth()->id())                            
                    @else
                    @if(! auth()->user()->isFollowing($user))
                    <form action="{{ route('follow',[auth()->id(),$user->id]) }}"  method="post">
                      @csrf                           
                        <button type="submit" class="btn btn-primary">
                          Follow
                        </button>
                    </form>
                    @else
                    <form action="{{ route('unfollow',[auth()->id(),$user->id]) }}"  method="post">
                      @csrf
                        <button type="submit" class="btn btn-outline-primary">
                            UnFollow
                        </button>
                    </form>                            
                    @endif                            
                    @endif
                    <p class="text-muted">Published {{ $status->created_at->diffForHumans() }}</p>
                  </div>
                  <div class="reaction">
                    <a class="btn text-green"><i class="fa fa-thumbs-up"></i> 13</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>{{ $status->body }}</p>  
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-comment">
                    <img src="{{ asset('default.png') }}" alt="" class="profile-photo-sm">
                    <p><a href="timeline.html" class="profile-link">Diana </a><i class="em em-laughing"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                  </div>
                  <div class="post-comment">
                    <img src="{{ asset('default.png') }}" alt="" class="profile-photo-sm">
                    <input type="text" class="form-control" placeholder="Post a comment">
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('title','Status Page')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page.css') }}">
@endpush
