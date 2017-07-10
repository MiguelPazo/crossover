<?php

namespace App\Http\Controllers;

use App\Event;
use App\Stand;

class EventController extends Controller
{
    public function getAll()
    {
        $lstEvents = Event::all(['id', 'latitude', 'longitude']);

        return response()->json($lstEvents->toArray());
    }

    public function getDetails($id)
    {
        $oEvent = Event::id($id)->first(['id', 'name', 'description', 'address', 'start_date', 'end_date', 'stands', 'stands_hired']);

        if ($oEvent) {
            return response()->json($oEvent->toArray());
        } else {
            abort(400);
        }
    }

    public function getStands($id)
    {
        $oEvent = Stand::eventId($id)->get(['id', 'status', 'price', 'company_id']);

        if ($oEvent) {
            return response()->json($oEvent->toArray());
        } else {
            abort(400);
        }
    }
}
