<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use resource\views\products;
use Hash;
use App\Http\Controllers\ProductController;


class CustomAuthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(){

        return view("auth.login");
    }

    public function registration(){
        return view("auth.registration");
    }

    public function registerUser(Request $request){

        //valide user
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12'
        ]);
        $user = new User();
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> password = Hash::make($request -> password);
        $res = $user ->save();
        if ($res){
            return back() -> with('success', 'You have registered successfully');

        } else{
            return back() -> with('fail', 'Something wrong');
        }
    }

    public function loginUser(Request $request){

        //valide user
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', '=', $request -> email) -> first();
        if ($user){
            if(Hash::check($request->password,$user->password)){

                //echo 'Success!';
             //return view("products.index");
             return redirect()->intended('products')
                        ->withSuccess('You have Successfully logged in');

            }
            
            else{
                return back() -> with('fail', 'Password not matches.');
            }
        

        } else {
            return back() -> with('fail', 'This email is not registered');
        }

    }

    public function logout() {
        return view("dashboard");
    }

    public function Home(){
        return view("dashboard");
    }

}
