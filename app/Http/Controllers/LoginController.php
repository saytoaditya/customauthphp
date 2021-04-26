<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
    public function register(Request $req)
    {
        //validate data
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins', //here admins is table name which you created
            'password'=>'required|min:4|max:12'
        ]);
        
        // insert data in database
        $admin= new Admin;
        $admin->name=$req->name;
        $admin->email=$req->email;
        $admin->password=Hash::make($req->password);
        $save=$admin->save();  
        //to give message that data is inserted or any error
        if($save){
            
            return redirect('login');
            return back()->with('success','Registeration succesfull');
        }   
        else{
                return back()->with('fail','Something Went Wrong');
        }
    }

    public function login(Request $req)
    {
        
        $req->validate([
            'email'=>'required|email',
            'password'=>'required|min:4|max:12'
        ]);
        //check password
        $userinfo=Admin::where(['email'=>$req->email])->first();
        if(!$userinfo){
            return back()->with('fail','inavlid user');
        }
        else{
                if(Hash::check($req->password,$userinfo->password)){
                     $req->session()->put('user',$userinfo);
                     return redirect('/');
                   
                }
        }
       

        // return $req->input();
    }
   
    public function logout(){
        if(session()->has('user')){
            session()->forget('user');
            return redirect('login');
        
        }
    }
  
    public function List()
    {
         return view('list');
    }

   
    public function update(Request $req)
    { 
        $profile=Admin::where(['id'=> session()->get('user')['id']])->first();
        $profile->name=$req->name;
        $profile->email=$req->email; 
        $profile->update();
        $req->session()->put('user',$profile);
        return redirect('/')->with('success', 'Profile updated');
       
    }

}
