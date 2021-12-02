@extends('layouts.layout')
@section('content')

@include('layouts.partials.nav')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto shadow">
            <div class="post-content">
              <img src="{{ asset('flower.jpg') }}" alt="post-image" class="img-responsive post-image">
              <div class="post-container">
                @if ($user->image != null)
                <img src="{{ imageProfilePath($user->image) }}" alt="{{ $user->name }}" class="profile-photo-md pull-left" >
                @else                        
                <img src="{{ asset('default.png') }}" alt="{{ $user->name }}" class="profile-photo-md pull-left">
                @endif
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="{{ route('user.profile', $status->user->name) }}" class="profile-link text-decoration-none text-body">{{ $status->user->name }}</a></h5>
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
                    
                    <form action="{{ route('increase.like', [$user, $status]) }}" method="post">
                      @csrf
                      <button type="submit" class="btn text-green"><i class="fa fa-thumbs-up"></i> {{ likeNumbers($status) }}</button>
                    </form>                    
                  
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>{!! $status->body !!}</p>  
                  </div>
                  <div class="line-divider"></div>
                  @foreach ($comments as $comment)
                  <div class="post-comment">
                     @if (auth()->user()->image != null)
                      <img src="{{ imageProfilePath($comment->user->image) }}" alt="{{ $comment->user->name }}" class="profile-photo-sm" >
                      @else                        
                      <img src="{{ asset('default.png') }}" alt="{{ $comment->user->name }}" class="profile-photo-sm" >
                      @endif
                    <p><a href="{{ route('user.profile', $comment->user->name) }}" class="profile-link text-decoration-none text-body">{{ $comment->user->name }} : </a>{{ $comment->comment }}</p>
                  
                  </div>
                  @endforeach
        
                  <form action="{{ route('comment.add') }}" method="post">
                    @csrf
                    <div class="post-comment">
                      <input class="form-control" type="hidden" name="status_id" value="{{ $status->id }}">
                    </div>

                    <div class="post-comment">
                      @if (auth()->user()->image != null)
                      <img src="{{ imageProfilePath(auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="profile-photo-sm" >
                      @else                        
                      <img src="{{ asset('default.png') }}" alt="{{ auth()->user()->name }}" class="profile-photo-sm" >
                      @endif  
                      <input type="text" class="form-control" name="comment" placeholder="Post a comment">
                      <button type="submit" class="btn btn-outline-info btn-sm ml-2" style="height: max-content;margin-top: 9px;">submit</button>
                    </div>
                    @error('comment')
                    <small class="text-danger ml-5">{{ $message }}</small>
                    @enderror
                  </form>

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
