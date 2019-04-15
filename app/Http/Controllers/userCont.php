<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class userCont extends Controller
{   
    public function getDashboard() {
        
        $posts = Post::latest()->get();
        return view('dashboard')->with('posts', $posts);
    }
    public function postSignUp(Request $request) {
        $this->validate($request,[
           'email'=>'required|email|unique:users',
           'first_name'=>'required|max:120',
           'password'=>'required|min:3', 
        ]);
        
        $user = new User();
        $user->email = $request['email'];
        $user->first_name = $request['first_name'];
        $user->password = bcrypt($request['password']);
        $user->save();
        Auth::login($user);
        return redirect()->route('dashboard');
        
    }
    
    public function postSignIn(Request $request) {
        
        $this->validate($request,[
           'email'=>'required',
           'password'=>'required', 
        ]);
       if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']]))
               return redirect ()->route('dashboard');
       return redirect()->back();
    }
    
    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }
    
    public function getAccount() {
        return view('account',['user'=> Auth::user()]);        
    }
    public function saveAccount(Request $request){
        $this->validate($request,[
           'first_name'=>'required|max:120' 
        ]);
        
        $user= Auth::user();
        $user->first_name = $request['first_name'];
        $user->update();
        $file = $request->file('image');
        $fileName = $request['first_name'] . '-' . $user->id . '.jpg';
        if($file){
            Storage::disk('local')->put($fileName, File::get($file));
        }
        return redirect()->route('account');
    }
    
    public function getImage($fileName) {
        $file = Storage::disk('local')->get($fileName);
        return new Response($file,200);
    }
}
