@extends('layouts.default')
@section('content')

<style>
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}

</style>


<div class="container">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    @if ($user->image != null)
                    <img src="{{ imageProfilePath($user->image) }}" alt="{{ $user->name }}" class="rounded-circle" width="150">
                    @else
                    <img src="{{ asset('default.png') }}" alt="{{ $user->name }}" class="rounded-circle" width="150">
                    @endif
                    <div class="mt-3">
                      <h4>{{ $user->name }}</h4>
                      <p class="text-secondary mb-1">{{ $user->jobTitle }}</p>
                      @if (auth()->id() == $user->id)
                      <a href="{{ route('profile.edit', $user) }}" class="btn btn-sm btn-success" title="edit profile"><i class="fa fa-pencil-alt"></i></a>
                      @endif
                      <p class="text-muted font-size-sm">Sign up Date:  <small>{{ $user->created_at->diffForHumans() }}</small></p>
                      <p class="">
                        <button type="button" class="btn btn-sm border border-info">
                          Followers <span class="badge badge-light">{{ $user->followers()->get()->count() }}</span>
                          <span class="sr-only">followers</span>
                        </button>
                        <button type="button" class="btn btn-sm border border-info">
                          Following <span class="badge badge-light">{{ $user->followings()->get()->count() }}</span>
                          <span class="sr-only">following</span>
                        </button>
                      </p>

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
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">

              @if (count($user->statuses) == 0)
                @include('users.status')
              @else
                @can('own-profile', $user->statuses->first())
                  @include('users.status')
                @endcan
              @endif

              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                  <div class="card h-100">
                    <h5 class="d-flex align-items-center p-4 ">Statuses</h5>
                    <div class="card-body">
                      @foreach ($userStatuses as $item)
                      <div class="d-flex justify-content-between">
                        <h6><a href="{{ route('status.page',[$item->id, $item->user->name]) }}" class="text-decoration-none text-body">{!! \Str::limit($item->body, 30) !!}</a></h6><hr>
                        @if (auth()->id() == $item->user_id)
                        <div>
                          <a href="{{ route('status.edit.view', $item->id) }}" class="btn btn-outline-secondary">
                            <i class="fa fa-pen-nib"></i>
                          </a>
                        </div>
                        @endif
                      </div><hr>
                     @endforeach
                  </div>
                </div>
              </div>
            </div>
            {{ $userStatuses->links() }}
          </div>

        </div>
    </div>
    </div>

  <h5 class="text-secondary text-uppercase">Suggested users</h5>
    @include('users.suggestion-users')

@endsection
