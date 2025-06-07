<?php

namespace App\Services\Notifications\Booking;

use App\Models\ServiceBooking;
use App\Notifications\Booking\ArtisanResponseNotification;
use App\Notifications\Booking\BookingCancelledNotification;
use App\Notifications\Booking\NewBookingNotification;
use Illuminate\Support\Facades\Notification;

class BookingNotificationService
{
    public static function newBooking(ServiceBooking $booking)
    {
        $user = $booking->artisan;
        $data = [
            "user" => $user,
            "title" => "New Booking Request",
            "booking" => $booking,
            "message" => "Someone needs your services",
            "meta" => [
                "booking_id" => $booking->id,
                "type" => "new_booking",
                "group" => "booking"
            ]
        ];
        Notification::send($user, new NewBookingNotification($data));
    }



    public static function requestAction(ServiceBooking $booking, $status , $comment = null)
    {
        $user = $booking->user;
        $artisan = $booking->artisan;
        $data = [
            "user" => $user,
            "title" => "Booking Request $status",
            "booking" => $booking,
            "message" => "Your request to " . $artisan->names . " was " . strtolower($status),
            "meta" => [
                "booking_id" => $booking->id,
                "type" => "booking_request",
                "group" => "booking"
            ]
        ];
        Notification::send($user, new ArtisanResponseNotification($data));
    }


    public static function bookingCancelled(ServiceBooking $booking , $comment)
    {
        $user = $booking->artisan;
        $data = [
            "user" => $user,
            "title" => "Booking Request Cancelled",
            "booking" => $booking,
            "message" => "Booking request cancelled. \n Reason: $comment",
            "meta" => [
                "booking_id" => $booking->id,
                "type" => "booking_cancelled",
                "group" => "booking"
            ]
        ];
        Notification::send($user, new BookingCancelledNotification($data));
    }



}
