@extends('layouts.app')
@php
$i=1;
$applicant = App\Appliedlist::all(); 
$jobposts = App\Jobpost::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Ser. No</th>
                            <th>Title</th>
                            <th>Created at</th>
                            <th>Applicant Name</th>
                            <th>Applicant Number</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                            
                        @foreach($jobposts as $post)
                            <tr>
                                <td> {{$i++}}</td>
                                <!-- <td>{{ $post->id }}</td> -->
                                <td class="text-nowrap"><a href="{{ route('singlePost', $post->id)}}">{{ $post->Job_title }}</a></td>
                                <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans()}}
                                    
                                </td>
                                 <td>
                                    @php
                                        $cnt= App\Jobpost::find($post->id)->appliedlists->count();
                                        $applicants= App\Jobpost::find($post->id)->appliedlists;
                    
                                    @endphp

                                    @foreach($applicants as $applicant)                                   
                                     <p>
                                         
                                         <a href="{{route('Profile', App\Appliedlist::find($applicant->id)->user->id)}}" class="btn-warning">
                                        {{App\Appliedlist::find($applicant->id)->user->first_name}}
                                    </a>
                                     </p>
                                    @endforeach

                                </td>
                                <td>{{$cnt}}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
