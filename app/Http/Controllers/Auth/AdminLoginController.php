<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Model\Member;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    /**
     * AdminLoginController constructor.
     */
    public function __construct() {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    /**
     * @return Factory|View
     */
    public function getLogin() {
        return view('auth.adminLogin');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request) {

        $validation = Validator::make($request->post(), [
            'user_name' => 'required',
            'password' => 'required|min:6'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $member = Member::where('user_name', '=' ,$request->get('user_name'))
            ->where('del_flg', '=', 0)
            ->first();
        if (isset($member)) {
            // Attempt to log the user in
            if ($member->status == Member::LOCK){
                return back()->withErrors([
                   "user_name" => " ",
                   "password" => "Tài khoản của bạn đang bị khóa. Vui lòng liên hệ quản trị viên để mở khóa!"
                ]);
            }
            $remember_me = $request->has('remember') ? true : false;
            if (auth()->guard('admin')->attempt(['user_name' => $request->get('user_name'),
                'password' => $request->get('password')], $remember_me)) {
                if ($member instanceof Member){
                    $member->setStatus(Member::ACTIVE);
                    $member->save();
                }

                $admin = Auth::guard('admin')->user();

                Auth::guard('admin')->login($admin, true);

                return redirect()->intended(url('admins/dashboard'));
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
     * @return RedirectResponse|Redirector
     */
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admins/loginAdmin');
    }
}
