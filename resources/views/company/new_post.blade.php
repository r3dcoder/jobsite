@extends('layouts.app')

@section('content')
<!--     <a href="#" id= "dur" class="add">add</a>
 -->    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Create Post
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


                  <form method="post" action="{{ route('new_post_store')}}" style="padding: 80px">
                            @csrf


                            <div class="form-group" style="size: 200px">
                                <label for="Job_title">Job Title</label>
                                <input name="Job_title" type="textarea" class="form-control @error('Job_title') is-invalid @enderror" id="Job_title" placeholder="eg: Sofware Engineer" value="{{old('Job_title')}}" >

                                @error('Job_title')
                                     <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                          <div class="form-group">
                                <label for="Job_description">Job Description</label>
                                <input name="Job_description" type="text" class="form-control @error('Job_description') is-invalid @enderror" id="Job_description" placeholder="" value="{{old('Job_description')}}" >
                                @error('Job_description')
                                     <div class="alert alert-danger">{{ $message }}</div>
                                 @enderror

                            </div>

                            <div class="form-group">
                                <label for="Salary">Salary</label>
                                <input name="Salary" type="text" class="form-control @error('Salary') is-invalid @enderror" id="Salary" placeholder="" value="{{old('Salary')}}" >
                                @error('Salary')
                                     <div class="alert alert-danger">{{ $message }}</div>
                                 @enderror
                            </div>

                            <div class="form-group">
                                <label for="Location">Location</label>
                                <input name="Location" type="text" class="form-control @error('Address2') is-invalid @enderror" id="Location" placeholder="" value="{{old('Location')}}" >
                                @error('Location')
                                     <div class="alert alert-danger">{{ $message }}</div>
                                 @enderror
                            </div>

                            <div class="form-group">
                                <label for="Country">Country</label>
                                <input name="Country" type="text" class="form-control @error('Country') is-invalid @enderror" id="Counrty" placeholder="e.g Bangladesh" value="{{old('Country')}}" >
                                @error('Country')
                                     <div class="alert alert-danger">{{ $message }}</div>
                                 @enderror
                            </div>

<!--                            
            
            <div class="form-group1">
                <label for="UploadPhoto">Add/upload Photos</label>
                <input type="file" class="form-control-file @error('Photo') is-invalid @enderror" id="UploadPhoto" name="UploadPhoto[]" multiple>                       
            </div> -->
           <!-- <button name="add1" class="btn btn-primary">Add New Item</button> -->

         <div class="btn btn-outline-primary" style="padding: 8px">
                            <button class="book-now-btn">Submit</button>
                        </div>



                  </form> 
                        
                    </div>

                </div>
            </div>

        </div>
    </div>


    @endsection
