<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\ProfileRequest;

use App\JobPost;
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
        $jobposts = JobPost::all();
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


    public function edit_profile($id){

        if(Auth::user()->user_type==0){
            $profile = User::where('id', Auth::id())->first();
            return view('user.edit_profile', compact('profile'));
        }
        else{
            return response('Unauthorized action.', 403);
        }

    }


    public function edit_profile_post(ProfileRequest $request, $id){


        $user = User::where('id', Auth::id())->first();

        $user->Skills = $request['Skills'];

        if ($request->hasFile('profile_picture')) {
            $image= $request->file('profile_picture');
            $image_ext = $image->getClientOriginalExtension();
            $new_image_name = Auth::user()->id.".".$image_ext;
            $path = '/images';
            $destination_path = public_path($path);
            $image->move($destination_path, $new_image_name);

            // $new_image = new Image();
            $user->profile_picture = $new_image_name;

        } 

        if ($request->hasFile('CV')) {
            $cv= $request->file('CV');
            $cv_ext = $cv->getClientOriginalExtension();
            $cv_name = Auth::user()->id.".".$cv_ext;
            $path = '/doc';
            $destination_path = public_path($path);
            $cv->move($destination_path, $cv_name);

            $user->CV = $cv_name;

        } 

        $user->save();
        return back()->with('success', 'Profile successfully updated ');

    }

    public function apply($id){



        $user = User::where('id', Auth::id())->first();
        if($user->CV){
        $apply = new Appliedlist();
        $apply->user_id = Auth::id();
        $apply->jobpost_id = $id;
        $apply->save();
        return back()->with('success', 'You Applied successfully ');
        }
        else {
            return redirect()->route('Profile', Auth::user()->id)->with('success', 'Please Upload Your CV ');
        }
    }
    public function apply_post($id){
    }

    public function profile( $id){
        $profile = User::where('id', $id)->first();
        
        if($profile->user_type==0)
        {
            return view('user.profile', compact('profile'));
        }
    }
}
