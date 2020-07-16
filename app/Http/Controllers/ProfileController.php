<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    
    public function index(Request $request)
    {

        $authUser = Auth::id();
        $profils = Profile::where('user_id', $authUser)->get();
        return view('home', [
            'profiles' => $profils
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfilRequest $request)
    {
        // insert 
        
        //uploads fils:
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('profilesImg');
        }
        
        Profile::create([
            'nom' => $request->name,
            'image' => $path,
            'user_id' => Auth::id(),
        ]);


        return Redirect()->route('profiles.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profil = Profile::findOrFail($id);

        return view('profiles.manage', [
            'profil' => $profil
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfilRequest $request, $id)
    {
        $profil = Profile::findOrFail($id);

        $profil->nom = $request->name;

        if($request->hasFile('useImg')) {
            $path = $request->file('useImg')->store('profilesImg');

            Storage::delete($profil->image);
            $profil->image = $path;
        }

        $profil->save();

        return Redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profil = Profile::findOrFail($id);

        $profil->delete();

        return Redirect()->route('profiles.index');
    }

    // public function profileLogin(Request $request) 
    // {
    //     $this->validate($request, [
    //         'nom' => 'required',
    //         'password' => 'required'
    //     ]);

    //     if(Auth::guard('profil')->attempt(['nom' => $request->nom, 'password' => $request->password])) {

    //         return redirect()->intended('browse');
    //     }

    //     return back()->withInput($request->only('nom'));

    // }

}
