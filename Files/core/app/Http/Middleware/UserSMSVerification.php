<?php

namespace App\Http\Middleware;

use App\Http\SendSms;
use App\Model\User;
use Closure;
use Auth;
class UserSMSVerification
{
    use SendSms;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && !Auth::user()->sms_verified) {

            // sending verification code in email...
            if (!Auth::user()->sms_send) {
                $to = Auth::user()->phone;
                $message = "Your verification code is: " . Auth::user()->sms_verified_code;
                $this->sendSms( $to, $message);

                // making the 'email_sent' 1 after sending mail...
                $emp = User::find(Auth::user()->id);
                $emp->sms_send = 1;
                $emp->save();
            }


            /*if(session()->has('url.intended')){

                return redirect()->route('user.showSmsVerForm');
            }*/

            return redirect()->guest(route('user.showSmsVerForm'));
        }
        return $next($request);
    }
}
