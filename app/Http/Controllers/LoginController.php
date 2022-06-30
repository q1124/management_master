<?php

namespace App\Http\Controllers;

use App\Mail\Forgot;
use App\Mail\Register;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function postLogin(Request $request): RedirectResponse
    {
        $data = $request->all();

        $user = User::where('account', $data['account'])->first();
        if (!$user) {
            return back();
        }

        if ($user->role == 1) {
            $credentials = User::where('account', $data['account'])
                ->where('password', $data['password'])
                ->first();
            if ($credentials && $credentials->email_verified_at != null) {
                Auth::login($credentials);
                $current_user = Auth::user();
                \Session::put('admin_user', $current_user);
                return redirect('member');
            } else {
                return back();
            }
        } elseif ($user->role == 99) {
            //$credentials = $request->only('account', 'password');
            //if(Auth::attempt($credentials)){
            $credentials = User::where('account', $data['account'])
                ->where('password', $data['password'])
                ->first();
            // dd($credentials);
            if ($credentials) {
                Auth::login($credentials);
                return redirect('admin');
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        //Create token
        $token = Str::random(32);

        $mail_data['url'] = url('/verify?account=' . $data['account'] . '&token=' . $token);
        //$mail_data['email'] = $mail_data['account'];
//        Mail::to($mail_data['email'])
//            ->send(new Register($mail_data));


        $data['token'] = $token;
        $data['role'] = 1;
        $user = new User();
        $user->fill($data);
        $user->save();


        return back();
    }

    public function getVerify(Request $request)
    {
        $data = $request->all();
        $user = User::where('account', $data['account'])
            ->where('token', $data['token'])
            ->update(['email_verified_at' => date('Y-m-d H:i:s')]);
        $user = User::where('account', $data['account'])->first();
        Auth::login($user);
        \Session::put('admin_user', $user);
        return redirect('member');
    }

    public function postForgot(Request $request)
    {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            return back();
        }
        $new_password = Str::random(16);
        User::where('email', $data['email'])->update(['password' => $new_password]);
        $data['new_password'] = $new_password;
        Mail::to($data['email'])
            ->send(new Forgot($data));

        return back()->with('create', true);
    }
}
