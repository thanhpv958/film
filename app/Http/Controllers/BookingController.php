<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Film;
use App\Ticket;
use App\TicketPrice;
use App\Seat;
use App\CalendarTime;
use Auth;

class BookingController extends Controller
{
    public function getBookTicket($calTime)
    {
        $calTime = CalendarTime::find($calTime);
        $calendar = $calTime->calendar;
        $film = $calTime->calendar->film;
        $room = $calTime->calendar->room;
        $theater = $calTime->calendar->room->theater;

        $ticketPrice = TicketPrice::all();

        return view('page.datve', compact('calTime', 'calendar', 'film', 'room', 'theater', 'ticketPrice'));
    }

    public function getSeatBooked($calID)
    {
        $calTime = CalendarTime::find($calID);
        $seats = [];

        foreach ($calTime->calendar->tickets as $ticket) {
            foreach ($ticket->seats as $seat) {
                $seats[] = $seat->name;
            }
        }
        return response()->json([
            'seats' => $seats,
        ]);
    }

    public function postBookTicket(Request $request)
    {
        $ticket = new Ticket;
        $ticket->total_price = (int)$request->total_price*1000;
        $ticket->calendar_id =  (int)$request->calTime_id;
        $ticket->user_id = (int)$request->user_id;
        $ticket->save();

        $getseat = preg_replace('/\s+/', ',', $request->getseat);
        $sName = explode(',', $getseat);
        foreach ($sName as $s) {
            $seat = new Seat;
            $seat->name = $s;
            $seat->ticket_id = $ticket->id;
            $seat->save();
        }

        return back()->with('success', 'Bạn đã đặt thành vé công');
    }
}
