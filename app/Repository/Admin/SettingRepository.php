<?php


namespace App\Repository\Admin;


use App\Model\Member;
use App\ServiceIml\Admin\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingRepository implements SettingService
{

    function changePassword(Request $request, $id)
    {
        $member = $this->fetchById($id);
        $validation = $this->validation($request, Member::CHANGE, $member);

        if ($validation->fails()){
            return [
                "status" => false,
                "validate" => $validation
            ];
        }
        if ($member instanceof Member) {
            $member->setPassword(bcrypt($request->get('password')));
            $member->setUpdated(new \DateTime());
            $member->save();
        }

        return [
            "status" => true,
        ];
    }

    function profile(Request $request, $id)
    {
        $member = $this->fetchById($id);
        $validation = $this->validation($request, Member::PROFILE, $member);

        if ($validation->fails()){
            return [
                "status" => false,
                "validate" => $validation
            ];
        }

        if ($member instanceof Member) {

            $file_upload = $request->file('avatar');
            if (isset($file_upload)) {
                $avatar = uniqid() . '_' . time() . '.' . $file_upload->getClientOriginalExtension();
                $file_upload->move(public_path('save_image'), $avatar);
                $member->setAvatar($avatar);
            }

            $member->setFullName($request->get("full_name"));
            $member->setPhone($request->get("phone"));
            $member->setAddress($request->get("address"));
            $member->setUpdated(new \DateTime());
            $member->save();
        }

        return [
            "status" => true,
        ];
    }

    function fetchById($id)
    {
        return Member::findOrFail($id);
    }

    function validation(Request $request, $mod, Member $member)
    {
        $validation = null;
        if ($mod == Member::PROFILE) {
            $validation = Validator::make($request->all(), [
                'full_name' => [
                    'required', 'max:50',
                ],
                'phone' => [
                    'required', 'digits_between:9,11', 'numeric',
                ],
                'address' => [
                    'required', 'max:255',
                ],
                'avatar' => [
                    'max:4048',
                ],
            ]);
        }else{
            $validation = Validator::make($request->all(), [
                'password_current' => [
                    'required', 'min:4',
                    function ($attribute, $value, $fail) use ($member) {
                        if (!Hash::check($value, $member->getPassword())){
                            $fail(trans('You have entered wrong password'));
                        }
                    }
                ],
                'password' => [
                    'required', 'min:4',
                ],
                'password_confirm' => [
                    'required', 'min:4', 'same:password',
                ],
            ]);
        }

        return $validation;
    }

}
