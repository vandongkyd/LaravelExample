<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Model\Customer;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request){
        $validation = Validator::make($request->post(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $customer = Customer::where('email', '=' ,$request->input('email'))
            ->where('del_flg', '=', Customer::DEl_FLG)
            ->first();

        if ($customer) {
            if ($customer instanceof Customer) {
                $sendMail = new ForgotPasswordMail();
                $sendMail->setId(base64_encode("PLAYTHING_".$customer->getId()));
                Mail::to($customer->getEmail())->send($sendMail);
            }
        }
        return redirect()->back()->with(["status" => true, "message" => "Link cấp lại mật khẩu đã được gửi đến mail"]);
    }
}
