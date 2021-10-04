<div class="row">
   
    <div class="col-10 offset-1">
        <h4>Latest Statuses</h4>

       
         @foreach (\App\Models\Status::latest()->paginate(20) as $status)
        <div class="card bg-light mb-3">
            <div class="card-body">
                <p class="card-text">{{ $status->body }}</p>
                <h6 class="card-title">by: <a class="text-white text-decoration-none" href="{{ route('user.profile', $status->user->name) }}">{{ $status->user->name }}</a></h6>
            </div>
            <div class="card-footer">
                <small class="card-title float-right">Share on: {{ $status->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @endforeach 


    </div>
</div>