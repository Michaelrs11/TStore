<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Storage;
use Auth;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->User = new User();
    }

    public function edit(){
        //editData buat dijadiin value di profile bladenya
        $data['editData'] = $this->User->findOrFail(auth()->user()->id);

        //retrun ke profile blade
        return view('profile',$data);
    }
    public function update(Request $request){
        //cek berdasarkan user id yg lagi login
        $user = $this->User->findOrFail(auth()->user()->id);

        $rules = $request->validate([
            'name' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'old_password' => ['required', function($attribute, $value, $fail){ 
                //cek apakah inputan password lama si user salah
            	if(!\Hash::check($value, auth()->user()->password)){
                    //notifikasi salah
            		return $fail(__('The current password is incorrect.'));
            	}
            }],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'gender' => ['required'],
            'address' => ['required','min:10', 'string']
        ]);

        //ngubah password lama ke baru
        $rules['password'] = Hash::make($rules['password']);

        $user->update($rules);

        //jika berhasil redirect ke home
        return redirect('home')->with('success','successfully update profile');
    }

}
