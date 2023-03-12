<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Station;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('pages.searchticket');
    }

    public function create()
    {
        return view('pages.ticket');
    }

    public function store(Request $request)
    {
        $result = Ticket::create([
            'route_id' => $request->route_id,
            'pickup_station_id' => $request->pickup_station_id,
            'dropdown_station_id' => $request->dropdown_station_id,
            'quantity' => $request->quantity,
            'phone_number' => $request->phone_number,
        ]);

        return $result;
    }

    public function get_tickets(Request $request)
    {
        $tickets = Ticket::wherePhoneNumber($request->phone_number)->orderByDesc('id')->get();
        foreach ($tickets as $ticket) {
            $ticket->route_name = $ticket->route->name;
            $ticket->pickup_station_name = Station::whereRelation('routes', 'route_station.id', $ticket->pickup_station_id)->first()->name;
            $ticket->dropdown_station_name = Station::whereRelation('routes', 'route_station.id', $ticket->dropdown_station_id)->first()->name;

            $request->route_id = $ticket->route_id;
            $request->pickup_station_id = $ticket->pickup_station_id;
            $request->dropdown_station_id = $ticket->dropdown_station_id;
            $request->quantity = $ticket->quantity;

            $ticket->sum_total = $this->calc_sum_total($request);
        }

        return $tickets;
    }

    public function calc_sum_total(Request $request)
    {
        $route = Route::find($request->route_id);
        $route_stations_count = $route->stations->count();
        $pickup_station_id = $request->pickup_station_id;
        $dropdown_station_id = $request->dropdown_station_id;
        $pickup_to_dropdown_station_count = abs($dropdown_station_id - $pickup_station_id) + 1;

        $sum_total = $route->minimum_fare;

        if ($pickup_to_dropdown_station_count > ceil($route_stations_count / 2)) {
            $sum_total = $sum_total + ($pickup_to_dropdown_station_count - ceil($route_stations_count / 2)) * $route->unit_price;
        }

        $sum_total = $sum_total * $request->quantity;

        return $sum_total;
    }
}
