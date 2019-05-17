<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{

    protected $fillable = ['name', 'email', 'customer_id'];


    public function workshops()
    {
        return $this->belongsToMany(Workshop::class, 'workshop_has_guest', 'guest_id' , 'workshop_id' );
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}