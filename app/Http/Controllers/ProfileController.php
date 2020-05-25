<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('profiles.profile',compact('user'));
    }


    public function showAdmin()
    {
        $users = User::paginate(5);
        return view('profiles.admin_panel', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (isset($request->email)){
            $user->email = $request->email;
        }
        if(isset($request->description)){
            $user->description = $request->description;
        }
        $user->save();

        return view('profiles.profile', compact('user'));
    }

    /**
     *Actualiza la contraseña del usuario pasado por parámetro
     *
     * @param Request $request
     * @param User $user
     */
    public function updatePassword(Request $request, User $user){

        $validatedData = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (Hash::check($request->actual_password, $user->password)){

            $newPassword = Hash::make($request->new_password);

            $user->password = $newPassword;
            $user->save();

            $request->session()->flash('status', 'Guardado correctamente');
        } else {
            $request->session()->flash('status', 'La contraseña no coincide');
        }
        return redirect('/user/'.$user->id);
    }

    /**
     * Actualiza la foto de perfil del usuario
     *
     * @param Request $request
     */
    public function updateAvatar(Request $request, User $user){
        $path="public/user-".$user->id;

        if($request->hasFile('profile_picture')){
            if(!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }
            $user->profile_picture = $request->profile_picture->store($path);
            $user->save();
            return response()->json(compact('path'));
        } else {
            return response()->json(['La imagen no se ha subido correctamente'],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     * Destruye la cuenta del usuario loggeado
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();
        User::destroy($user->id);
        return redirect('/login');
    }
}
