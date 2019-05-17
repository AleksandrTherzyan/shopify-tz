<?php


namespace App\Models;


use App\Models\Traits\WorkshopHelper;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{

    use WorkshopHelper;

    protected $fillable = ['is_filled', 'max_guests', 'name', 'time', 'day'];



    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_has_workshop', 'workshop_id', 'customer_id');
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'workshop_has_guest', 'workshop_id', 'guest_id'  );
    }



    public static function getFreeSeats($workshop_id) : int
    {
        $workshop =  self::where('id', $workshop_id)->first();
        return self::calculateFreeSeats($workshop->max_guests, $workshop->is_filled);
    }


    public static function updateFilled($workshop_id, $registered_participants_count) {

        $workshop = self::where('id', $workshop_id)->first();

       return $workshop->update(
            [
                'is_filled' => $workshop->is_filled + $registered_participants_count ,
            ]
        );
    }




}