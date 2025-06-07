<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Constants\AppConstants;
use Illuminate\Support\Facades\Hash;
use App\Services\General\IpAddressService;

class RegisterationService
{

    public static function generateUsername($firstname, $lastname = "", int $suffix = null)
    {
        $lastname = $lastname ?? " ";
        $username = $firstname . $lastname[0] ?? "";
        $username .= "$suffix";

        $check = User::where("username", $username)->count();
        if ($check > 0) {
            return self::generateUsername($firstname, $lastname, ((int)$suffix) + 1);
        }
        return $username;
    }

    public static function createUser($first_name, $last_name, $email, $gender, $password, $phone, $role, $otp): User
    {
        $data = array_merge([
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "gender" => $gender,
            "password" => $password,
            "phone" => $phone,
            "ref_code" => strtoupper(getRandomToken(8)),
            "role" => $role,
            "otp" => $otp,
            // "latitude" => $latitude ?? "",
            // "longitude" => $longitude ?? ""
        ]);
        $data["username"] = self::generateUsername($data["first_name"], $data["last_name"]);
        $data["password"] = Hash::make($data['password']);
        $user = User::create($data);
        session()->put("credentials", $user);
        return $user;


    }

    public static function postRegisterActions(User $user)
    {
        IpAddressService::syncUser($user , request()->ip());
    }

}
