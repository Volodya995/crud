<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->paginate(8),
            'count' => Post::onlyTrashed()->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Post::create($this->validatePost($request));

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return Application|Factory|View
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $post->update($this->validatePost($request));
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }

    /**
     * Search data
     *
     * @param Request $request
     */
    public function search(Request $request)
    {
        if (empty($request->search)) {
            return redirect()->route('posts.index');
        }

        $posts = Post::where('title', 'like', '%' . $request->search . '%')->simplePaginate(5);
        return view('posts.search', ['posts' => $posts]);
    }

    /**
     * Display SoftDeleted data
     *
     * @return Application|Factory|View
     */
    public function showDeletedPosts()
    {
        return view('posts.deleted', ['posts' => Post::latest()->onlyTrashed()->simplePaginate(7)]);
    }

    /**
     * Delete SoftDeleted data
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Post::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }

    /**
     * Recover SoftDeleted data
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function recover($id)
    {
        Post::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }

    /**
     * Validate data
     *
     * @param Request $request
     * @return array
     */
    private function validatePost(Request $request)
    {
        return $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:255',
            'price' => 'required|numeric'
        ]);
    }
}
