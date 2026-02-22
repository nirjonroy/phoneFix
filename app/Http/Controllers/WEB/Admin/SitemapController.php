<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\SitemapSetting;
use App\Models\SitemapUrl;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = SitemapSetting::first();
        if (!$settings) {
            $settings = SitemapSetting::create([]);
        }

        $urls = SitemapUrl::latest()->get();

        return view('admin.sitemap.index', compact('settings', 'urls'));
    }

    public function updateSettings(Request $request)
    {
        $settings = SitemapSetting::first();
        if (!$settings) {
            $settings = SitemapSetting::create([]);
        }

        $settings->include_home = $request->has('include_home');
        $settings->include_services_page = $request->has('include_services_page');
        $settings->include_categories = $request->has('include_categories');
        $settings->include_sub_categories = $request->has('include_sub_categories');
        $settings->include_child_categories = $request->has('include_child_categories');
        $settings->include_products = $request->has('include_products');
        $settings->include_blogs = $request->has('include_blogs');
        $settings->include_pages = $request->has('include_pages');
        $settings->include_manual = $request->has('include_manual');
        $settings->default_changefreq = $request->default_changefreq;
        $settings->default_priority = $request->default_priority;
        $settings->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.sitemap.index')->with($notification);
    }

    public function storeUrl(Request $request)
    {
        $request->validate([
            'loc' => 'required',
            'changefreq' => 'nullable',
            'priority' => 'nullable|numeric',
            'lastmod' => 'nullable|date',
        ]);

        SitemapUrl::create([
            'loc' => $request->loc,
            'changefreq' => $request->changefreq,
            'priority' => $request->priority,
            'lastmod' => $request->lastmod,
            'status' => $request->has('status'),
        ]);

        $notification = trans('admin_validation.Created Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.sitemap.index')->with($notification);
    }

    public function updateUrl(Request $request, $id)
    {
        $request->validate([
            'loc' => 'required',
            'changefreq' => 'nullable',
            'priority' => 'nullable|numeric',
            'lastmod' => 'nullable|date',
        ]);

        $url = SitemapUrl::findOrFail($id);
        $url->loc = $request->loc;
        $url->changefreq = $request->changefreq;
        $url->priority = $request->priority;
        $url->lastmod = $request->lastmod;
        $url->status = $request->has('status');
        $url->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.sitemap.index')->with($notification);
    }

    public function destroyUrl($id)
    {
        $url = SitemapUrl::findOrFail($id);
        $url->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.sitemap.index')->with($notification);
    }
}
