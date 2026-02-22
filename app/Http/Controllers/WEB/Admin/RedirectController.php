<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redirect;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $redirects = Redirect::orderBy('id', 'desc')->get();
        return view('admin.redirect.index', compact('redirects'));
    }

    public function create()
    {
        return view('admin.redirect.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'source_url' => 'required|string',
            'destination_url' => 'required_unless:redirect_type,410,451|string|nullable',
            'match_type' => 'required|in:exact,starts_with',
            'redirect_type' => 'required|in:301,302,307,410,451',
            'status' => 'required|in:1,0',
        ];

        $this->validate($request, $rules);

        Redirect::create([
            'source_url' => $request->source_url,
            'destination_url' => $request->destination_url,
            'match_type' => $request->match_type,
            'ignore_case' => $request->ignore_case ? 1 : 0,
            'redirect_type' => $request->redirect_type,
            'status' => $request->status,
        ]);

        $notification = trans('admin_validation.Created Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.redirect.index')->with($notification);
    }

    public function edit($id)
    {
        $redirect = Redirect::findOrFail($id);
        return view('admin.redirect.edit', compact('redirect'));
    }

    public function update(Request $request, $id)
    {
        $redirect = Redirect::findOrFail($id);

        $rules = [
            'source_url' => 'required|string',
            'destination_url' => 'required_unless:redirect_type,410,451|string|nullable',
            'match_type' => 'required|in:exact,starts_with',
            'redirect_type' => 'required|in:301,302,307,410,451',
            'status' => 'required|in:1,0',
        ];

        $this->validate($request, $rules);

        $redirect->source_url = $request->source_url;
        $redirect->destination_url = $request->destination_url;
        $redirect->match_type = $request->match_type;
        $redirect->ignore_case = $request->ignore_case ? 1 : 0;
        $redirect->redirect_type = $request->redirect_type;
        $redirect->status = $request->status;
        $redirect->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.redirect.index')->with($notification);
    }

    public function destroy($id)
    {
        $redirect = Redirect::findOrFail($id);
        $redirect->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function changeStatus($id)
    {
        $redirect = Redirect::findOrFail($id);
        $redirect->status = $redirect->status ? 0 : 1;
        $redirect->save();

        $message = $redirect->status
            ? trans('admin_validation.Active Successfully')
            : trans('admin_validation.Inactive Successfully');

        return response()->json($message);
    }
}
