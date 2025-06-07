<?php

namespace App\Services\Service;

use App\Constants\ApiConstants;
use App\QueryBuilders\Services\ServiceQueryBuilder;

class ServiceService
{

    public static function list(array $data = [])
    {
        return ServiceQueryBuilder::filter($data)
        ->paginate($data["pagination"] ?? ApiConstants::PAGINATION_SIZE_API);
    }
}
