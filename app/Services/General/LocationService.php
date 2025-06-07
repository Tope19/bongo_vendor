<?php

namespace App\Services\General;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LocationService
{


    public static function countries(): Collection
    {
        return Country::get();
    }

    public static function states(Request $request): Collection
    {
        $builder = new State;
        if (!empty($key = $request->country_id)) {
            $builder = $builder->where("country_id", $key);
        }
        if (!empty($key = $request->country_name)) {
            $builder = $builder->whereHas("country", function ($query) use ($key) {
                $query->where("name", "like", "%$key%");
            });
        }
        return $builder->get();
    }

    public static function cities(Request $request): Collection
    {
        $builder = new City;
        if (!empty($key = $request->state_id)) {
            $builder = $builder->where("state_id", $key);
        }
        if (!empty($key = $request->state_name)) {
            $builder = $builder->whereHas("state", function ($query) use ($key) {
                $query->where("name", "like", "%$key%");
            });
        }
        return $builder->get();
    }

    public static function stateByCountryId($countryId){
        return State::where("country_id", $countryId)->get();
    }

    public static function cityByStateId($stateId){
        return City::where("state_id", $stateId)->get();
    }
}
