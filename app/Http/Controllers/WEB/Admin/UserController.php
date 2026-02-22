<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;


class UserController extends Controller
{


    function index() {
        if(!auth()->user()->can('user.index')){
            abort(403, 'Unauthorized action.');
        }
        $emploies = User::where('status', 2)->get();
        return view('admin.user.index', compact('emploies'));
    }

    public function create(){
        if(!auth()->user()->can('user.create')){
            abort(403, 'Unauthorized action.');
        }
        $roles=Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create New User
        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->status = 2;
        $admin->save();

        if ($request->roles) {
            $admin->assignRole($request->roles);
        }
        session()->flash('success', 'admin has been created !!');
        return redirect()->back();
    }

    public function edit($id)
    {
        if(!auth()->user()->can('user.edit')){
            abort(403, 'Unauthorized action.');
        }
        $user = User::find($id);
        $roles  = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);


        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        session()->flash('success', 'User has been updated !!');
        return back();
    }

    public function role_index(){
        if(!auth()->user()->can('role.index')){
            abort(403, 'Unauthorized action.');
        }
        $roles = Role::all();
        return view('admin.user.role.index', compact('roles'));
    }
    public function role_create(){
        if(!auth()->user()->can('role.create')){
            abort(403, 'Unauthorized action.');
        }
        $permissions=Permission::orderBy('id','DESC')->get();
        return view('admin.user.role.create', compact('permissions'));

    }
    public function role_edit($id)
    {
        if(!auth()->user()->can('role.edit')){
            abort(403, 'Unauthorized action.');
        }
        $permissions = Permission::all();
        $role = Role::findById($id);
        return view('admin.user.role.edit', compact('role','permissions'));
    }

    public function role_update(Request $request, $id)
    {
         // Validation Data
         $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        $role = Role::findById($id);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }

        session()->flash('success', 'Role has been updated !!');
        return back();
    }

    public function role_delete($id)
    {
    if(!auth()->user()->can('role.delete')){
            abort(403, 'Unauthorized action.');
        }
       Role::findOrFail($id)->delete();

       return back()->with('success', 'Role deleted success!');

    }

    public function role_store(Request $request){
        // dd($request->all());
        $request->validate([
            'name'=> 'required|unique:roles'
    ]);
    $role = Role::create(['name' => request()->name]);
    $permissions = $request->input('permissions');

    if (!empty($permissions)) {
        $role->syncPermissions($permissions);
    }


    return redirect()->route('admin.user.role.index')->with('success','Role is Assign successfully!');
    }
    public function permission_index(){
    if(!auth()->user()->can('permission.index')){
            abort(403, 'Unauthorized action.');
        }
       $rows=Permission::orderBy('id','DESC')->get();
       return view('admin.user.permission.index',compact('rows'));
    }

    public function permission_create(){
    
    if(!auth()->user()->can('permission.create')){
            abort(403, 'Unauthorized action.');
        }
        
        return view('admin.user.permission.create');
    }
    public function permission_store(Request $request){
        $request->validate([
            'name'=> 'required|unique:permissions'
    ]);
       Permission::create(['name' => request()->name]);
    return redirect()->route('admin.user.permission.create')->with('success','Permission is Craete successfully!');
    }

    public function permission_edit($id){
        if(!auth()->user()->can('permission.edit')){
            abort(403, 'Unauthorized action.');
        }
        $permission = Permission::where('id', $id)->first();
        // dd($permission);
        return view('admin.user.permission.edit', compact('permission'));
    }


    public function permission_Update(Request $request,  $id){
        $request->validate([
            'name'=> 'required|unique:permissions'
            ]);

            $permission = Permission::findById($id);
            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('admin.user.permission.index')->with('success','Permission is Craete successfully!');

    }

    public function permission_delete($id){
        if(!auth()->user()->can('permission.delete')){
            abort(403, 'Unauthorized action.');
        }
        $permission = Permission::find($id);
        if (!is_null($permission)) {
            $permission->delete();
        }

        session()->flash('success', 'Permission has been deleted !!');
        return back();
    }

    public function stuffPage(){

        return view('admin.user.auth.login');

    }





    public function storeStuffLogin(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // dd($credentials);
        // Attempt to authenticate the user with a status of 2
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 2])) {

            $notification= trans('admin_validation.Login Successfully');
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('admin.dashboard')->with($notification);
        }
        else{
            return redirect()->route('login')->with('error', 'Invalid credentials');

        }

        return response()->json([
            'status' => false,
            'msg' => 'Invalid credentials',
        ], 422);
    }


public function stuffLogout(){
    Auth::logout();


    $notification= trans('admin_validation.Logout Successfully');
    $notification=array('messege'=>$notification,'alert-type'=>'success');
    return redirect()->route('admin.user.stuff.login')->with($notification);
}

}
