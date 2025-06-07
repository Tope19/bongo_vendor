<?php

namespace App\Services\Service;

use App\Constants\ApiConstants;
use App\Models\ServiceCategory;
use App\QueryBuilders\Services\ServiceQueryBuilder;

class ServiceCategoryService
{

    public static function list(array $data = [])
    {
        return ServiceQueryBuilder::filterCategories($data)
        ->paginate($data["pagination"] ?? ApiConstants::PAGINATION_SIZE_API);
    }

    public static function popularCategories(array $data = [])
    {
        return ServiceQueryBuilder::popularCategories($data)
        ->paginate($data["pagination"] ?? ApiConstants::PAGINATION_SIZE_API);
    }

}
