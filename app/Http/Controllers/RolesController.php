<?php

namespace App\Http\Controllers;

use App\Http\Requests\roleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{   
    public function home()
    {
        return view('roles/home', [
            'roles' => role::orderBy('created_at', 'desc')->get()->take(6)
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
            $roles = Role::orderBy('name', 'desc')->get();

        } elseif ($user->isStaff()) {
            $roles = Role::where('user_id', $user->id)->orderBy('name', 'desc')->get();
        } else {
            abort_unless(Auth::check(), 404);
        }
        
        return view('roles.list', [
            'roles' => $roles         
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $request->user()->authorizeRoles(['is_staff', 'is_admin']);
        return view('roles/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\roleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validated();
        $user = Auth::user();

        // $request->user()->authorizeRoles(['is_staff', 'is_admin']);

        $role = new Role;
        $role->name = $request->input('name');
        $role->description = $request->input('body');               

        $res = $role->save();

        if ($res) {
            return back()->with('status', 'Role has been created sucessfully');
        }

        return back()->withErrors(['msg', 'There was an error saving the role, please try again later']);
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
      
        $role = Role::find($id);
      
        return view('roles/edit', [
            'role' => $role
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
       
        $role = role::find($id);
      

        $role->name = $request->input('name');
        $role->description = $request->input('body');
       

        $res = $role->save();

        if ($res) {
            return back()->with('status', 'role has been updated sucessfully');
        }

        return back()->withErrors(['msg', 'There was an error updating the role, please try again later']);
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
        $role = Role::find($id);

        $role->delete();

        return back()->with('status', 'role has been deleted sucessfully');
    }
}
