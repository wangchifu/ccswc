<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseSeason;
use Rap2hpoutre\FastExcel\FastExcel;

class DataController extends Controller
{
    public function course_index()
    {
        $communities = config('ccswc.communities');
        $data= [
            'communities'=>$communities,
        ];
        return view('courses.index',$data);
    }

    public function course_create()
    {
        $communities = config('ccswc.communities');
        $data= [
            'communities'=>$communities,
        ];
        return view('courses.create',$data);
    }

    public function course_store(Request $request)
    {
        $att['year'] = $request->input('year');
        $att['season'] = $request->input('season');
        $att['start_date'] = $request->input('start_date');
        $att['code'] = auth()->user()->code;
        $att['user_id'] = auth()->user()->id;

        $course_season = CourseSeason::where('year',$att['year'])
        ->where('season',$att['season'])
        ->where('code',$att['code'])
        ->first();
        if(empty($course_season)){
            $course_season = CourseSeason::create($att);
        }

        $att2['course_season_id'] = $course_season->id;
        $att2['code'] = auth()->user()->code;
        $att2['user_id'] = auth()->user()->id;

        if($request->hasFile('file')){
            $file = $request->file('file');
            $collection = (new FastExcel)->import($file);
            foreach($collection as $line){
                $att2['type'] = $line['課程類型'];
                $att2['name'] = $line['課程名稱'];
                $att2['place'] = $line['上課地點'];
                $att2['hour'] = $line['學分'];
                $att2['teacher'] = $line['授課教師'];
                $att2['time'] = $line['上課時間'];
                $att2['students'] = $line['學員總數'];
                $att2['situation'] = $line['狀態(學員總數>=9)'];
                Course::create($att2);
            }
        }

    }
}
