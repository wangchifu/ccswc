<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseSeason;
use Rap2hpoutre\FastExcel\FastExcel;

class DataController extends Controller
{
    public function course_index($code = null)
    {
        if (empty($code)) {
            $courses = Course::orderBy('course_season_id', 'DESC')
                ->orderBy('code')
                ->paginate(20);
        } else {
            $courses = Course::where('code', $code)
                ->orderBy('course_season_id', 'DESC')
                ->paginate(20);
        }
        $communities = config('ccswc.communities');

        $class_situations = [
            0 => '無資料',
            1 => '開課成功',
            2 => '開課不成功',
        ];

        $seasons = [
            '1' => '春季班',
            '2' => '秋季班',
        ];

        $data = [
            'code' => $code,
            'communities' => $communities,
            'seasons' => $seasons,
            'class_situations' => $class_situations,
            'courses' => $courses,
        ];
        return view('courses.index', $data);
    }

    public function course_create()
    {
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
        ];
        return view('courses.create', $data);
    }

    public function course_store(Request $request)
    {
        $att['year'] = $request->input('year');
        $att['season'] = $request->input('season');
        $att['start_date'] = $request->input('start_date');
        $att['code'] = auth()->user()->code;
        $att['user_id'] = auth()->user()->id;

        $course_season = CourseSeason::where('year', $att['year'])
            ->where('season', $att['season'])
            ->where('code', $att['code'])
            ->first();
        if (empty($course_season)) {
            $course_season = CourseSeason::create($att);
        }

        $att2['course_season_id'] = $course_season->id;
        $att2['code'] = auth()->user()->code;
        $att2['user_id'] = auth()->user()->id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $collection = (new FastExcel)->import($file);
            foreach ($collection as $line) {
                $att2['type'] = $line['課程類型'];
                $att2['name'] = $line['課程名稱'];
                $att2['place'] = $line['上課地點'];
                $att2['hour'] = $line['學分'];
                $att2['teacher'] = $line['授課教師'];
                $att2['time'] = $line['上課時間'];
                $att2['students'] = (empty($line['學員總數'])) ? 0 : $line['學員總數'];
                $att2['situation'] = (empty($line['狀態(學員總數>=9)'])) ? 0 : $line['狀態(學員總數>=9)'];
                Course::create($att2);
            }
        }

        return redirect()->route('courses.index');
    }
}
