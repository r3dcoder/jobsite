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
        
        //$jobposts = JobPost::find(2);
        //$name = $jobposts->user->first_name;
        //dd($jobposts);
        if(Auth::user()->user_type==0){
            $jobposts = Jobpost::orderBy('created_at', 'desc')->get();
            return view('home', compact('jobposts'));
        }
        else{
            $jobposts = Jobpost::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
            return view('company.dashboard', compact('jobposts'));
        }
    }
    public function company_dashboard(){
        return view('company.dashboard');
    }
    public function newPost(){
        return view('company.new_post');
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
    public function profile( $id){
        $profile = User::where('id', $id)->first();
        
        if($profile->user_type==0)
        {
            return view('user.profile', compact('profile'));
        }
    }  

    public function singlePost($id){
        $post = Jobpost::find($id);
        return view('company.single_post', compact('post'));
    } 

    public function companyPost($id){
        $posts = Jobpost::where('user_id', $id)->get();
        return view('company.all_post', compact('posts'));
    }
}