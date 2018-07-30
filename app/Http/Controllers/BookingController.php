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
use Carbon\Carbon;
use DateTime;
use App\User;

class BookingController extends Controller
{
    public function getBookTicket($calTime)
    {
        $calTime = CalendarTime::findOrFail($calTime);
        $calendar = $calTime->calendar;
        $film = $calTime->calendar->film;
        $room = $calTime->calendar->room;
        $theater = $calTime->calendar->room->theater;
        $ticketPrice = TicketPrice::all();

        $user = Auth::user();
        $userBirthday = DateTime::createFromFormat('d/m/Y', $user->birthday);
        if (Carbon::today()->isBirthday($userBirthday)) {
            $happy = Carbon::today();
        }
        return view('page.datve', compact('calTime', 'calendar', 'film', 'room', 'theater', 'ticketPrice', 'happy'));
    }

    public function getSeatBooked($calID)
    {
        $calTime = CalendarTime::findOrFail($calID);
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
        if ($request->total_price == null) {
            return back()->withErrors(['errors' => 'Bạn chưa đặt vé nào']);
        }

        $user = Auth::user();
        $ticket = new Ticket;
        if ($user->sale_status == 0) {
            return back()->withErrors(['errors' => 'Mã giảm giá này đã được sử dụng']);
        }
        if ($user->coupon === $request->coupon && $user->sale_status == 1) {
            $ticket->total_price = (int)$request->total_price*1000*0.7;
        } else {
            $ticket->total_price = (int)$request->total_price*1000;
        }
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

        $user->sale_status = 0;
        $user->save();

        return back()->with('success', 'Bạn đã vé đặt thành công');
    }
}
