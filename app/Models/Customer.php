<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $fillable = ['name', 'phone'];



    public function workshops()
    {
        return $this->belongsToMany(Workshop::class, 'customer_has_workshop', 'customer_id' , 'workshop_id' );
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }



}