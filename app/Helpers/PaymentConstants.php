<?php
namespace App\Helpers;

class PaymentConstants
{


    const BID_PAY_BY_MILESTONE = 'Milestone';
    const BID_PAY_BY_PROJECT_COMPLETION = 'Project-Compeletion';

    const BID_PAYMENT_TYPES = [
        self::BID_PAY_BY_MILESTONE,
        self::BID_PAY_BY_PROJECT_COMPLETION
    ];

    const GIG_PAY_WITH_CASH = 'Cash';
    const GIG_PAY_ONLINE = 'Online';



}
