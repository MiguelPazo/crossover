<?php

namespace App\Http\Controllers;

use App\Stand;

class StandController extends Controller
{
    public function getDetails($id)
    {
        $oEvent = Stand::id($id)->first(['id', 'number', 'price', 'status']);

        if ($oEvent) {
            return response()->json($oEvent->toArray());
        } else {
            abort(400);
        }
    }
}
