<?php

namespace App\Services\Service;

use App\Constants\ApiConstants;
use App\Constants\AppConstants;
use App\Models\Review;

class ReviewService
{
    public static function index(){
        return Review::paginate($data["pagination"] ?? ApiConstants::PAGINATION_SIZE_API);
    }
    // Store a User Review
    public static function store($data){
       $data = [
           'rating' => $data['rating'],
           'review' => $data['review'],
           'name' => $data['name'],
           'user_id' => $data['user_id'],
       ];

       return Review::create($data);
    }


    public static function show($id)
    {
        return Review::where("user_id" , $id)->paginate(ApiConstants::PAGINATION_SIZE_API);
    }

    public static function userReviewCount($id)
    {
        return Review::where("user_id" , $id)->count();
    }
}
