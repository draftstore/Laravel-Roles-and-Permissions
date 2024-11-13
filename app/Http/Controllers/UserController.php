<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware():array{
        return [
            new Middleware('permission:view users',['only' => ['index']]),
            new Middleware('permission:edit users',['only' => ['edit']]),
            new Middleware('permission:create users',['only' => ['create']]),
            new Middleware('permission:delete users',['only' => ['destroy']]),
        ];
    }

    public function index()
    {
        $users = User::latest()->paginate(20);
        $check_user_email_verified_or_not = Auth::user()->email_verified_at;
        return view('users.list',[
            'users' => $users,
            'check_user_email_verified_or_not' => $check_user_email_verified_or_not
        ]);
     }

    public function create()
    {
        //
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('users.create',[
            'roles' => $roles   
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required',
        ]);
        if($validator->fails())
        {
            return redirect()->route('users.create')->withInput()->withErrors($validator);
        }
        else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->syncRoles($request->role);
            return redirect()->route('users.index')->with('success', 'User added successfully');
        }

    }


    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id');
        return view('users.edit',[
            'user' => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles
        ]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        if($validator->fails())
        {
            return redirect()->route('users.edit',$id)->withInput()->withErrors($validator);
        }
        else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $user->syncRoles($request->role);
            return redirect()->route('users.index')->with('success', 'User updated successfully');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User has been deleted successfully');
    }
}
