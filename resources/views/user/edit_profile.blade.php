@extends('layouts.app')




@section('content')
 <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Edit Profile
                        </div>
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                        @endforeach
                                </ul>
                            </div>
                        @endif


                        <form method="post" action="{{ route('editProfile', Auth::user()->id) }}" enctype="multipart/form-data"  style="padding: 80px">
                            @csrf


                        <div class="form-group">
                            <label for="Skills">Skills</label>
                            <textarea name="Skills" class="form-control  @error('Skills') is-invalid @enderror" id="Skills" rows="3" placeholder="Add Your Skills" value=""> {{$profile->Skills}}</textarea>
                            @error('Skills')
                                     <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                          </div>
                          @if($profile->profile_picture!=null)

                           <div class="col-xs-6" style="padding-right: 10px">
                            <img src="{{asset('images/'.$profile->profile_picture)}}" style="width:70px; height:60px;">                  
                          </div>
                          @endif
                          <div class="form-group" style="padding: 10px">
                                <label for="profile_picture">Upload Photo</label>
                                <input type="file" class="form-control-file @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">                       
                         </div>
                         
                            
                        <div class="form-group" style="padding: 10px">
                                <label for="CV">Upload CV</label>
                                <input type="file" class="form-control-file @error('CV') is-invalid @enderror" id="CV" name="CV">                       
                         </div>
                         @if($profile->CV!=null)
                         <div class="form-group" style="padding: 10px">
                                <label >Uploaded CV: </label> 
                                <a href="{{asset('doc/'.$profile->CV)}}" style="width:70px; height:60px;">{{$profile->CV}}</a>                         
                         </div>
                         @endif

                     



                        <div class="btn btn-outline-primary" style="padding: 5px">
                            <button >Update</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endsection
