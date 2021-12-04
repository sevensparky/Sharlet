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


.fileUploadWrap {
  padding-top: 10px;
  position: relative;
}
.file-upload-button-icon {
  position: absolute;
  cursor: pointer;
/*   below means you can click through the image onto the invisible input */
  pointer-events: none;
  /* width:50px; */
  top: 50%;
  transform: translatey(-50%);
}
.fileName {
  position: absolute;
  left: 50px;
  top: -8px;
  pointer-events: none;
}
input[type=file] {
  margin-left: -25px;
  /* opacity: 0; */
  width: 100px
}
.image-upload>input {
  display: none;
}

</style>

<script>
   $(document).on('change', ".fileUploadWrap input[type='file']",function(){
        if ($(this).val()) {

            var filename = $(this).val().split("\\");
         
            filename = filename[filename.length-1];

            $('.fileName').text(filename);
        }
 });
</script>

<div class="container">
    <div class="main-body">    
          <div class="row gutters-sm">
            <div class="col-md-6 mx-auto mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <form action="{{ route('profile.update', $user) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($user->image != null)                        
                        <img src="{{ imageProfilePath($user->image) }}" alt="{{ $user->name }}" class="rounded-circle" width="150">                            
                        @else
                        <img src="{{ asset('default.png') }}" alt="{{ $user->name }}" class="rounded-circle" width="150">
                        @endif
                        <div class="image-upload mt-2">
                          <label for="file-input">
                            <i class="fa fa-file-upload" style="font-size: 1.4rem"></i>
                          </label>                        
                          <input id="file-input" name="image" type="file" />
                        </div>
                        <div class="mt-3">
                            <div class="form-group mt-4">
                                <h6 class="text-left">Name:</h6>
                                <input type="text" name="name" class="form-control shadow-none border-0" value="{{ $user->name }}" placeholder="Enter your Name...">
                            </div>
                            <div class="form-group">
                                <h6 class="text-left">Last Name:</h6>
                                <input type="text" name="last_name" class="form-control shadow-none border-0" value="{{ $user->last_name }}" placeholder="Enter your last name">
                            </div>
                            <div class="form-group">
                                <h6 class="text-left">Job Title:</h6>
                                <input type="text" name="jobTitle" class="form-control shadow-none border-0" value="{{ $user->jobTitle }}" placeholder="Enter your job title">
                            </div>
                            <div class="form-group">
                                <h6 class="text-left">Email:</h6>
                                <input type="text" name="email" class="form-control shadow-none border-0" value="{{ $user->email }}" placeholder="Enter your E-mail address">
                            </div>
                            <div class="form-group">
                                <h6 class="text-left">Gender:</h6>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="male" {{ $user->gender == 'male' ? 'checked' : '' }}>
                                      <label class="form-check-label" for="gridRadios1">
                                        Male
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="female" {{ $user->gender == 'female' ? 'checked' : '' }}>
                                      <label class="form-check-label" for="gridRadios2">
                                        Female
                                      </label>
                                    </div>
                                </div>
                            </div>
                          <button type="submit" class="btn btn-primary text-uppercase" title="update profile">update</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
