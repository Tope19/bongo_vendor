<?php

namespace App\Services\Auth;

use App\Constants\StatusConstants;
use App\Models\Referral;
use App\Models\User;
use App\Services\System\ExceptionService;
use Illuminate\Support\Facades\DB;

class ReferralService
{
    const REFERRAL_SESSION_KEY = "ref_invite_code";
    const REFERRAL_BONUS_AMOUNT = 20;

    public static function initiateInvite($user)
    {
        session()->put(
            self::REFERRAL_SESSION_KEY,
            [
                "name" => $user->first_name,
                "ref_code" => $user->ref_code
            ]
        );
    }

    public static function getSessionReferrer()
    {
        $ref_session_key = self::REFERRAL_SESSION_KEY;
        $referrer = null;
        if (session()->has($ref_session_key)) {
            $referrer = session()->get($ref_session_key);
        }
        return $referrer;
    }

    public static function newReferral($new_user_id, $ref_code)
    {
        DB::beginTransaction();
        try {
            $newUser = User::find($new_user_id);
            if (empty($newUser)) {
                return;
            }

            $referrerUser = User::where("ref_code", $ref_code)->first();

            $data = [
                "user_id" => $newUser->id,
                "referrer_id" => User::where("email", "topeolotu75@gmail.com")->first()->id,
                "bonus" => self::REFERRAL_BONUS_AMOUNT,
                "is_auto" => 1,
                "status" => StatusConstants::PENDING
            ];

            if (!empty($ref_code) && !empty($referrerUser)) {
                $data["referrer_id"] = $referrerUser->id;
                $data["is_auto"] = 0;
            }

            $referral = Referral::firstOrCreate(
                [
                    "user_id" => $data["user_id"],
                    "referrer_id" => $data["referrer_id"],
                ],
                $data
            );
            return $referral;
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            ExceptionService::logAndBroadcast($th);
        }
    }


    public static function rewardReferrerIfEligible(User $user)
    {
        DB::beginTransaction();
        try {
            $referral = Referral::where("user_id", $user->id)->first();
            if (
                !empty($referral) &&
                $referral->status == StatusConstants::PENDING
            ) {
                self::rewardReferrer($referral);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            ExceptionService::broadcastOnAllChannels($th);
        }
    }

    public static function amountIsEligible($transaction_amount, $price_per_dollar)
    {
        return ($transaction_amount / $price_per_dollar) >= 2;
    }
}
