<?php


namespace App\Repository\Admin;


use App\Model\Member;
use App\ServiceIml\Admin\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberRepository implements MemberService
{

    function list()
    {
        $members = Member::with(["Role"])->where("del_flg", "=", Member::DEl_FLG)->get();
        return $members;
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

        $member = new Member();
        $member->setUserName($request->get("user_name"));
        $member->setPassword(bcrypt("plaything123"));
        $member->setFullName($request->get("full_name"));
        $member->setPhone($request->get("phone"));
        $member->setStatus(Member::NEW);
        $member->setRoleId($request->get("role"));
        $member->setDelFlg(Member::DEl_FLG);
        $member->setCreated(new \DateTime());
        $member->setUpdated(new \DateTime());
        $member->save();

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

        $member = $this->fetchById($id);
        if ($member instanceof Member) {
            $member->setUserName($request->get("user_name"));
            $member->setFullName($request->get("full_name"));
            $member->setPhone($request->get("phone"));
            $member->setStatus($request->get("status"));
            $member->setRoleId($request->get("role"));
            $member->setUpdated(new \DateTime());
            $member->save();
        }

        return [
            "status" => true,
        ];
    }

    function delete(Request $request)
    {
        $member = $this->fetchById($request->get("id"));
        if ($member instanceof Member){
            $member->setDelFlg(Member::DELETE);
            $member->setUpdated(new \DateTime());
            $member->save();
        }

        return [
            "status" => true,
        ];
    }

    function reset(Request $request)
    {
        $member = $this->fetchById($request->get("id"));
        if ($member instanceof Member){
            $member->setPassword(bcrypt("plaything123"));
            $member->setStatus(Member::NEW);
            $member->setUpdated(new \DateTime());
            $member->save();
        }

        return [
            "status" => true,
        ];
    }

    function lock(Request $request)
    {
        $member = $this->fetchById($request->get("id"));
        if ($member instanceof Member){
            $member->setStatus(Member::LOCK);
            $member->setUpdated(new \DateTime());
            $member->save();
        }

        return [
            "status" => true,
        ];
    }

    function unlock(Request $request)
    {
        $member = $this->fetchById($request->get("id"));
        if ($member instanceof Member){
            $member->setStatus(Member::UNLOCK);
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

    function validation(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_name' => [
                'required','max:50',
                function ($attribute, $value, $fail) {
                    $request = Request();
                    $checkExits = Member::where('user_name', '=', $value)
                        ->where('del_flg', '=', Member::DEl_FLG);
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
                function ($attribute, $value, $fail) {
                    $request = Request();
                    $checkExits = Member::where('phone', '=', $value)
                        ->where('del_flg', '=', Member::DEl_FLG);
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
            'role' => [
                'required','max:255',
            ],
            'store' => [
                'required','max:255',
            ],
        ]);

        return $validation;
    }
}
