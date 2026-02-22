<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\CustomPage;
use App\Models\Product;
use App\Models\SitemapSetting;
use App\Models\SitemapUrl;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    public function index()
    {
        $settings = SitemapSetting::first();
        if (!$settings) {
            $settings = SitemapSetting::create([]);
        }

        $defaultChangefreq = $settings->default_changefreq ?: 'weekly';
        $defaultPriority = $settings->default_priority ?: 0.7;

        $entries = [];
        $added = [];

        $add = function ($loc, $lastmod = null, $changefreq = null, $priority = null) use (&$entries, &$added, $defaultChangefreq, $defaultPriority) {
            $loc = trim($loc);
            if (!$loc) {
                return;
            }

            if (!Str::startsWith($loc, ['http://', 'https://'])) {
                $loc = url($loc);
            }

            if (isset($added[$loc])) {
                return;
            }
            $added[$loc] = true;

            $entries[] = [
                'loc' => $loc,
                'lastmod' => $lastmod ? Carbon::parse($lastmod)->toAtomString() : null,
                'changefreq' => $changefreq ?: $defaultChangefreq,
                'priority' => $priority !== null ? $priority : $defaultPriority,
            ];
        };

        if ($settings->include_home) {
            $add(url('/'));
        }

        if ($settings->include_services_page) {
            $add(route('front.repair.all'));
        }

        if ($settings->include_categories) {
            $categories = Category::where('status', 1)->get();
            foreach ($categories as $category) {
                $add(route('front.services.category', ['category' => $category->slug]), $category->updated_at);
            }
        }

        if ($settings->include_sub_categories) {
            $subCategories = SubCategory::with('category')->where('status', 1)->get();
            foreach ($subCategories as $subCategory) {
                if ($subCategory->category) {
                    $add(route('front.services.subcategory', [
                        'category' => $subCategory->category->slug,
                        'subcategory' => $subCategory->slug,
                    ]), $subCategory->updated_at);
                }
            }
        }

        if ($settings->include_child_categories) {
            $childCategories = ChildCategory::with(['category','subCategory'])->where('status', 1)->get();
            foreach ($childCategories as $childCategory) {
                $add(route('front.shop', ['slug' => $childCategory->slug]), $childCategory->updated_at);
            }
        }

        if ($settings->include_products) {
            $products = Product::where('status', 1)->get();
            foreach ($products as $product) {
                $add(route('front.single.service', $product->slug), $product->updated_at);
            }
        }

        if ($settings->include_blogs) {
            $blogs = Blog::where('status', 1)->get();
            foreach ($blogs as $blog) {
                $add(route('front.blog_details', $blog->slug), $blog->updated_at);
            }
        }

        if ($settings->include_pages) {
            $pages = CustomPage::where('status', 1)->get();
            foreach ($pages as $page) {
                $add(route('front.customPages', $page->slug), $page->updated_at);
            }
        }

        if ($settings->include_manual) {
            $manualUrls = SitemapUrl::where('status', 1)->get();
            foreach ($manualUrls as $url) {
                $add($url->loc, $url->lastmod, $url->changefreq, $url->priority);
            }
        }

        $xml = view('frontend.sitemap', ['entries' => $entries])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
