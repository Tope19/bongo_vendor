<?php

namespace App\Services\Auth;

use App\Constants\NetworkConstants;
use App\Constants\Social\ConnectionConstants;
use App\Models\Referral;
use App\Models\ReferralLevel;
use App\Services\Social\Connections\ConnectionService;
use App\Services\User\UserService;

class ReferralLevelService
{
    public static function recordLevels($referrer_id, $new_user_id, $level = null , $batch_no = null)
    {
        if ($level > NetworkConstants::MAX_LEVELS) {
            return;
        }
        $level = $level ?? 1;

        if ($level == 1) {
            $referralRecord = Referral::where("user_id", $new_user_id)->first();
        } else {
            $referralRecord = Referral::where("user_id", $referrer_id)->first();
        }
        if (!empty($referralRecord)) {
            $referralLevel = ReferralLevel::create([
                "user_id" => $referralRecord->referrer_id,
                "referrer_id" => $referrer_id,
                "new_user_id" => $new_user_id,
                "level" => $level
            ]);

            $profile = UserService::getPersonalProfileById($referralRecord->referrer_id);
            ConnectionService::follow([
                "user_id" => $new_user_id,
                "referral_level_id" => $referralLevel->id,
                "profile_id" => $profile->id,
                "type" => ConnectionConstants::AUTO_TYPE,
                "batch_no" => $batch_no,
                "level" => $referralLevel->level
            ]);

            $level = $referralLevel->level;
            return self::recordLevels($referralRecord->referrer_id, $new_user_id, $level + 1 , $batch_no);
        }
        return;
    }

}
