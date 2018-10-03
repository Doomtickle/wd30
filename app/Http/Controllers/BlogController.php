<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class BlogController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blog::latest()->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'file' => 'required|image'
        ]);

        $path = request()->file('file')->store('/blog_photos', 'public');

        if (Auth::check()) {
            return Blog::create([
                'title'               => $request->title,
                'body'                => $request->body,
                'featured_photo_path' => $path,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $createdAt = \Carbon\Carbon::parse($blog->created_at)->toW3cString();

        SEOMeta::setTitle($blog->title);
        SEOMeta::setDescription($blog->metaDescription());

        OpenGraph::setDescription($blog->metaDescription());
        OpenGraph::setTitle($blog->title);
        OpenGraph::setUrl(url()->current());

        OpenGraph::addImage(asset('storage/' . $blog->featured_photo_path));

        return view('blogs.single', compact('blog'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'max:255',
            'file'  => 'image'
        ]);
        $title = $request->title ?? $blog->title;
        $body = $request->body ?? $blog->body;
        $path = isset($request->file) ? request()->file('file')->store('/blog_photos', 'public') : $blog->featured_photo_path;

        if (Auth::check()) {
            $blog->update([
                'title'               => $title,
                'body'                => $body,
                'featured_photo_path' => $path,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if (Auth::check()) {
            $blog->deletePhoto();
            $blog->delete();
        }
    }
}
