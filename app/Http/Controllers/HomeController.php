<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\ProfileRequest;

use App\Jobpost;
use App\User;
use App\Appliedlist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;





class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jobposts = Jobpost::orderBy('created_at', 'desc')->get();
        //$jobposts = JobPost::find(2);
        //$name = $jobposts->user->first_name;
        //dd($jobposts);
        if(Auth::user()->user_type==0){
            return view('home', compact('jobposts'));
        }
        else{
            return view('company.dashboard');
        }
    }

    public function company_dashboard(){
        if(Auth::user()->user_type){
            return view('company.dashboard');
        }
        else{
            return response('Unauthorized action.', 403);
        }
    }

    public function newPost(){

        if(Auth::user()->user_type){
            
            return view('company.new_post');
        }
        else{
            return response('Unauthorized action.', 403);
        }
    }

    public function newPostStore(PostRequest $request){

        $jobpost = new JobPost();
        $jobpost->Job_title = $request['Job_title'];
        $jobpost->Job_description = $request['Job_description'];
        $jobpost->Salary = $request['Salary'];
        $jobpost->Location = $request['Location'];
        $jobpost->Country = $request['Country'];
        $jobpost->user_id = Auth::id();
        $jobpost->save();
        return redirect('/company/dashboard')->with('success', 'Directory successfully created');
    }   
}
