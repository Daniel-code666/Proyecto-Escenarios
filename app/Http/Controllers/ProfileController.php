<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {

        $datos = request()->except('_token','_method');

        $datosToSend = new User();
        $datosToSend = $datos;  

        if($request->hasFile('photo')){
            $user = User::findOrFail(auth()->user()->id);
            Storage::delete('public/'.$user->photo);
            $datosToSend['photo']=$request->file('photo')->store('uploads','public');
        }
        User::where('id','=',auth()->user()->id)->update($datosToSend);
        return back()->withStatus(__('Datos actualizados correctamente'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
/*         if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_password' => __('You are not allowed to change the password for a default user.')]);
        } */

        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Contraseña actualizada correctamente'));
    }
}
