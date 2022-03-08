<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Report;

class ReportsController extends Controller
{
    public function index()
    {
        $situations = config('ccswc.situations');

        $unreview_posts = Post::where('situation','1')
        ->count();

        $unpass_posts = Post::where('user_id',auth()->user()->id)
        ->where(function($query){
            $query->where('situation','0');
            $query->orwhere('situation','1');
        })->count();

        $data = [
            'situations'=>$situations,
            'unreview_posts'=>$unreview_posts,
            'unpass_posts'=>$unpass_posts,
        ];
        return view('reports.index',$data);
    }
}
