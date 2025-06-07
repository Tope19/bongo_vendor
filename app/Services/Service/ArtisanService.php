<?php

namespace App\Services\Service;

use App\Models\User;
use App\Models\ProfileView;
use Illuminate\Http\Request;
use App\Constants\ApiConstants;
use App\Constants\AppConstants;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\Media\FileService;
use Illuminate\Support\Facades\Auth;
use App\QueryBuilders\General\UserQueryBuilder;

class ArtisanService
{

    public static function list(array $data = [])
    {
        $data["role"] = AppConstants::ARTISAN_ROLE;
        return UserQueryBuilder::filterList($data)
        ->orderBy("total_ratings", "DESC")
        ->orderByRaw("FIELD(status , 'Active', 'Pending', 'Inactive') ASC")
        ->paginate($data["pagination"] ?? ApiConstants::PAGINATION_SIZE_API);
    }

    // Popular artisans with most profile views
    public static function popularArtisans()
    {
        // get all users by most profile views
        $users = DB::table('profile_views')
            ->select('user_id')
            ->groupBy('user_id')
            // ->orderBy('total_views', 'desc')
            ->get();

        // get all artisans by user_id
        $artisans = User::whereIn('id', $users->pluck('user_id'))
            ->where('role', AppConstants::ARTISAN_ROLE)
            ->where('status', AppConstants::ACTIVE)
            ->take(3)
            ->get();

        return $artisans;

    }

    public static function show($id)
    {
        $user = User::where("role" , AppConstants::ARTISAN_ROLE)->find($id);
        return $user;
    }

    public static function searchByIp(array $data = [])
    {
        $data["role"] = AppConstants::ARTISAN_ROLE;
        return UserQueryBuilder::filterIp($data)
        // ->where("status", AppConstants::ACTIVE)
        ->orderBy("total_ratings", "DESC")
        // Order by Active users first then inactive users follows
        ->orderBy("status", "DESC")
        ->paginate($data["pagination"] ?? ApiConstants::PAGINATION_SIZE_API);
    }

    // Search Artisan by LGA, State, Category
    public static function updateProfile(array $data = [])
    {
        $user = Auth::user();
        if(!empty($avatar = $data["avatar"] ?? null)){
            $fileService = new FileService;
            $file = $fileService->saveFromFile($avatar,"avatar",$user->avatar_id,$user->id);
            $data["avatar_id"] = $file->id;

            //Unset the avatar from the request
            unset($data["avatar"]);
        }

        if(!empty($cover_photo = $data["cover_photo"] ?? null)){
            $fileService = new FileService;
            $file = $fileService->saveFromFile($cover_photo,"cover_photo",$user->cover_photo_id,$user->id);
            $data["cover_photo_id"] = $file->id;

            //Unset the cover_photo from the request
            unset($data["cover_photo"]);
        }
        $user->update($data);
        //refresh the user
        return $user->refresh();
    }

    public static function updateIDCard(array $data = [])
    {
        $user = Auth::user();
        if(!empty($id_card = $data["id_card"] ?? null)){
            $fileService = new FileService;
            $file = $fileService->saveFromFile($id_card,"id_card",$user->id_card,$user->id);
            $data["id_card"] = $file->id;

        }

        $user->status = AppConstants::PENDING;
        $user->update($data);
        //refresh the user
        return $user->refresh();
    }

    // Get Artisan by Category
    public static function getArtisanByCategory(Request $request)
    {
        $data = $request->all();
        $data["role"] = AppConstants::ARTISAN_ROLE;
        return UserQueryBuilder::filterSearch($data)
        ->orderBy("total_ratings", "DESC")
        ->orderByRaw("FIELD(status , 'Active', 'Pending', 'Inactive') DESC")
        ->paginate($data["pagination"] ?? ApiConstants::PAGINATION_SIZE_API);
    }

    //Get All Categories
    public static function categories(Request $request)
    {
        $data = $request->all();
        return UserQueryBuilder::categories($request)->where("status", AppConstants::ACTIVE)
        ->paginate($data["pagination"] ?? ApiConstants::PAGINATION_SIZE_API);
    }

    // Get Related Artisans API
    public static function relatedArtisans(Request $request)
    {
        $data = $request->all();
        $data["role"] = AppConstants::ARTISAN_ROLE;
        return UserQueryBuilder::relatedArtisans($request)->where("status", AppConstants::ACTIVE)
        ->paginate($data["pagination"] ?? ApiConstants::PAGINATION_SIZE_API);
    }

}
