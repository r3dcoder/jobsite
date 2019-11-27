@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <!-- <h2 style="padding: 20px">Available Job</h2> -->

                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="card-header"><h3>All job post by {{$posts->first()->user->business_name}}</h3></div>

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

            @foreach($posts as $post)
            <div class="card-preview" style="padding-top: 5px">
                <a href="#">
                    <h2 class="post-title">
                        {{ $post->Job_title }}
                    </h2>
                </a>
                <p class="post-meta">Posted by
                    <a href="{{ route('companyPost', $post->user->id) }}">{{ $post->user->business_name }}</a>
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

                <!-- <button href = "{{ route('ApplyPost', $post->id) }}" class="btn btn-primary">Apply</buttron> -->
                @if(Auth::user()->user_type==0)

                    @php
                        $applicant = App\Appliedlist::where('jobpost_id', $post->id)->where('user_id', Auth::user()->id)->first(); 
                    @endphp
                    @if($applicant==null)
                    <form method="post" action=" {{ route('ApplyPost', $post->id ) }}">
                        <a href="{{ route('ApplyPost', $post->id ) }}" class="btn btn-primary"> Apply </a>
                    </form>
                    @else
                        <a href="#" class="btn btn-primary"> You have already Applied </a>
                    @endif
                
                @endif

            </div>
            <hr>
            @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
