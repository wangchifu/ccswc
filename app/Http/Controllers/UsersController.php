<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('disable')->get();
        $communities = config('ccswc.communities');
        $data = [
            'users' => $users,
            'communities' => $communities,
        ];

        return view('users.index', $data);
    }

    public function create()
    {
        $communities = config('ccswc.communities');
        
        $data = [
        'communities' => $communities,
        ];

        return view('users.create', $data);
    }

    public function store(Request $request)
    {
            $att = $request->all();
            $att['password'] = bcrypt(env('DEFAULT_PWD'));
            $att['login_type'] = "local";
            User::create($att);
            return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $communities = config('ccswc.communities');

        $data = [
        'communities' => $communities,
        'user'=>$user,
        ];

        return view('users.edit', $data);
    }

    public function update(Request $request,User $user)
    {
        $att = $request->all();
        $att['admin'] = (isset($att['admin']))?$att['admin']:null;
        $att['school_admin'] = (isset($att['school_admin']))?$att['school_admin']:null;
        $user->update($att);
        return redirect()->route('users.index');
    }

    public function able(User $user)
    {
        $att['disable'] = ($user->disable)?null:1;
        $user->update($att);

        return redirect()->route('users.index');
    }

    public function back_pwd(User $user)
    {
        $att['password'] = bcrypt(env('DEFAULT_PWD'));
        $user->update($att);
        return redirect()->route('users.index');
    }

    public function reset_pwd(){
        return view('users.reset_pwd');
    }

    public function update_pwd(Request $request)
    {
        //$request->validate([
        //    'password1'=>'required|same:password2'
        //]);
    
        if($request->input('password1') <> $request->input('password2')){
            return back()->withErrors('兩次新密碼不同');
        }

        if(password_verify($request->input('password'), auth()->user()->password)){
            $att['password'] = bcrypt($request->input('password1'));
            User::where('id',auth()->user()->id)->update($att);
            return redirect()->route('index');
        }else{
            return back()->withErrors('舊密碼錯誤');
        }

    }

    
}
