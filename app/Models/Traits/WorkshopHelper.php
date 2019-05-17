<?php


namespace App\Models\Traits;


trait WorkshopHelper
{


    /**
     * @param $free_seats
     * @return string
     */
    public static function checkFreeSeats($free_seats, $registered_participants_count) : string
    {
        return $registered_participants_count > $free_seats
            ? "Sorry, there are only {$free_seats} more available spots for this workshop"
            : ''
        ;
    }

    /**
     * @param $is_customer
     * @return string
     */
    public static function checkParticipateSeats( $is_customer ) : string
    {
        return $is_customer
            ? "You have already registered on this time"
            : ''
        ;
    }


    /**
     * @param $max_guests
     * @param $filled
     * @return int
     */
    public static function calculateFreeSeats($max_guests, $filled) : int
    {
        return  $max_guests - $filled;
    }

}