<?php


namespace App\Repository\Admin;


use App\Model\Customer;
use App\Model\Member;
use App\ServiceIml\Admin\CustomerService;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerRepository implements CustomerService
{

    function list()
    {
        $customers = Customer::where("del_flg","=", Customer::DEl_FLG)->get();
        return $customers;
    }

    function add(Request $request)
    {
        $validation = $this->validation($request);

        if ($validation->fails()){
            return [
                "status" => false,
                "validate" => $validation
            ];
        }

        $customer = new Customer();
        $customer->setUserName($request->get("user_name"));
        $customer->setFullName($request->get("full_name"));
        $customer->setPassword(bcrypt("plaything123"));
        $customer->setEmail($request->get("email"));
        $customer->setPhone($request->get("phone"));
        $customer->setBirthday($request->get("birthday"));
        $customer->setStatus(Customer::NEW);
        $customer->setSex($request->get("sex"));
        $customer->setDelFlg(Customer::DEl_FLG);
        $customer->setCreated(new \DateTime());
        $customer->setUpdated(new \DateTime());
        $customer->save();

        return [
            "status" => true,
        ];
    }

    function edit(Request $request, $id)
    {
        $validation = $this->validation($request);

        if ($validation->fails()){
            return [
                "status" => false,
                "validate" => $validation
            ];
        }

        $customer = $this->fetchById($id);
        if ($customer instanceof Customer) {
            $customer->setUserName($request->get("user_name"));
            $customer->setFullName($request->get("full_name"));
            $customer->setEmail($request->get("email"));
            $customer->setPhone($request->get("phone"));
            $customer->setStatus($request->get("status"));
            $customer->setBirthday($request->get("birthday"));
            $customer->setSex($request->get("sex"));
            $customer->setUpdated(new \DateTime());
            $customer->save();
        }

        return [
            "status" => true,
        ];
    }

    function delete(Request $request)
    {
        $customer = $this->fetchById($request->get("id"));
        if ($customer instanceof Customer){
            $customer->setDelFlg(Customer::DELETE);
            $customer->setUpdated(new \DateTime());
            $customer->save();
        }

        return [
            "status" => true,
        ];
    }

    function reset(Request $request)
    {
        $customer = $this->fetchById($request->get("id"));
        if ($customer instanceof Customer){
            $customer->setPassword(bcrypt("plaything123"));
            $customer->setStatus(Customer::NEW);
            $customer->setUpdated(new \DateTime());
            $customer->save();
        }

        return [
            "status" => true,
        ];
    }

    function lock(Request $request)
    {
        $customer = $this->fetchById($request->get("id"));
        if ($customer instanceof Customer){
            $customer->setStatus(Customer::LOCK);
            $customer->setUpdated(new \DateTime());
            $customer->save();
        }

        return [
            "status" => true,
        ];
    }

    function unlock(Request $request)
    {
        $customer = $this->fetchById($request->get("id"));
        if ($customer instanceof Customer){
            $customer->setStatus(Customer::UNLOCK);
            $customer->setUpdated(new \DateTime());
            $customer->save();
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
            'user_name' => [
                'required','max:50',
                function ($attribute, $value, $fail) {
                    $request = Request();
                    $checkExits = Customer::where('user_name', '=', $value)
                        ->where('del_flg', '=', Customer::DEl_FLG);
                    if (isset($request->id)){
                        $checkExits = $checkExits->where('id','<>', $request->id)->count();
                    }else{
                        $checkExits = $checkExits->count();
                    }
                    if ($checkExits > 0) {
                        $fail(trans('validation.unique'));
                    };
                }
            ],
            'email' => [
                'required','email','max:50',
                function ($attribute, $value, $fail) {
                    $request = Request();
                    $checkExits = Customer::where('email', '=', $value)
                        ->where('del_flg', '=', Customer::DEl_FLG);
                    if (isset($request->id)){
                        $checkExits = $checkExits->where('id','<>', $request->id)->count();
                    }else{
                        $checkExits = $checkExits->count();
                    }
                    if ($checkExits > 0) {
                        $fail(trans('validation.unique'));
                    };
                }
            ],
            'full_name' => [
                'required','max:50',
            ],
            'phone' => [
                'required','digits_between:9,11','numeric',
            ],
            'birthday' => [
                'required','max:255',
            ],
            'sex' => [
                'required','max:255',
            ],
        ]);

        return $validation;
    }
}
