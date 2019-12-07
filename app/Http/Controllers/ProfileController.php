<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdatePassword;
use App\Admin 		as A;
use App\Cashier 	as Cs;
use App\Manager 	as M;
use App\User 		as U;

class ProfileController extends Controller
{

    public function edit()
    {
        $id = Auth::user()->id;
    	$lvl = Auth::user()->level;
    	if($lvl==1)
	    	$tbl = A::where('login', '=', $id)->first();
	    else if($lvl==2)
	    	$tbl = M::where('login', '=', $id)->first();
	    else
	    	$tbl = Cs::where('login', '=', $id)->first();
        $data = $tbl;
        $username = Auth::user()->username;
        $oper = array(
            'title'     => 'Ubah Profil'.title(),
            'modul'     => 'profile',
            'data'      => $data,
            'username'  => $username,
            'action'    => route('profile.update', $id),
            'profile'       => $this->profile()
        );
        return view('profiles.edit', $oper);
    }

    public function update(Request $request)
    {
        $rules = [
            'name'          => 'required',
            'username'      => 'required|min:6'
        ];

        $usernameIsChange = $request->username!=$request->old_username;

        if($usernameIsChange)
            $rules['username']='required|min:6|unique:logins';

        $messages = [
            'username.unique'       => 'Username sudah digunakan',
            'username.min'          => 'Username minimal 6 huruf'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if($usernameIsChange)
            U::where(['username'=>$request->old_username])
                ->update([
                    'username'  => $request->username
            ]);

        $id = Auth::user()->id;
        $lvl = Auth::user()->level;
    	if($lvl==1)
            $tbl = A::where('login', '=', $id);
        else if($lvl==2)
            $tbl = M::where('login', '=', $id);
        else
            $tbl = Cs::where('login', '=', $id);

        $tbl->update([
            'name'              => $request->name,
            'gender'            => $request->gender,
            'city'              => upper($request->city),
            'birthdate'         => eng_date($request->birthdate),
            'address'           => $request->address
        ]);

        return redirect()->route('/')->with('success', 'Profil berhasil diubah');
    }

    public function avatarupdate(Request $request)
    {
    	$avatar = $request->file('avatar');
    	$jpeg = $avatar->extension()=='jpeg';
    	if($jpeg)
    		$extension = '.jpg';
    	else
    		$extension = '.png';
    	$path = $avatar->storeAs('avatars', Auth::user()->username.$extension);
    	U::where(['id'=>Auth::user()->id])->update(['avatar'=>$path]);
    	return redirect()->route('/')->with('success', 'Avatar berhasil diubah');
    }

    public function passwordupdate(Request $request)
    {
    	$rules = [
            'password'      => 'required|min:6|confirmed'
        ];
    
        $messages = [
            'password.confirmed'      	=> 'Konfirmasi password tidak sama!!!',
            'password.min'				=> 'Password minimal 6 karakter!!!'
        ];
    	$validator = Validator::make($request->all(), $rules, $messages);
    	// dd($validator->errors());
    	if($validator->fails()){
    		return redirect()->route('/')->with('failed', $validator->errors());
    	}
    	U::where('id', '=', Auth::user()->id)->update(['password'=>$request->password]);
    	return redirect()->route('/')->with('success', 'Password berhasil diubah');
    }

    public function reset()
    {
    	$username = U::find(Auth::user()->id)->username;
    	U::where('id', '=', Auth::user()->id)->update(['password'=>bcrypt($username)]);
    	return redirect()->route('/')->with('success', 'Password berhasil direset');
    }
}
