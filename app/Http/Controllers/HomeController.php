<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Content;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function create_admin()
    {
        $att = [
            'username' => 'admin',
            'password' => bcrypt('demo1234'),
            'login_type' => 'local',
            'name' => '系統管理員',
            'current_team_id' => '1',
        ];
        User::create($att);
    }

    public function index()
    {
        $posts = Post::where('situation', 2)
            ->where('category_id', 1)
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);

        $data = [
            'posts' => $posts,
        ];

        return view('index', $data);
    }

    public function show(Post $post)
    {
        if ($post->category_id == 2) {
            return back();
        }

        $post_key = 'post' . $post->id;
        if (session($post_key) != 1) {
            //更新views的值
            $att['views'] = $post->views + 1;
            $post->update($att);
        }

        session([$post_key => 1]);

        $types = config('ccswc.types');

        $data = [
            'post' => $post,
            'types' => $types,
        ];

        return view('index_show', $data);
    }

    public function pic($d = null)
    {
        if (empty($d)) {
            $key = rand(10000, 99999);
        } else {
            $key = substr($d, 0, 5);
        }
        $back = rand(0, 9);
        /*
        $r = rand(0,255);
        $g = rand(0,255);
        $b = rand(0,255);
        */
        $r = 0;
        $g = 0;
        $b = 0;

        session(['chaptcha' => $key]);

        //$cht = array(0=>"零",1=>"壹",2=>"貳",3=>"參",4=>"肆",5=>"伍",6=>"陸",7=>"柒",8=>"捌",9=>"玖");
        $cht = [0 => '0', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9'];
        $cht_key = '';
        for ($i = 0; $i < 5; ++$i) {
            $cht_key .= $cht[substr($key, $i, 1)];
        }

        header('Content-type: image/gif');
        $im = imagecreatefromgif(asset('images/back/01.gif')) or exit('無法建立GD圖片');
        $text_color = imagecolorallocate($im, $r, $g, $b);

        imagettftext($im, 25, 0, 5, 32, $text_color, public_path('font/AdobeGothicStd-Bold.otf'), $cht_key);
        imagegif($im);
        imagedestroy($im);
    }

    public function impersonate(User $user)
    {
        Auth::user()->impersonate($user);

        return redirect()->route('index');
    }

    public function impersonate_leave()
    {
        Auth::user()->leaveImpersonation();

        return redirect()->route('index');
    }

    public function history_view()
    {
        $history = Content::where('item', 'history')->first();
        if (empty($history->id)) {
            $content = "";
        } else {
            $content = $history->content;
        }
        $data = [
            'content' => $content,
        ];
        return view('contents.history_view', $data);
    }

    public function history_edit()
    {
        $history = Content::where('item', 'history')->first();
        if (empty($history->id)) {
            $content = "";
        } else {
            $content = $history->content;
        }
        $data = [
            'content' => $content,
        ];
        return view('contents.history_edit', $data);
    }

    public function history_store(Request $request)
    {
        $att['item'] = "history";
        $att['content'] = $request->input('content');
        $att['user_id'] = auth()->user()->id;
        $history = Content::where('item', 'history')->first();
        if (empty($history->id)) {
            Content::create($att);
        } else {
            $history->update($att);
        }

        return redirect()->route('history.view');
    }

    public function community_view()
    {
        $communities = config('ccswc.communities');
        $communities_data = Community::all();
        $community_array = [];
        foreach ($communities_data as $community) {
            $community_array[$community->code]['school_name'] = $community->school_name;
            $community_array[$community->code]['telephone_number'] = $community->telephone_number;
            $community_array[$community->code]['unit'] = $community->unit;
            $community_array[$community->code]['website'] = $community->website;
        }
        $data = [
            'communities' => $communities,
            'community_array' => $community_array,
        ];
        return view('communities.view', $data);
    }

    public function community_show($code)
    {
        $communities = config('ccswc.communities');

        $community = Community::where('code', $code)
            ->first();
        $community_array = [];
        if (!empty($community)) {
            $community_array[$community->code]['school_name'] = $community->school_name;
            $community_array[$community->code]['principal_name'] = $community->principal_name;
            $community_array[$community->code]['address'] = $community->address;
            $community_array[$community->code]['telephone_number'] = $community->telephone_number;
            $community_array[$community->code]['fax_number'] = $community->fax_number;
            $community_array[$community->code]['email'] = $community->email;
            $community_array[$community->code]['branch'] = $community->branch;
            $community_array[$community->code]['class_location'] = $community->class_location;
            $community_array[$community->code]['website'] = $community->website;
            $community_array[$community->code]['unit'] = $community->unit;
            $community_array[$community->code]['introduction'] = $community->introduction;
        } else {
            $community_array[$code]['school_name'] = "";
            $community_array[$code]['principal_name'] = "";
            $community_array[$code]['address'] = "";
            $community_array[$code]['telephone_number'] = "";
            $community_array[$code]['fax_number'] = "";
            $community_array[$code]['email'] = "";
            $community_array[$code]['branch'] = "";
            $community_array[$code]['class_location'] = "";
            $community_array[$code]['website'] = "";
            $community_array[$code]['unit'] = "";
            $community_array[$code]['introduction'] = "";
        }

        $data = [
            'code' => $code,
            'community' => $community,
            'communities' => $communities,
            'community_array' => $community_array,
        ];

        return view('communities.show', $data);
    }

    public function community_edit($code)
    {
        if (auth()->user()->social_education <> 1 and auth()->user()->social_education <> 2) {
            if (auth()->user()->code <> $code) {
                if (auth()->user()->school_admin <> '1') {
                    return back();
                }
            }
        }
        $communities = config('ccswc.communities');

        $community = Community::where('code', $code)
            ->first();
        $community_array = [];
        if (!empty($community)) {
            $community_array[$community->code]['school_name'] = $community->school_name;
            $community_array[$community->code]['principal_name'] = $community->principal_name;
            $community_array[$community->code]['address'] = $community->address;
            $community_array[$community->code]['telephone_number'] = $community->telephone_number;
            $community_array[$community->code]['fax_number'] = $community->fax_number;
            $community_array[$community->code]['email'] = $community->email;
            $community_array[$community->code]['branch'] = $community->branch;
            $community_array[$community->code]['class_location'] = $community->class_location;
            $community_array[$community->code]['website'] = $community->website;
            $community_array[$community->code]['unit'] = $community->unit;
            $community_array[$community->code]['introduction'] = $community->introduction;
        } else {
            $community_array[$code]['school_name'] = "";
            $community_array[$code]['principal_name'] = "";
            $community_array[$code]['address'] = "";
            $community_array[$code]['telephone_number'] = "";
            $community_array[$code]['fax_number'] = "";
            $community_array[$code]['email'] = "";
            $community_array[$code]['branch'] = "";
            $community_array[$code]['class_location'] = "";
            $community_array[$code]['website'] = "";
            $community_array[$code]['unit'] = "";
            $community_array[$code]['introduction'] = "";
        }

        $data = [
            'code' => $code,
            'community' => $community,
            'communities' => $communities,
            'community_array' => $community_array,
        ];
        return view('communities.edit', $data);
    }

    public function community_store(Request $request)
    {
        $att = $request->all();
        $check_community = Community::where('code', $request->input('code'))
            ->first();

        if (empty($check_community)) {
            Community::create($att);
        } else {
            $check_community->update($att);
        }
        return redirect()->route('community.show', $request->input('code'));
    }

    public function law_view()
    {
        $laws = Content::where('item', 'law')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $data = [
            'laws' => $laws,
        ];
        return view('contents.law_view', $data);
    }

    public function law_create()
    {
        return view('contents.law_create');
    }

    public function law_store(Request $request)
    {
        $att['content'] = $request->input('content');
        $att['item'] = "law";
        $att['user_id'] = auth()->user()->id;
        $content = Content::create($att);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $info = [
                'mime-type' => $file->getMimeType(),
                'original_filename' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
            ];
            $file->storeAs('public/contents/' . $content->id, $info['original_filename']);
        }

        return redirect()->route('law.view');
    }

    public function law_edit(Content $content)
    {
        $data = [
            'content' => $content,
        ];
        return view('contents.law_edit', $data);
    }

    public function law_update(Request $request, Content $content)
    {
        $att['content'] = $request->input('content');
        $att['item'] = "law";
        $att['user_id'] = auth()->user()->id;
        $content->update($att);
        if ($request->hasFile('file')) {
            //先刪除舊的
            deldir(storage_path('app/public/contents/' . $content->id));

            $file = $request->file('file');
            $info = [
                'mime-type' => $file->getMimeType(),
                'original_filename' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
            ];
            $file->storeAs('public/contents/' . $content->id, $info['original_filename']);
        }

        return redirect()->route('law.view');
    }

    public function law_delete(Content $content)
    {
        //先刪除舊的
        deldir(storage_path('app/public/contents/' . $content->id));
        $content->delete();
        return redirect()->route('law.view');
    }

    public function resource_view()
    {
        $resources = Content::where('item', 'resource')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $data = [
            'resources' => $resources,
        ];
        return view('contents.resource_view', $data);
    }

    public function resource_create()
    {
        return view('contents.resource_create');
    }

    public function resource_store(Request $request)
    {
        $att['content'] = $request->input('content');
        $att['item'] = "resource";
        $att['resource'] = $request->input('resource');
        $att['user_id'] = auth()->user()->id;
        $content = Content::create($att);

        return redirect()->route('resource.view');
    }

    public function resource_edit(Content $content)
    {
        $data = [
            'content' => $content,
        ];
        return view('contents.resource_edit', $data);
    }

    public function resource_update(Request $request, Content $content)
    {
        $att['content'] = $request->input('content');
        $att['item'] = "resource";
        $att['resource'] = $request->input('resource');
        $att['user_id'] = auth()->user()->id;
        $content->update($att);

        return redirect()->route('resource.view');
    }

    public function resource_delete(Content $content)
    {
        $content->delete();
        return redirect()->route('resource.view');
    }

    public function title_image()
    {
        return view('title_image');
    }
    public function title_image_store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $info = [
                'mime-type' => $file->getMimeType(),
                'original_filename' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
            ];
            $file->storeAs('public/title_image/', 'title_image.jpg');
        }

        return redirect()->route('title_image');
    }

    public function title_image_delete()
    {
        if (file_exists(storage_path('app/public/title_image/title_image.jpg'))) {
            unlink(storage_path('app/public/title_image/title_image.jpg'));
        }
        return redirect()->route('title_image');
    }
}
