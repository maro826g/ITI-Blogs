<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\post;
class postController extends Controller
{
  
    public function index()
    {
      
       $posts = post::all(); 

        return view('posts.index', ['posts' => $posts]);
       
    }
    public function show($id)
    {
       
        $post = post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    function create(){
        return view('posts.create');
    }

     public function store(Request $request) {
    
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|unique:posts',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048' //edit
        ]);
        
        $imageName = "error404.jpg";

      
        if ($request->hasFile('image')) {
         
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $request->file('image')->getPathname());
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            if (!in_array($mime, $allowedMimes)) {
                return back()->withErrors(['image' => 'Invalid file type!']);
            }

           
            $imageName = $request->file('image')->hashName();
            $request->file('image')->storeAs('uploads', $imageName, 'public');
        }
        Post::create([  
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]); 
        return redirect()->route('posts.index');
    
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);
    
        $post = Post::findOrFail($id);
    
        if ($request->hasFile('image')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $request->file('image')->getPathname());
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    
            if (!in_array($mime, $allowedMimes)) {
                return back()->withErrors(['image' => 'Invalid file type!']);
            }
    
           
            if ($post->image && $post->image !== 'error404.jpg') {
                \Storage::disk('public')->delete('uploads/' . $post->image);
            }
    
            $imageName = $request->file('image')->hashName();
            $request->file('image')->storeAs('uploads', $imageName, 'public');
        }
    
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);
    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }
    
    
    
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
       
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }

}