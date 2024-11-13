<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware():array{
        return [
            new Middleware('permission:view roles',['only' => ['index']]),
            new Middleware('permission:edit roles',['only' => ['edit']]),
            new Middleware('permission:create roles',['only' => ['create']]),
            new Middleware('permission:delete roles',['only' => ['destroy']]),
        ];
    }

    // This method will show the list of roles
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(20);
        return view('roles.list',[
            'roles' => $roles
        ]);
    }

    // This method will create a new role
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create',[
            'permissions' => $permissions
        ]);
    }

    // This is method will store role in Database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'unique:roles', 'string', 'max:255','min:3'
        ]);
        if($validator->passes())
        {
            $role = Role::create(['name' => $request->name]);
            if(!empty($request->permission)) {
                foreach($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('roles.index')->with('success', 'Role added successfully');
        }
        else
        {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.edit',[
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
            'role' => $role
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$id,
        ]);
        if($validator->passes())
        {
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->save();
            if(!empty($request->permission)) {
                $role->syncPermissions($request->permission);
            }
            else
            {
                $role->syncPermissions([]);
            }
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        }
        else
        {
            return redirect()->route('roles.edit',$id)->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request,$id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
