<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Post;
use App\Models\PostSchool;
use App\Models\Question;
use App\Models\Report;
use App\Models\ReportSchool;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $situations = config('ccswc.situations');
        $types = config('ccswc.types');

        $unpass_posts = Post::where('user_id', auth()->user()->id)
            ->where(function ($query) {
                $query->where('situation', '0');
                $query->orwhere('situation', '1');
            })->count();

        $unreview_posts = Post::where('situation', '1')
        ->count();

        $unpass_reports = Report::where('user_id', auth()->user()->id)
            ->where(function ($query) {
                $query->where('situation', '0');
                $query->orwhere('situation', '1');
            })->count();

        $unreview_reports = Report::where('situation', '1')
        ->count();

        $reports = Report::where('user_id', auth()->user()->id)
            ->orderBy('situation')
            ->orderBy('updated_at', 'DESC')
            ->orderBy('passed_at')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $data = [
            'situations' => $situations,
            'types' => $types,
            'unreview_posts' => $unreview_posts,
            'unpass_posts' => $unpass_posts,
            'unreview_reports' => $unreview_reports,
            'unpass_reports' => $unpass_reports,
            'reports' => $reports,
        ];

        return view('reports.index', $data);
    }

    public function create()
    {
        $communities = config('ccswc.communities');
        $question_types = config('ccswc.question_types');
        $data = [
            'communities' => $communities,
            'question_types' => $question_types,
        ];

        return view('reports.create', $data);
    }

    public function store(Request $request)
    {
        $att['user_id'] = auth()->user()->id;
        $att['for_schools'] = serialize($request->input('schools'));
        $att['title'] = $request->input('title');
        $att['die_date'] = $request->input('die_date');
        $att['content'] = $request->input('content');
        $att['situation'] = 1;
        $att['type'] = $request->input('type');

        $report = Report::create($att);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                ];
                $file->storeAs('public/reports/'.$report->id, $info['original_filename']);
            }
        }

        foreach ($request->input('question_title') as $k => $v) {
            $att2['title'] = $v;
            $type = $request->input('question_type');
            $att2['type'] = $type[$k];
            if ($att2['type'] == 'radio' or $att2['type'] == 'checkbox') {
                $options = serialize($request->input('option'.$k));
            } elseif ($att2['type'] == 'text' or $att2['type'] == 'num') {
                $options = null;
            }
            $att2['options'] = $options;

            $att2['report_id'] = $report->id;
            $att2['show'] = 1;
            Question::create($att2);
        }

        return redirect()->route('reports.index');
    }

    public function show(Report $report)
    {
        $communities = config('ccswc.communities');
        $categories = config('ccswc.categories');
        $situations = config('ccswc.situations');
        $types = config('ccswc.types');
        $for_schools = unserialize($report->for_schools);

        $data = [
            'report' => $report,
            'communities' => $communities,
            'categories' => $categories,
            'situations' => $situations,
            'types' => $types,
            'for_schools' => $for_schools,
        ];

        return view('reports.show', $data);
    }

    public function edit(Report $report)
    {
        $communities = config('ccswc.communities');
        $question_types = config('ccswc.question_types');
        $files = (file_exists(storage_path('app/public/reports/'.$report->id))) ?
            get_files(storage_path('app/public/reports/'.$report->id)) : '';
        $data = [
            'communities' => $communities,
            'question_types' => $question_types,
            'report' => $report,
            'files' => $files,
        ];

        return view('reports.edit', $data);
    }

    public function update(Request $request, Report $report)
    {
        $att['for_schools'] = serialize($request->input('schools'));
        $att['title'] = $request->input('title');
        $att['die_date'] = $request->input('die_date');
        $att['content'] = $request->input('content');
        $att['situation'] = 1;
        $att['type'] = $request->input('type');
        $report->update($att);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                ];
                $file->storeAs('public/reports/'.$report->id, $info['original_filename']);
            }
        }

        //原先所有的題目先軟刪除
        /*
        $a['show'] = 0;
        $qs = Question::where('report_id',$report->id)->update($a);
        */
        Question::where('report_id', $report->id)->delete();

        foreach ($request->input('question_title') as $k => $v) {
            $att2['title'] = $v;
            $type = $request->input('question_type');
            $att2['type'] = $type[$k];
            if ($att2['type'] == 'radio' or $att2['type'] == 'checkbox') {
                $options = serialize($request->input('option'.$k));
            } elseif ($att2['type'] == 'text' or $att2['type'] == 'num') {
                $options = null;
            }
            $att2['options'] = $options;

            $att2['report_id'] = $report->id;
            $att2['show'] = 1;
            Question::create($att2);
        }

        return redirect()->route('reports.index');
    }

    public function delete_file($report_id, $filename)
    {
        if (file_exists(storage_path('app/public/reports/'.$report_id.'/'.$filename))) {
            unlink(storage_path('app/public/reports/'.$report_id.'/'.$filename));
        }

        return redirect()->route('reports.edit', $report_id);
    }

    public function delete(Report $report)
    {
        if ($report->user_id == auth()->user()->id) {
            Question::where('report_id', $report->id)->delete();
            $report->delete();
        }

        return redirect()->route('reports.index');
    }

    public function trash(Report $report)
    {
        if ($report->user_id == auth()->user()->id) {
            $att['situation'] = 3;
            $report->update($att);
        }

        return redirect()->route('reports.index');
    }

    public function review()
    {
        $reports = Report::where('situation', '1')
            ->orderBy('updated_at', 'DESC')
            ->get();

        $unpass_posts = Post::where('user_id', auth()->user()->id)
        ->where(function ($query) {
            $query->where('situation', '0');
            $query->orwhere('situation', '1');
        })->count();

        $unreview_posts = Post::where('situation', '1')
        ->count();

        $unpass_reports = Report::where('user_id', auth()->user()->id)
            ->where(function ($query) {
                $query->where('situation', '0');
                $query->orwhere('situation', '1');
            })->count();

        $unreview_reports = Report::where('situation', '1')
        ->count();

        $categories = config('ccswc.categories');
        $situations = config('ccswc.situations');
        $types = config('ccswc.types');
        $data = [
            'reports' => $reports,
            'categories' => $categories,
            'situations' => $situations,
            'types' => $types,
            'unreview_posts' => $unreview_posts,
            'unpass_posts' => $unpass_posts,
            'unreview_reports' => $unreview_reports,
            'unpass_reports' => $unpass_reports,
        ];

        return view('reports.review', $data);
    }

    public function back(Report $report)
    {
        $att['situation'] = 0;
        $att['passed_at'] = date('Y-m-d H:i:s');
        $report->update($att);

        return redirect()->route('reports.review');
    }

    public function pass(Report $report)
    {
        $att['situation'] = 2;
        $att['passed_at'] = date('Y-m-d H:i:s');
        $report->update($att);

        $for_schools = unserialize($report->for_schools);
        if (!empty($for_schools)) {
            foreach ($for_schools as $k => $v) {
                $att2['report_id'] = $report->id;
                $att2['code'] = $k;
                ReportSchool::create($att2);
            }
        }

        return redirect()->route('reports.review');
    }

    public function school_index()
    {
        $report_schools = ReportSchool::where('code', auth()->user()->code)
            ->orderBy('id', 'DESC')
            ->get();

        $unsign_posts = PostSchool::where('code', auth()->user()->code)
        ->where('signed_at', null)
        ->count();

        $unsign_reports = ReportSchool::where('code', auth()->user()->code)
        ->where('signed_at', null)
        ->count();

        $categories = config('ccswc.categories');
        $types = config('ccswc.types');
        $data = [
            'report_schools' => $report_schools,
            'unsign_posts' => $unsign_posts,
            'unsign_reports' => $unsign_reports,
            'categories' => $categories,
            'types' => $types,
        ];

        return view('reports.school_index', $data);
    }

    public function school_show(Report $report)
    {
        $situations = config('ccswc.situations');
        $types = config('ccswc.types');
        $report_school = ReportSchool::where('code', auth()->user()->code)
        ->where('report_id', $report->id)
        ->first();

        $data = [
            'report' => $report,
            'report_school' => $report_school,
            'situations' => $situations,
            'types' => $types,
        ];

        return view('reports.school_show', $data);
    }

    public function school_sign(Request $request, ReportSchool $report_school)
    {
        if ($report_school->code == auth()->user()->code) {
            $att['situation'] = 1;
            $att['signed_user_id'] = auth()->user()->id;
            $att['signed_at'] = date('Y-m-d H:i:s');
            $report_school->update($att);
        }

        $answer = $request->input('answer');

        foreach ($request->input('type') as $k => $v) {
            if ($v == 'checkbox') {
                $att2['answer'] = '';
                if (!empty($request->input('answer_checkbox'.$k))) {
                    $att2['answer'] = serialize($request->input('answer_checkbox'.$k));
                }
            } else {
                $att2['answer'] = $answer[$k];
            }
            $att2['report_id'] = $report_school->report_id;
            $att2['question_id'] = $k;
            $att2['report_school_id'] = $report_school->id;
            $att2['code'] = auth()->user()->code;
            Answer::create($att2);
        }
        echo '<img src="'.asset('images/ok.png').'" width="32"> 儲存完畢，請按右上角 X 關閉子視窗。 <img src="'.asset('images/cross.png').'" width="32">';
    }
}
