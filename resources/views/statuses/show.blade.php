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
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{ $status->name }}</h4>
                      <p class="text-secondary mb-1">Full Stack Developer</p>
                      <p class="text-muted font-size-sm">Sign up Date:  <small>{{ $status->created_at->diffForHumans() }}</small></p>
                      <p class="">
                        <button type="button" class="btn btn-sm border border-info">
                          Followers <span class="badge badge-light">{{ $status->followers()->get()->count() }}</span>
                          <span class="sr-only">followers</span>
                        </button>
                        <button type="button" class="btn btn-sm border border-info">
                          Following <span class="badge badge-light">{{ $status->followings()->get()->count() }}</span>
                          <span class="sr-only">following</span>
                        </button>
                      </p>
                        
                        @if ($status->id == auth()->id())                            
                        @else
                        @if(! auth()->user()->isFollowing($status))
                        <form action="{{ route('follow',[auth()->id(),$status->id]) }}"  method="post">
                          @csrf                           
                            <button type="submit" class="btn btn-primary">
                              Follow
                            </button>
                        </form>
                        @else
                        <form action="{{ route('unfollow',[auth()->id(),$status->id]) }}"  method="post">
                          @csrf
                            <button type="submit" class="btn btn-outline-primary">
                                UnFollow
                            </button>
                        </form>                            
                        @endif                            
                        @endif

                      {{-- <button class="btn btn-outline-primary">Message</button> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">

              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="d-flex align-items-center mb-4">Status</h5>
                     {{--  @foreach ($status->statuses as $item)  --}}
                     <h6>{{ $status->statuses->body }}</h6><hr>
                     {{--  @endforeach   --}}
                  </div>
                </div>
              </div>           

            </div>
          </div>

        </div>
    </div>


@endsection