 <div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('statuses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <h4>Post a Status: </h4>
              <textarea class="form-control" placeholder="What's your on mind?" name="body" id="status" rows="3" style="resize: none"></textarea>
            </div>
            <button type="submit" class="btn btn-outline-info float-right">Submit</button>
        </form>
    </div>
  </div>