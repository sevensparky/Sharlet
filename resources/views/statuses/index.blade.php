@extends('layouts.default')
@section('content')

<div class="row">
    <div class="col-6 offset-3 mb-4">
        <form action="{{ route('statuses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <h4>Post a Status: </h4>
              <textarea class="form-control" placeholder="What's your on mind?" name="body" id="status" rows="3" style="resize: none"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="col-6 offset-3">
        <h4>Statuses</h4>
        {{--  @if (\App\Models\Status::all() > 0)  --}}
        {{--  @foreach (\App\Models\Status::all() as $status)
            <article>
                {{ $status->body }}
            </article>
        @endforeach  --}}
        {{--  @else              --}}
        {{--  @endif  --}}
        @foreach (\App\Models\Status::latest()->paginate(10) as $status)
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            {{--  <div class="card-header">Header</div>  --}}
            <div class="card-body">
                <p class="card-text">{{ $status->body }}</p>
                <h6 class="card-title">{{ $status->created_at->diffForHumans() }}</h6>
            </div>
        </div>
        @endforeach 

    </div>
</div>

@endsection