<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostSchool;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id',auth()->user()->id)
            ->orderBy('updated_at','DESC')    
            ->orderBy('situation')
            ->orderBy('passed_at')
            ->orderBy('id','DESC')
            ->get();
        
        $categories = config('ccswc.categories');
        $situations = config('ccswc.situations');
        $types = config('ccswc.types');
        $data = [
            'posts'=>$posts,
            'categories'=>$categories,
            'situations'=>$situations,
            'types'=>$types,
        ];
        return view('posts.index',$data);
    }

    public function create()
    {
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
        ];
        return view('posts.create',$data);
    }

    public function store(Request $request)
    {
        $att['user_id'] = auth()->user()->id;
        $att['category_id'] = $request->input('category_id');
        $att['title'] = $request->input('title');
        $att['content'] = $request->input('content');
        $att['for_schools'] = null;
        if($att['category_id'] == 2){
            $att['for_schools'] = serialize($request->input('schools'));
        }
        $att['situation'] = 1;
        $att['type'] = $request->input('type');
        $att['views'] = 0;
        
        $post = Post::create($att);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                ];
                $file->storeAs('public/posts/'.$post->id, $info['original_filename']);
                
            }
        }


        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        $communities = config('ccswc.communities');
        $categories = config('ccswc.categories');
        $situations = config('ccswc.situations');
        $types = config('ccswc.types');
        if($post->category_id==2){
            $for_schools = unserialize($post->for_schools);
        }else{
            $for_schools = "公開大眾";
        }
        
        $data = [
            'post'=>$post,
            'communities'=>$communities,
            'categories'=>$categories,
            'situations'=>$situations,
            'types'=>$types,
            'for_schools'=>$for_schools,
        ];
        
        return view('posts.show',$data);
    }

    public function edit(Post $post)
    {
        if(auth()->user()->id != $post->user_id){
            return back();
        }
        if($post->situation == "2" or $post->situation == "3"){
            return back();
        }

        $files = (file_exists(storage_path('app/public/posts/'.$post->id)))?
            get_files(storage_path('app/public/posts/'.$post->id)):"";

        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
            'post'=>$post,
            'files'=>$files,
        ];
        return view('posts.edit',$data);
    }

    public function delete_file($post_id,$filename)
    {
        if(file_exists(storage_path('app/public/posts/'.$post_id.'/'.$filename))){
            unlink(storage_path('app/public/posts/'.$post_id.'/'.$filename));
        }
        return redirect()->route('posts.edit',$post_id);
    }

    public function update(Request $request,Post $post)
    {
        $att['category_id'] = $request->input('category_id');
        $att['title'] = $request->input('title');
        $att['content'] = $request->input('content');
        $att['for_schools'] = null;
        if($att['category_id'] == 2){
            $att['for_schools'] = serialize($request->input('schools'));
        }
        $att['situation'] = 1;
        $att['type'] = $request->input('type');
        
        $post->update($att);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                ];
                $file->storeAs('public/posts/'.$post->id, $info['original_filename']);
                
            }
        }


        return redirect()->route('posts.index');
    }

    public function delete(Post $post)
    {
        if(auth()->user()->id != $post->user_id){
            return back();
        }
        if($post->situation == "2" or $post->situation == "3"){
            return back();
        }

        if(file_exists(storage_path('app/public/posts/'.$post->id))){
            deldir(storage_path('app/public/posts/'.$post->id));
        }

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function trash(Post $post)
    {
        $att['situation'] = 3;        
        $post->update($att);

        return redirect()->route('posts.index');
    }

    public function review()
    {
        $posts = Post::where('situation','1')
            ->orderBy('updated_at','DESC')
            ->get();

        $categories = config('ccswc.categories');
        $situations = config('ccswc.situations');
        $types = config('ccswc.types');
        $data = [
            'posts'=>$posts,
            'categories'=>$categories,
            'situations'=>$situations,
            'types'=>$types,
        ];
        
        return view('posts.review',$data);
    }

    public function back(Post $post)
    {
        $att['situation'] = 0;
        $att['passed_at'] = date('Y-m-d H:i:s');
        $post->update($att);
        return redirect()->route('posts.review');
    }

    public function pass(Post $post)
    {
        $att['situation'] = 2;
        $att['passed_at'] = date('Y-m-d H:i:s');
        $post->update($att);

        if($post->category_id == 2){
            $for_schools = unserialize($post->for_schools);
            if(!empty($for_schools)){
                foreach($for_schools as $k=>$v){
                    $att2['post_id'] = $post->id;
                    $att2['code'] = $k;
                    PostSchool::create($att2);
                }
            }
        }

        return redirect()->route('posts.review');
    }


}
