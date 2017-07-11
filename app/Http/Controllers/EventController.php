<?php

namespace App\Http\Controllers;

use App\Event;
use App\Stand;

class EventController extends Controller
{
    /**
     * List all events to show in map
     *
     * @return \Illuminate\Http\JsonResponse Event list
     */
    public function getAll()
    {
        $lstEvents = Event::all(['id', 'latitude', 'longitude']);

        return response()->json($lstEvents->toArray());
    }

    /**
     * Show details of a event
     *
     * @param $id Event id
     * @return \Illuminate\Http\JsonResponse Event details
     */
    public function getDetails($id)
    {
        $oEvent = Event::id($id)->first(['id', 'name', 'description', 'address', 'start_date', 'end_date', 'stands', 'stands_reserved']);

        if ($oEvent) {
            return response()->json($oEvent->toArray());
        } else {
            abort(400);
        }
    }

    /**
     * List all stands of a event
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse Stands list
     */
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
