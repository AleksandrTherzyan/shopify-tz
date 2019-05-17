<?php

namespace App\Http\Controllers\Traits;

use App\Models\Workshop;
use Illuminate\Http\Request;

trait WorkshopErrorHandler
{

    /**
     *  Called by axios
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public  function checkFreeSeatsToJson(Request $request)
    {
        $free_seats = Workshop::getFreeSeats($request->get('workshop_id'));

        return response()->json(['response' => Workshop::checkFreeSeats($free_seats, $request->get('registered_participants_count') )], 200);
    }

    /**
     * Called by axios
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkParticipateToJson(Request $request)
    {
        $customer = Workshop::where('id',$request->get('workshop_id'))
            ->first()
            ->customers()
            ->where('name', $request->get('customer_name'))
            ->first();

        return response()->json(['response' => Workshop::checkParticipateSeats( $customer )], 200);

    }


}