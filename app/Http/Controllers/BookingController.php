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
        $tickets = $calTime->calendar->tickets;
        foreach ($tickets as $ticket) {
            foreach ($ticket->seats as $seat) {
                $seatSold[] = $seat;
            }
        }
        $ticketPrice = TicketPrice::all();
        $seat = Seat::all();

        return view('page.datve', compact('calTime', 'calendar', 'film', 'room', 'theater', 'ticketPrice', 'seatSold'));
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

        return redirect()->route('user')->with('success', 'Bạn đã đặt thành vé công');
    }
    public function accInfo()
    {
        $acc = Auth::user();
        $tickets = Ticket::all();
        $arrSeat = [];
        foreach ($tickets as $ticket) {
            if ($ticket->user_id == $acc->id) {
                $tk[] = $ticket;
                foreach ($ticket->seats as $seat) {
                    $arrSeat[] = $seat->name;
                }
            }
        }
        $seatString = implode(', ', $arrSeat);

        return view('page.user.index', compact('tk', 'seatString'));
    }
}
