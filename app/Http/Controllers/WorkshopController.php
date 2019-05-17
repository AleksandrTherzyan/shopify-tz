<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\WorkshopErrorHandler;
use App\Models\Customer;
use App\Models\Guest;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    use WorkshopErrorHandler;
    
    public function index()
    {

        return view('workshop', [
            'workshops' => Workshop::get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $errors = [];

        $workshop_id = $data['workshop_id'];
        $free_seats = Workshop::getFreeSeats($workshop_id);
        $registered_participants_count = 1 + ($request->has('guests') ? count($data['guests']) : 0 );

        /**
         * check if the user has been registered
         */
        if  (!empty($error = Workshop::checkFreeSeats($free_seats, $registered_participants_count))) {
                array_push($errors, $error);
        } else {

            $customer = Customer::create($data['customer']);
            $customer->workshops()->attach($workshop_id);

            /**
             * if exist guests add him customer and relations with workshop
             */
            if ($request->has('guests')) {

                $guests = array_map(function ($guest) use ($customer) {
                    $guest['customer_id'] = $customer->id;
                    return $guest;
                },$data['guests']);

                $guest_ids = [];
                foreach ( $guests as $guest ) {
                    $guest_ids [] = Guest::insertGetId($guest);
                }

                Workshop::where('id', $workshop_id)->first()->guests()->attach($guest_ids);
            }

            Workshop::updateFilled($workshop_id, $registered_participants_count);
        }

        $response = $errors
            ? ['error' => array_shift($errors)]
            : ['success' => 'You have been successfully registered'];

        return redirect()->back()->with($response);
    }

}

















