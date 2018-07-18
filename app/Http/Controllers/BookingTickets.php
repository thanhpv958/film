<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Film;
use App\Ticket;
use App\TicketPrice;
use App\Seat;
use App\CalendarTime;

class BookingTickets extends Controller
{
    public function getBookTicket($calTime)
    {
        $calTime = CalendarTime::find($calTime);
        $calendar = $calTime->calendar;
        $film = $calTime->calendar->film;
        $room = $calTime->calendar->room;
        $theater = $calTime->calendar->room->theater;

        $tickets = $calTime->calendar->tickets;
        //dd($tickets);
        foreach ($tickets as $ticket) {
            foreach ($ticket->seats as $seat) {
                $seats[] = explode(',', $seat->name);
                for ($i=0; $i < count($seats); $i++) {
                    $arrS = array_merge($seats[$i], $seats[$i++]);
                }
            }
        }

        //dd($arrS);
        // $room = Room::find($idroom);
        // $theater = $room->theater;
        // $film = Film::find($idfilm);

        // $calendars = $room->calendars;
        // foreach ($calendars as $cal) {
        //     foreach ($cal->calendarTimes as $calTime) {
        //         $caltime = $calTime;
        //     }
        // };
        $ticketPrice = TicketPrice::all();
        $seat = Seat::all();

        return view('page.datve', compact('calTime', 'calendar', 'film', 'room', 'theater', 'ticketPrice', 'arrS'));
    }
    public function postBookTicket(Request $request)
    {
        $ticket = new Ticket;
        $seat = new Seat;

        $ticket->total_price = (int)$request->total_price*1000;
        $ticket->calendar_id =  $request->calTime_id;
        $ticket->user_id = (int)$request->user_id;
        $ticket->save();

        $seat->name = preg_replace('/\s+/', ',', $request->getseat);
        $seat->ticket_id = $ticket->id;
        $seat->save();

        return redirect()->route('user')->with('success', 'Bạn đã đặt thành vé công');
    }
}
