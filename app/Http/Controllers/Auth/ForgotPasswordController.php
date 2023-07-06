<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public function showForgetPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users',]);
        $token = Str::random(128);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('mails.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('RESTABLECIMIENTO DE CONTRASEÑA EN CISGE');
        });

        flash()->success('<b>¡FELICITACIONES!</b> Se ha enviado con éxito el link de restablecimiento de tu contraseña, revisa la bandeja de tu correo para continuar con el proceso.');
        return back();
    }

    public function showResetPasswordForm($token) {
        return view('auth.reset-password', ['token' => $token]);
    }


    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();

        if(!$updatePassword){
            flash()->error('<b>¡UPS!</b> El token no es válido para hacer el restablecimiento de contraseña.');
            return redirect()->back()->withInput($request->all());
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        flash()->success('<b>¡FELICITACIONES!</b> Tú contraseña se restableció con éxito.');
        return redirect()->route('login');
    }
}
