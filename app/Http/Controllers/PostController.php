<?php
// app/Http/Controllers/ForumController.php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use App\Models\Like; 
use App\Models\Share; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::whereNull('parent')->with('comments.user')->get();
        return view('forum.index', compact('posts'));
    }

    public function show($id_post)
    {
        $post = Post::with('user', 'comments.user', 'images', 'likes', 'shares')->findOrFail($id_post);
        return view('forum.show', compact('post'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images' => 'max:4', 
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'parent' => $request->parent ?? null,
            'id' => Auth::id(),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                Image::create([
                    'url' => Storage::url($path),
                    'id_post' => $post->id_post,
                ]);
            }
        }
        return redirect()->route('forum.index')->with('success', 'Post created successfully!');
    }
    
    public function storeReply(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'parent' => 'required|exists:posts,id_post',
        ]);

        $comment = Post::create([
            'content' => $request->content,
            'parent' => $request->parent,
            'id' => Auth::id(),
        ]);

        $parentPost = Post::find($request->parent);
        while ($parentPost->parent) {
            $parentPost = Post::find($parentPost->parent);
        }

        return redirect()->route('forum.show', $parentPost->id_post)->with('success', 'Reply created successfully!');
    }

    public function like(Request $request)
    {
        $request->validate([
            'id_post' => 'required|exists:posts,id_post',
        ]);

        $existingLike = Like::where('id_post', $request->id_post)
                            ->where('id', Auth::id())
                            ->first();

        if (!$existingLike) {
            Like::create([
                'id_post' => $request->id_post,
                'id' => Auth::id(),
            ]);

            $post = Post::find($request->id_post);

            // Update total_likes
            $post->total_likes = $post->likes()->count();
            $post->save();
        }

        return back()->with('success', 'Post liked!');
    }

    public function share(Request $request)
    {
        $request->validate([
            'id_post' => 'required|exists:posts,id_post',
        ]);

        $existingShare = Share::where('id_post', $request->id_post)
                              ->where('id', Auth::id())
                              ->first();

        if (!$existingShare) {
            Share::create([
                'id_post' => $request->id_post,
                'id' => Auth::id(),
            ]);

            $post = Post::find($request->id_post);

            // Update total_shares
            $post->total_shares = $post->shares()->count();
            $post->save();
        }

        return back()->with('success', 'Post shared!');
    }
}
