<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after loginAdmin.
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
        $this->redirectTo = url()->previous();
        $this->middleware('guest:web', ['except' => ['logout']]);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        if (session('link')) {
            $myPath     = session('link');
            $loginPath  = url('/loginAdmin');
            $previous   = url()->previous();

            if ($previous == $loginPath) {
                    session(['link' => $myPath]);
            }else {
                if (\request()->route()->getName() == "password.request"){
                    session(['link' => url("/home")]);
                }else {
                    session(['link' => $previous]);
                }
            }
        }else {
            if (\request()->route()->getName() == "password.request"){
                session(['link' => url("/home")]);
            }else {
                session(['link' => url()->previous()]);
            }
        }

        return View::make('auth.loginAdmin');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->post(), [
            'user_name' => 'required',
            'password' => 'required|min:6'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }
        $user = Customer::where('user_name', '=' ,$request->input('user_name'))
            ->where('del_flg', '=', Customer::DEl_FLG)
            ->first();

        if (isset($user)) {
            // Attempt to log the user in
            if (auth()->guard('web')->attempt(['user_name' => $request->get("user_name"), 'password' => $request->get("password")])) {
                $link = session('link');
                if ($link == route('register')){
                    $link = route('home');
                }

                return redirect($link);
            }
            return back()->withErrors([
                'user_name' => ' ',
                'password' => trans('Tài khoản hoặc mật khẩu bị sai!'),
            ]);
        }
        return back()->withErrors([
            'user_name' => ' ',
            'password' => trans('Tài khoản hoặc mật khẩu bị sai!'),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function logout(Request $request)
    {
        Auth::guard("web")->logout();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
