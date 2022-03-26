<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseSeason;
use App\Models\Staff;
use App\Models\StaffSeason;
use App\Models\Teacher;
use App\Models\TeacherSeason;
use App\Models\Student;
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
        $codes = config('ccswc.codes');

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
            'codes' => $codes,
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

    public function course_create_one(CourseSeason $course_season)
    {
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
            'course_season' => $course_season,
        ];
        return view('courses.create_one', $data);
    }

    public function course_store_one(Request $request)
    {
        $att = $request->all();
        $att['code'] = auth()->user()->code;
        $att['user_id'] = auth()->user()->id;

        Course::create($att);

        return redirect()->route('courses.index');
    }

    public function course_edit_one(Course $course)
    {
        if ($course->code != auth()->user()->code) {
            return back();
        }
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
            'course' => $course,
        ];
        return view('courses.edit_one', $data);
    }

    public function course_update_one(Request $request, Course $course)
    {
        if ($course->code != auth()->user()->code) {
            return back();
        }

        $att = $request->all();

        $course->update($att);

        return redirect()->route('courses.index');
    }

    public function course_delete_one(Course $course)
    {
        if ($course->user_id == auth()->user()->id) {
            $course->delete();
        }
        return redirect()->route('courses.index');
    }

    public function staff_index($code = null)
    {
        if (empty($code)) {
            $staffs = Staff::orderBy('staff_season_id', 'DESC')
                ->orderBy('code')
                ->paginate(20);
        } else {
            $staffs = Staff::where('code', $code)
                ->orderBy('staff_season_id', 'DESC')
                ->paginate(20);
        }
        $communities = config('ccswc.communities');
        $codes = config('ccswc.codes');

        $seasons = [
            '1' => '春季班',
            '2' => '秋季班',
        ];

        $data = [
            'code' => $code,
            'communities' => $communities,
            'codes' => $codes,
            'seasons' => $seasons,
            'staffs' => $staffs,
        ];
        return view('staffs.index', $data);
    }

    public function staff_create()
    {
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
        ];
        return view('staffs.create', $data);
    }

    public function staff_store(Request $request)
    {
        $att['year'] = $request->input('year');
        $att['season'] = $request->input('season');
        $att['code'] = auth()->user()->code;
        $att['user_id'] = auth()->user()->id;

        $staff_season = StaffSeason::where('year', $att['year'])
            ->where('season', $att['season'])
            ->where('code', $att['code'])
            ->first();
        if (empty($staff_season)) {
            $staff_season = StaffSeason::create($att);
        }

        $att2['staff_season_id'] = $staff_season->id;
        $att2['code'] = auth()->user()->code;
        $att2['user_id'] = auth()->user()->id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $collection = (new FastExcel)->import($file);
            foreach ($collection as $line) {
                $att2['title'] = $line['職稱'];
                $att2['name'] = $line['姓名'];
                $att2['sex'] = $line['性別'];
                $att2['ps'] = $line['備註'];
                Staff::create($att2);
            }
        }

        return redirect()->route('staffs.index');
    }

    public function staff_create_one(StaffSeason $staff_season)
    {
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
            'staff_season' => $staff_season,
        ];
        return view('staffs.create_one', $data);
    }

    public function staff_store_one(Request $request)
    {
        $att = $request->all();
        $att['code'] = auth()->user()->code;
        $att['user_id'] = auth()->user()->id;

        Staff::create($att);

        return redirect()->route('staffs.index');
    }

    public function staff_edit_one(Staff $staff)
    {
        if ($staff->code != auth()->user()->code) {
            return back();
        }
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
            'staff' => $staff,
        ];
        return view('staffs.edit_one', $data);
    }

    public function staff_update_one(Request $request, Staff $staff)
    {
        if ($staff->code != auth()->user()->code) {
            return back();
        }

        $att = $request->all();

        $staff->update($att);

        return redirect()->route('staffs.index');
    }

    public function staff_delete_one(Staff $staff)
    {
        if ($staff->user_id == auth()->user()->id) {
            $staff->delete();
        }
        return redirect()->route('staffs.index');
    }

    public function teacher_index($code = null)
    {
        if (empty($code)) {
            $teachers = Teacher::orderBy('teacher_season_id', 'DESC')
                ->orderBy('code')
                ->paginate(20);
        } else {
            $teachers = Teacher::where('code', $code)
                ->orderBy('teacher_season_id', 'DESC')
                ->paginate(20);
        }
        $communities = config('ccswc.communities');
        $codes = config('ccswc.codes');

        $seasons = [
            '1' => '春季班',
            '2' => '秋季班',
        ];

        $data = [
            'code' => $code,
            'communities' => $communities,
            'codes' => $codes,
            'seasons' => $seasons,
            'teachers' => $teachers,
        ];
        return view('teachers.index', $data);
    }

    public function teacher_create()
    {
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
        ];
        return view('teachers.create', $data);
    }

    public function teacher_store(Request $request)
    {
        $att['year'] = $request->input('year');
        $att['season'] = $request->input('season');
        $att['code'] = auth()->user()->code;
        $att['user_id'] = auth()->user()->id;

        $teacher_season = TeacherSeason::where('year', $att['year'])
            ->where('season', $att['season'])
            ->where('code', $att['code'])
            ->first();
        if (empty($teacher_season)) {
            $teacher_season = TeacherSeason::create($att);
        }

        $att2['teacher_season_id'] = $teacher_season->id;
        $att2['code'] = auth()->user()->code;
        $att2['user_id'] = auth()->user()->id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $collection = (new FastExcel)->import($file);
            foreach ($collection as $line) {
                $att2['name'] = $line['姓名'];
                $att2['sex'] = $line['性別'];
                $att2['course_name'] = $line['授課課程名稱'];
                $att2['ps'] = $line['備註'];
                Teacher::create($att2);
            }
        }

        return redirect()->route('teachers.index');
    }

    public function teacher_create_one(TeacherSeason $teacher_season)
    {
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
            'teacher_season' => $teacher_season,
        ];
        return view('teachers.create_one', $data);
    }

    public function teacher_store_one(Request $request)
    {
        $att = $request->all();
        $att['code'] = auth()->user()->code;
        $att['user_id'] = auth()->user()->id;

        Teacher::create($att);

        return redirect()->route('teachers.index');
    }

    public function teacher_edit_one(Teacher $teacher)
    {
        if ($teacher->code != auth()->user()->code) {
            return back();
        }
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
            'teacher' => $teacher,
        ];
        return view('teachers.edit_one', $data);
    }

    public function teacher_update_one(Request $request, Teacher $teacher)
    {
        if ($teacher->code != auth()->user()->code) {
            return back();
        }

        $att = $request->all();

        $teacher->update($att);

        return redirect()->route('teachers.index');
    }

    public function teacher_delete_one(Teacher $teacher)
    {
        if ($teacher->user_id == auth()->user()->id) {
            $teacher->delete();
        }
        return redirect()->route('teachers.index');
    }

    public function student_index()
    {
        $students = Student::orderBy('year', 'DESC')
            ->orderBy('code')
            ->paginate(7);
        $communities = config('ccswc.communities');
        $codes = config('ccswc.codes');

        $seasons = [
            '1' => '春季班',
            '2' => '秋季班',
        ];

        $data = [
            'communities' => $communities,
            'codes' => $codes,
            'seasons' => $seasons,
            'students' => $students,
        ];
        return view('students.index', $data);
    }

    public function student_create()
    {
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
        ];
        return view('students.create', $data);
    }

    public function student_store(Request $request)
    {
        $att = $request->all();
        $att['code'] = auth()->user()->code;
        $att['user_id'] = auth()->user()->id;

        Student::create($att);

        return redirect()->route('students.index');
    }

    public function student_edit(Student $student)
    {
        if ($student->code != auth()->user()->code) {
            return back();
        }
        $communities = config('ccswc.communities');
        $data = [
            'communities' => $communities,
            'student' => $student,
        ];
        return view('students.edit', $data);
    }

    public function student_update(Request $request, Student $student)
    {
        if ($student->code != auth()->user()->code) {
            return back();
        }

        $att = $request->all();

        $student->update($att);

        return redirect()->route('students.index');
    }

    public function student_delete(Student $student)
    {
        if ($student->user_id == auth()->user()->id) {
            $student->delete();
        }
        return redirect()->route('students.index');
    }
}
