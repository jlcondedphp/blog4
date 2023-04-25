<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{   
    public function home()
    {
        return view('users/home', [
            'user' => User::orderBy('created_at', 'desc')->get()->take(6)
        ]);
    }

   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
        abort_unless(Auth::check(), 404);
        $user = $request->user();

        
        if ($user->isAdmin()) {
            $users = User::orderBy('name', 'desc')->get();

        } elseif ($user->isStaff()) {
            $users = User::where('user_id', $user->id)->orderBy('name', 'desc')->get();
        } else {
            abort_unless(Auth::check(), 404);
        }
        
        return view('users.list', [            
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $request->user()->authorizeRoles(['is_staff', 'is_admin']);

        $roles = Role::all();
        return view('users/create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\userRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validated();
        $user = Auth::user();

        // $request->user()->authorizeRoles(['is_staff', 'is_admin']);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email'); 
        $user->password = $request->input('password');
                             
        $user->save();
        $roles = $request->input('roles');
        $user->roles()->sync($roles);

        if ($user) {
            return back()->with('status', 'Usuario has been created sucessfully');
        }

        return back()->withErrors(['msg', 'There was an error saving the Usuario, please try again later']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, $id)
    {
        abort_unless(Auth::check(), 404);
      
        $user = User::find($id);       
        $roles = Role::all();;

        return view('users/edit', [
            'user' => $user,
            'roles' => $roles
            
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\roleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
       
        $user = User::find($id);
      

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
       

        $res = $user->save();
        $roles = $request->input('roles');
        $user->roles()->sync($roles);
               

        if ($res) {
            return back()->with('status', 'user has been updated sucessfully');
        }

        return back()->withErrors(['msg', 'There was an error updating the user, please try again later']);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        abort_unless(Auth::check(), 404);
        $user = User::find($id);

        $user->delete();

        return back()->with('status', 'user has been deleted sucessfully');
    }


}
