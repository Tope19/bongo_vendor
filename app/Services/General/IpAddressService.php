<?php

namespace App\Services\General;

use App\Models\User;
use Stevebauman\Location\Facades\Location;

class IpAddressService
{

    public static function check($ip_address)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://ip-api.com/php/$ip_address",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $process = curl_exec($curl);
        curl_close($curl);
        $data = unserialize($process);
        return $data ?? [];
    }


    public static function syncUser(User $user, $ip_address)
    {
        $ip_data = self::check($ip_address);
        $location = Location::get($ip_address);
        $data["ip_address"] = $ip_address;
        $data["latitude"] = $location->latitude ?? $user->latitude;
        $data["longitude"] = $location->longitude ?? $user->longitude;
        $user->update($data);
        $user->refresh();
    }
}
