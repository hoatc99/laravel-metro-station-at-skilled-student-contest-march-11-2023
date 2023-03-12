<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function get_routes()
    {
        $routes = Route::all();
        return $routes;
    }
}
