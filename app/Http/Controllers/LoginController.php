<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function mlogin()
    {
        return view('auth.mlogin');
    }

    public function logins()
    {
        return view('auth.logins');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        //$schools = config('antidrug.schools');
        if ($request->input('chaptcha') != session('chaptcha')) {
            return redirect()->route('logins')->withErrors(['error' => '驗證碼錯誤']);
        }

        if ($request->input('login_type') == 'gsuite') {
            $codes = config('ccswc.codes');

            //檢驗gsuite帳密
            $data = ['email' => $request->input('username'), 'password' => $request->input('password')];
            $data_string = json_encode($data);
            $ch = curl_init(env('AUTH_URL'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string),
                    'AUTHKEY: ' . env('AUTH_KEY')
                )
            );
            /*
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Content-Length: '.strlen($data_string), ]
            );
            */
            $result = curl_exec($ch);
            $obj = json_decode($result, true);

            //dd($obj);

            if ($obj['success']) {
                //非教職員，即跳開
                if ($obj['kind'] == '學生') {
                    return redirect()->route('logins')->withErrors(['error' => '學生不能登入']);
                }

                //是否已有此帳號
                $u = explode('@', $request->input('username'));
                $username = $u[0];

                $user = User::where('username', $username)
                    ->where('login_type', 'gsuite')
                    ->first();

                if (empty($user)) {
                    //無使用者，即建立使用者資料
                    $att['username'] = $username;
                    $att['name'] = $obj['name'];
                    $att['password'] = bcrypt($request->input('password'));
                    $att['personid'] = $obj['edu_key'];
                    $att['code'] = $obj['code'];
                    $att['kind'] = $obj['kind'];
                    $att['title'] = $obj['title'];
                    $att['login_type'] = 'gsuite';

                    if ($obj['code'] == '079998' or $obj['code'] == '079999' or in_array($obj['code'], $codes)) {
                        $user = User::create($att);
                    } else {
                        return redirect()->route('logins')->withErrors(['error' => '只有縣府及社大人員可登入']);
                    }
                } else {
                    //非教職員，即跳開
                    if ($user->disable == 1) {
                        return redirect()->route('logins')->withErrors(['error' => '你被停用了']);
                    }
                    //有此使用者，即更新使用者資料
                    $att['name'] = $obj['name'];
                    $att['password'] = bcrypt($request->input('password'));
                    $att['personid'] = $obj['edu_key'];
                    $att['code'] = $obj['code'];
                    $att['kind'] = $obj['kind'];
                    $att['title'] = $obj['title'];

                    $user->update($att);
                }
            } else {
                return redirect()->route('logins')->withErrors(['error' => 'GSuite認證錯誤']);
            }
        } elseif ($request->input('login_type') == 'local') {
            //是否已有此帳號
            $u = explode('@', $request->input('username'));
            $username = $u[0];

            $user = User::where('username', $username)
                ->where('login_type', 'local')
                ->first();
            if (empty($user)) {
                return redirect()->route('logins')->withErrors(['error' => '本機帳號密碼錯誤']);
            } else {
                if ($user->disable == 1) {
                    return redirect()->route('logins')->withErrors(['error' => '你被停用了']);
                }
            }
        }
        //登入
        if (Auth::attempt(['username' => $username, 'password' => $request->input('password')])) {
            if ($request->input('login_type') == 'gsuite') {
                if (in_array($obj['code'], $codes)) return redirect()->route('posts.school_index');
                if ($obj['code'] == '079998' or $obj['code'] == '079999') return redirect()->route('posts.index');
            } else {
                return redirect()->route('index');
            }
        } else {
            return redirect()->route('logins')->withErrors(['error' => '帳號密碼錯誤']);
        }
    }

    public function logout()
    {
        auth()->logout();

        $url = "https://chc.sso.edu.tw/oidc/v1/logout-to-go";
        $post_logout_redirect_uri = env('APP_URL');
        $id_token_hint = session('id_token');
        $link = $url . "?post_logout_redirect_uri=".$post_logout_redirect_uri."&id_token_hint=" . $id_token_hint;
        return redirect($link);
    }
}
