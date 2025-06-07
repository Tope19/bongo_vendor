<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Review;
use App\Models\UserActivity;
use App\Constants\ActivityLevelConstants;
use App\Services\Activity\UserLevelService;
use App\Http\Resources\Account\UserResource;
use App\Http\Resources\Review\ReviewResource;
use App\Services\Activity\UserActivityService;
use App\Services\Plan\UserSubscriptionService;
use App\Http\Resources\Account\ProfileResource;
use App\Services\Activity\UserLevelSessionService;

class LoginService
{

    public static function newLogin(User $user , bool $setSession = true)
    {
        $user->update([
            "last_login" => now()
        ]);
    }


    public static function apiAuthorized(User $user)
    {
        $token = $user->createToken("default")->plainTextToken;
        self::newLogin($user , false);

        return [
            'token' => $token,
            'token_type' => 'bearer',
            'user' => new UserResource($user),
            'profile' => new ProfileResource($user),
        ];
    }
}
