<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //
    public function index(){
//        $posts = Post::all();
        $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts.index',  ['posts' => $posts ]);
    }
    public function show(Post $post)
    {
        $comments = $post->comments()->whereIsActive(1)->get();

        return view('blog-post', ['post' => $post,'comments'=>$comments ]);
    }

    public function create()
    {
        $this->authorize('create',Post::class);
        return view('admin.posts.create');
    }

    public function store()
    {
        $this->authorize('create',Post::class);
        $inputs = request()->validate([
            'title' => 'required|min:8|max:200',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }
        auth()->user()->posts()->create($inputs);
        session()->flash('post-created' , 'post ' . $inputs['title'] .' has created'  );
        return redirect()->route('post.index');
    }
    public function edit(Post $post){
        $this->authorize('view',$post);
//        if (auth()->user()-can('view',$post)){}
        return view('admin.posts.edit',  ['post' => $post ]);
    }
    public function destroy(Post $post , Request $request){
        $this->authorize('delete',$post);
        $post->delete();
//        Session::flash('message' , 'post has deleted');
        $request->session()->flash('message' , 'post was deleted');
        return back();
    }
    public function update(Post $post){
        $inputs = request()->validate([
            'title' => 'required|min:8|max:200',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        $post->title =  $inputs['title'];
        $post->body =  $inputs['body'];
        $this->authorize('update',$post);
//        auth()->user()->posts()->save($post);
        // if you want save it with the same owner
        $post->save();
        session()->flash('post-updated' , 'post ' . $inputs['title'] .' has updated'  );
        return redirect()->route('post.index');
    }
}
