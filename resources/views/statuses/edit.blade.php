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
            <div class="col-md-10 mx-auto">
              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{ route('status.update', $status) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <h4>Post a Status: </h4>                  
                                  <textarea class="form-control" placeholder="What's your on mind?" name="body" id="editorinstance" rows="3">{!! $status->body !!}</textarea>
                                  
                                  @error('body')
                                    <p class="text-danger">{{ $message }}</p>
                                  @enderror
                    
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a  href="{{ route('user.profile', $status->user->name) }}" class="btn btn-sm btn-outline-secondary float-right">Cancel</a>
                                    <button type="submit" class="btn btn-sm btn-outline-primary float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
              </div>           
            </div>
          </div>
        </div>
    </div>
</div>

@endsection