<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware():array{
        return [
            new Middleware('permission:view permissions',['only' => ['index']]),
            new Middleware('permission:edit permissions',['only' => ['edit']]),
            new Middleware('permission:create permissions',['only' => ['create']]),
            new Middleware('permission:delete permissions',['only' => ['destroy']]),
        ];
    }

    // This method will show permission page
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(20);
        return view('permissions.list',[
            'permissions' => $permissions
        ]);
    }

    // This method will show create permission page
    public function create()
    {
        return view('permissions.create');
    }


    // This method will store permission in Database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['unique:permissions', 'string', 'max:255','min:3']
        ]);
        if($validator->passes())
        {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
        }
        else
        {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }

    // This method will show edit permission page in Database
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permissions.edit',[
            'permission' => $permission
        ]);

    }
    
    // This method will update permission in Database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,'.$id,
        ]);
        if($validator->passes())
        {
            $permission = Permission::findOrFail($id);
            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
        }

        else
        {
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator);
        }

    }

    // This method will Delete/Update permission in Database
    public function destroy(Request $request,$id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }


}
