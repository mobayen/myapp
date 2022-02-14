<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    //
    function search(Request $r) {

        $futureEvents = $r->input("futureEvents") == 'false' ? false : true;
        $searchBy = $r->input("searchBy") ?? '';
        $location = $r->input("location") ?? '';
        $lengthStart = !empty($r->input("lengthStart")) ? intval($r->input("lengthStart")) : 0;
        $lengthEnd = !empty($r->input("lengthEnd")) ? intval($r->input("lengthEnd")) : 1000;
        $seatCostMin = !empty($r->input("seatCostMin")) ? floatval($r->input("seatCostMin")) : 0;
        $seatCostMax = !empty($r->input("seatCostMax")) ? floatval($r->input("seatCostMax")) : 1000;

        $events = Event::where('active','y')
            ->where(function($q) 
                use($futureEvents, $location, $lengthStart, $lengthEnd, $seatCostMin, $seatCostMax) 
            {
                if ($futureEvents) {
                    $q->whereDate('date', '<=', Carbon::today()->toDateString());
                } else {
                    $q->whereDate('date', '>', Carbon::today()->toDateString());
                }

                if (!empty($location)) {
                    $q->where('location', $location);
                }

                $q->whereBetween('event_length_in_hours', [$lengthStart, $lengthEnd]);
                
                $q->whereBetween('seat_cost', [$seatCostMin, $seatCostMax]);
            })
            ->where(function($q) use( $searchBy ) {
                if (!empty($searchBy)) {
                    $q->where('name', 'like', "%".$searchBy."%");
                    $q->orWhere('place', 'like', "%".$searchBy."%");
                }
            })
            ->limit(100)
            ->get();

        return $events;
    }
}
