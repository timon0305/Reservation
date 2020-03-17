<?php

namespace App\Http\Middleware;

use App\Http\SendEmail;
use App\Model\User;
use Closure;
use Auth;
class UserEmailVerification
{
    use SendEmail;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && !Auth::user()->email_verified) {

            // sending verification code in email...
            if (!Auth::user()->email_send) {
                $to = Auth::user()->email;
                $name = Auth::user()->name;
                $subject = "Email verification code";
                $message = "Your verification code is: " . Auth::user()->email_verified_code;
               $this->sendEmail( $to, $name, $subject, $message);

                // making the 'email_sent' 1 after sending mail...
                $emp = User::find(Auth::user()->id);
                $emp->email_send = 1;
                $emp->save();
            }
            return redirect()->guest(route('user.showEmailVerForm'));
        }
        return $next($request);
    }
}
