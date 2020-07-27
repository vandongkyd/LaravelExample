<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Model\Customer;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255', 'unique:dtb_customer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:dtb_customer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * @param array $data
     * @return Customer
     * @throws \Exception
     */
    protected function create(array $data)
    {
        $customer = new Customer();
        $customer->setFullName($data['full_name']);
        $customer->setUserName($data['user_name']);
        $customer->setEmail($data['email']);
        $customer->setPassword(Hash::make($data['password']));
        $customer->setDelFlg(Customer::DEl_FLG);
        $customer->setCreated(new \DateTime());
        $customer->setUpdated(new \DateTime());

        $sendMail = new RegisterMail();
        $sendMail->setFullName($data['full_name']);
        $sendMail->setUserName($data["user_name"]);
        $sendMail->setPassword($data["password"]);
        Mail::to($data["email"])->send($sendMail);
        if (Mail::failures()) {
            return view("");
        }
        $customer->save();
        return $customer;
    }
}
