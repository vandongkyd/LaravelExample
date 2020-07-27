<?php


namespace App\Repository\Shop;


use App\Mail\ChangePasswordMail;
use App\Model\Customer;
use App\ServiceIml\Shop\InfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InfoRepository implements InfoService
{

    function changePassword(Request $request)
    {
        $validation = $this->validation($request);
        if ($validation->fails()){
            return [
                "status" => false,
                "validate" => $validation
            ];
        }
        $customer = $this->fetchById($request->get("id"));
        if ($customer instanceof Customer){
            $customer->setPassword(bcrypt($request->get("password_new")));

            $sendMail = new ChangePasswordMail();
            $sendMail->setFullName($customer->getFullName());
            $sendMail->setPassword($request->get("password_new"));
            Mail::to($customer->getEmail())->send($sendMail);
            if (!Mail::failures()) {
                $customer->save();
            }
        }

        return [
            "status" => true,
        ];
    }

    function fetchById($id)
    {
        return Customer::findOrFail($id);
    }

    function validation(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'password_new' => [
                'required', 'string', 'min:8'
            ],
            'password_confirm' => [
                'required', 'string', 'min:8', 'same:password_new'
            ]
        ]);

        return $validation;
    }
}
