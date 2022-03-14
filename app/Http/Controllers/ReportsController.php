<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Report;
use App\Models\Question;

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


        $reports = Report::where('user_id',auth()->user()->id)
            ->orderBy('situation')    
            ->orderBy('updated_at','DESC')    
            ->orderBy('passed_at')
            ->orderBy('id','DESC')
            ->paginate(10);

        $data = [
            'situations'=>$situations,
            'unreview_posts'=>$unreview_posts,
            'unpass_posts'=>$unpass_posts,
            'reports'=>$reports,
        ];
        return view('reports.index',$data);
    }

    public function create(){
        $communities = config('ccswc.communities');
        $question_types = config('ccswc.question_types');
        $data = [
            'communities' => $communities,
            'question_types'=>$question_types,
        ];
        return view('reports.create',$data);
    }

    public function store(Request $request)
    {
        $att['user_id'] = auth()->user()->id;
        $att['for_schools'] = serialize($request->input('schools'));
        $att['title'] = $request->input('title');
        $att['die_date'] = $request->input('die_date');
        $att['content'] = $request->input('content');
        $att['situation'] = 1;
        $report = Report::create($att);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                ];
                $file->storeAs('public/reports/'.$report->id, $info['original_filename']);
                
            }
        }

        foreach($request->input('question_title') as $k=>$v){
            $att2['title'] = $v;
            $type = $request->input('question_type');
            $att2['type'] = $type[$k];
            if($att2['type']=="radio" or $att2['type'] == "checkbox"){
                $options = serialize($request->input('option'.$k));
            }elseif($att2['type']=="text" or $att2['type']=="num"){
                $options = null;
            }
            $att2['options'] = $options;

            $att2['report_id'] = $report->id;
            $att2['show'] = 1;
            Question::create($att2);
        }


        return redirect()->route('reports.index');
    }

    public function edit(Report $report)
    {
        $communities = config('ccswc.communities');
        $question_types = config('ccswc.question_types');
        $files = (file_exists(storage_path('app/public/reports/'.$report->id)))?
            get_files(storage_path('app/public/reports/'.$report->id)):"";
        $data = [
            'communities' => $communities,
            'question_types'=>$question_types,
            'report'=>$report,
            'files'=>$files,
        ];
        return view('reports.edit',$data);
    }

    public function update(Request $request,Report $report)
    {        
        $att['for_schools'] = serialize($request->input('schools'));
        $att['title'] = $request->input('title');
        $att['die_date'] = $request->input('die_date');
        $att['content'] = $request->input('content');
        $att['situation'] = 1;
        $report->update($att);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                ];
                $file->storeAs('public/reports/'.$report->id, $info['original_filename']);
                
            }
        }

        //原先所有的題目先軟刪除
        $a['show'] = 0;
        $qs = Question::where('report_id',$report->id)->update($a);


        foreach($request->input('question_title') as $k=>$v){
            $att2['title'] = $v;
            $type = $request->input('question_type');
            $att2['type'] = $type[$k];
            if($att2['type']=="radio" or $att2['type'] == "checkbox"){
                $options = serialize($request->input('option'.$k));
            }elseif($att2['type']=="text" or $att2['type']=="num"){
                $options = null;
            }
            $att2['options'] = $options;

            $att2['report_id'] = $report->id;
            $att2['show'] = 1;
            Question::create($att2);
        }


        return redirect()->route('reports.index');
    }

    public function delete_file($report_id,$filename)
    {
        if(file_exists(storage_path('app/public/reports/'.$report_id.'/'.$filename))){
            unlink(storage_path('app/public/reports/'.$report_id.'/'.$filename));
        }
        return redirect()->route('reports.edit',$report_id);
    }

    public function delete(Report $report)
    {
        if($report->user_id == auth()->user()->id){
            Question::where('report_id',$report->id)->delete();
            $report->delete();
        }
        return redirect()->route('reports.index');
    }

    public function trash(Report $report)
    {
        if($report->user_id == auth()->user()->id){
            $att['situation'] = 3;        
            $report->update($att);
        }
        return redirect()->route('reports.index');
    }


}
