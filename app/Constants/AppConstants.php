<?php

namespace App\Constants;

class AppConstants
{
    const MAX_PROFILE_PIC_SIZE = 2048;
    const MALE = 'Male';
    const FEMALE = 'Female';
    const OTHERS = 'Others';

    const GENDERS = [
        self::MALE,
        self::FEMALE,
        self::OTHERS,
    ];

    const PILL_CLASSES = [
        StatusConstants::COMPLETED => "success",
        StatusConstants::PENDING => "primary",
        StatusConstants::PROCESSING => "info",
        StatusConstants::CANCELLED => "danger",
        StatusConstants::ACTIVE => "success",
        StatusConstants::INACTIVE => "warning",
        StatusConstants::DELETED => "danger",
        TransactionConstants::DEBIT => "danger",
        TransactionConstants::CREDIT => "success",
    ];

    const CLIENT_ROLE = 'Client';
    const ARTISAN_ROLE = 'Artisan';
    const ADMIN_ROLE = 'Admin';
    const DEFAULT_PASSWORD = 'password';
    const DEFAULT_AVATAR =  'https://res.cloudinary.com/duyiwy7xw/image/upload/v1684065530/default_wmtooe.png';
    const ARTISAN_VERIFICATION_EMAIL = 'verify@letsgetusorted.com';
    const ADMIN_EMAIL = 'admin@letsgetusorted.com';
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';
    const VERIFIED = 'Verified';
    const PENDING = 'Pending';
    const DECLINED = 'Declined';
    const DEACTIVATED = 0;

}
