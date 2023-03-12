<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $routes = Route::all();
        return view('pages.home')->with(compact('routes'));
    }

    public function get_route_stations(Request $request)
    {
        $route = Route::find($request->route_id);
        $route->stations = $route->stations()->orderByDesc('id')->get();
        foreach ($route->stations as $station) {
            $station->routes = $station->routes()->get();
        }
        return $route;
    }
}
