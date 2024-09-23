<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function index()
    {
        $currentLocale = app()->getLocale();
        $blogs = Blog::where('lang', $currentLocale)->where('hidden', false)->get();
 
        foreach($blogs as $blog){
        if ($blog->hasMedia('images')) {
            $blog['image'] = $blog->getFirstMediaUrl('images');
           }
        }

        return view('screen.blogs')->with('blogs', $blogs);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        if ($blog->hasMedia('images')) {
            $blog['image'] = $blog->getFirstMediaUrl('images');
        }


        $blogsByTag = $this->getBlogsByTag($blog->tag_name);
        

        return view('screen.blog', compact(['blog', 'blogsByTag']));
    }

    public function getBlogs()
    {
        $currentLocale = app()->getLocale();
        $blogs = Blog::where('lang', $currentLocale)
            ->where('hidden', false)
            ->get()->map(function ($blog) {
                $blog->image_url = $blog->getFirstMediaUrl('images');
                return $blog;
            });
        return response()->json(["blogs" => $blogs], 200);
    }

    private function getBlogsByTag($tag)
    {
        $currentLocale = app()->getLocale();
        $blogs = Blog::where('tag_name', $tag)
            ->where('lang', $currentLocale)
            ->where('hidden', false)
            ->get()->map(function ($blog) {
                $blog->image_url = $blog->getFirstMediaUrl('images');
                return $blog;
            });;

        return $blogs;

        // return response()->json([
        //     'blogs' => $blogs,
        //     200
        // ]);
    }
}
