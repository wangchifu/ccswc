<?php

namespace App\Http\Controllers;

use App\Models\User;

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
        return view('index');
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
}
