@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <!-- <h2 style="padding: 20px">Available Job</h2> -->

               
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
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

            
            <div class="card-preview" style="padding-top: 5px">
                <a href="#">
                    <h2 class="post-title">
                        {{ $post->Job_title }}
                    </h2>
                </a>
                <p class="post-meta">Posted by
                    <a href="{{ route('companyPost', $post->user->id)}}">{{ $post->user->business_name }}</a>
                    on {{ $post->created_at->format('j F, Y')}}
                    
                </p>
                <p class="post-description">
                    Description: {{ $post->Job_description }} 
                    
                </p>
                <p class="post-description">
                    Salary: {{ $post->Salary }}
                </p>
                <p class="post-description">
                    Location: {{ $post->Location }}
                </p>
                <p class="post-description">
                    Country: {{ $post->Country }}
                </p>


            </div>
            <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
