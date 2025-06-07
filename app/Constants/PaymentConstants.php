<?php

namespace App\Constants;

class PaymentConstants
{


    const PAY_WITH_CARD = "Card";
    const PAY_WITH_BANK = "Bank";

    const PAYMENT_OPTIONS = [
        self::PAY_WITH_BANK,
        self::PAY_WITH_CARD
    ];

    const FUND_WALLET_WITH_CARD = "FUND_WALLET_WITH_CARD";
    const FUND_WITH_FLUTTERWAVE = "FUND_WITH_FLUTTERWAVE";
    const FUND_WITH_BANK = "FUND_WITH_BANK";
    const REFERRAL_BONUS = "REFERRAL_BONUS";
    const SIGNUP_BONUS = "SIGNUP_BONUS";
    const WITHDRAW_FROM_WALLET = "WITHDRAW_FROM_WALLET";
    const WALLET_TRANSFER = "WALLET_TRANSFER";
}
