<div class="row">
    @foreach ($suggestedUsers as $user)
    <div class="col-sm-4">
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-2 my-auto">
                    <img class="img-avatar" src="{{ asset('default.png') }}" height="64" width="64">  
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('user.profile', $user->name) }}" class="text-decoration-none text-white">{{ $user->name }}</a></h5>
                  <p class="card-text">{{ $user->bio }}</p>
                  <p class="card-text"><small class="text-muted">{{ $user->created_at->diffForHumans() }}</small></p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>