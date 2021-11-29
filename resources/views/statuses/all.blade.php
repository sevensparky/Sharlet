<div class="row">
   
    <div class="col-10 offset-1">
        <h4>Latest Statuses</h4>
       
         @foreach (\App\Models\Status::latest()->paginate(20) as $status)
         <div class="card mb-3" >
            <div class="row no-gutters">
              <div class="col-md-2">
                <img class="img-avatar" src="{{ asset('default.png') }}" height="64" width="64">  
              </div>
              <div class="col-md-10">
                <div class="card-body">
                  <h6 class="card-title">by: <a class="text-white text-decoration-none" href="{{ route('user.profile', $status->user->name) }}">{{ $status->user->name }}</a></h6>
                  <p class="card-text">
                      <a class="text-decoration-none text-white" href="{{ route('status.page',[ $status->id, $status->user->name ]) }}">{{ \Str::limit($status->body,30) }}</a>
                  </p>
                  {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                </div>
                <div class="card-footer">
                    <small class="card-title float-right">Share on: {{ $status->created_at->diffForHumans() }}</small>
                </div>
              </div>
            </div>
          </div>
        @endforeach 

    </div>
</div>