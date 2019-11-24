@extends('layouts.app')

@section('content')
 <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                	@if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                    <div class="card">
                        <div class="card-header bg-light">
                            <div class="col-xs-6" style="padding-right: 10px">
                            	<h4>{{$profile->first_name}} {{$profile->last_name}}</h4>
                            	@if($profile->profile_picture!=null)
                                <img src="{{asset('images/'.$profile->profile_picture)}}" style="width:100px; height:120px;">
                                @endif
                                             
                        	</div>
                        </div>
                        <div class="form-group" style="padding: 10px">
                                <label >Skills: </label> 
                                <pre>{{$profile->Skills}}</pre>                         
                         </div>
                        @if($profile->CV!=null)
                        <div class="form-group" style="padding: 10px">
                                <label >CV: </label> 
                                <a href="{{asset('doc/'.$profile->CV)}}" style="width:70px; height:60px;">{{$profile->CV}}</a>                         
                         </div> 
                         @endif
                         @if(Auth::user()->id==$profile->id)
                         <a class="btn btn-primary" href="{{ route('editProfile', Auth::user()->id)}}"> {{ __('Edit Your Profile') }}</a>
                         @endif                    
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endsection
