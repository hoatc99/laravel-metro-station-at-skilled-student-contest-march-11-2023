<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function get_stations(Request $request)
    {
        $stations = Route::find($request->route_id)->stations()->get();
        return $stations;
    }
}
