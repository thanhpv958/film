<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CalendarRequest;
use App\Theater;
use App\Room;
use App\Film;
use App\Calendar;
use App\CalendarTime;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendars = Calendar::all();
        return view('admin.calendar.list', ['calendars' => $calendars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theaters = Theater::all();
        $films = Film::where('type', 1)->get();

        return view('admin.calendar.add', ['theaters' => $theaters, 'films' => $films]);
    }

    public function ajaxRoom($theaterId)
    {
        $rooms = Room::where('theater_id', $theaterId)->get();

        return response()->json([
            'rooms' => $rooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalendarRequest $request)
    {
        $calendar = new Calendar;
        $calDatas = Calendar::all();

        $dateShow = $request->date_show;
        $roomID = $request->room_id;

        $roomName = Room::find($roomID);
        $theaterName = $roomName->theater()->get();

        $filmID = $request->film_id;

        $flag = true;
        foreach ($calDatas as $cal) {
            if ($roomID == $cal->room_id && $filmID == $cal->film_id && $dateShow == $cal->date_show) {
                $flag = false;
                break;
            }
        }

        if ($flag) {
            if ($dateShow >= date('d/m/Y')) {
                $calendar->date_show = $dateShow;
                $calendar->room_id = $request->room_id;
                $calendar->film_id = $filmID;
                $calendar->save();

                $arrayType = $request->types;
                $arrayTime = $request->time_shows;

                for ($i=0; $i < count($arrayType); $i++) {
                    $time = new CalendarTime;
                    $time->type_ticket = $arrayType[$i];
                    $time->time_show = $arrayTime[$i];
                    $time->calendar_id = $calendar->id;
                    $time->save();
                }
                return redirect('admin/calendars')->with('success', 'Thêm thành công');
            } else {
                return back()->withErrors('Ngày chiếu phải lớn hơn hoặc bằng ngày ' . date('d/m/Y'));
            }
        } else {
            return back()->withErrors('Lỗi, phim đã có lịch chiếu ngày '.$dateShow .' ở ' . $roomName->name . ' rạp ' . $theaterName[0]->name);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calendar = Calendar::findOrFail($id);
        $theaters = Theater::all();
        $rooms = Room::where('theater_id', $calendar->room->theater->id)->get();

        return view('admin.calendar.edit', compact('calendar', 'theaters', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CalendarRequest $request, $id)
    {
        $calendar = Calendar::findOrFail($id);
        $calDatas = Calendar::all();

        $dateShow = ($request->date_show) ? $request->date_show : null;
        $roomID = $request->room_id;
        $filmID = $request->film_id;

        $roomName = Room::findOrFail($roomID);
        $theaterName = $roomName->theater()->get();

        $flag = true;
        foreach ($calDatas as $cal) {
            if ($roomID == $cal->room_id && $filmID == $cal->film_id && $dateShow == $cal->date_show) {
                $flag = false;
                break;
            }
        }

        if ($flag) {
            if (isset($dateShow)) {
                $calendar->date_show = $dateShow;
            }
            $calendar->room_id = $request->room_id;
            $calendar->save();

            $arrayType = $request->types;
            $arrayTypeID = $request->types_id;
            $arrayTime = $request->time_shows;

            for ($i=0; $i < count($arrayTypeID); $i++) {
                $time = CalendarTime::find($arrayTypeID[$i]);
                $time->type_ticket = $arrayType[$i];
                $time->time_show = $arrayTime[$i];
                $time->calendar_id = $calendar->id;
                $time->save();
            }

            if ($request->has('types_add')) {
                $arrTypeAdd = $request->types_add;
                $arrTime = $request->time_shows_add;

                for ($i=0; $i < count($arrTypeAdd); $i++) {
                    $time = new CalendarTime;
                    $time->type_ticket = $arrTypeAdd[$i];
                    $time->time_show = $arrTime[$i];
                    $time->calendar_id = $calendar->id;
                    $time->save();
                }
            }

            // delete time if user choose
            if ($request->has('calendarTimes_id')) {
                foreach ($request->calendarTimes_id as $calTimeID) {
                    $calTime = CalendarTime::findOrFail($calTimeID);
                    $calTime->delete();
                }
            }
            return back()->with('success', 'Sửa thành công');
        } else {
            return back()->withErrors('Lỗi, phim đã có lịch chiếu ngày '.$dateShow .' ở ' . $roomName->name . ' rạp ' . $theaterName[0]->name);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calendar = Calendar::findOrFail($id);
        $calendar->calendarTimes()->delete();

        foreach ($calendar->tickets as $ticket) {
            foreach ($ticket->seats as $seat) {
                $seat->delete();
            }
            $ticket->delete();
        }
        $calendar->delete();

        return redirect('admin/calendars/')->with('success', 'Xóa thành công');
    }


    public function show($id)
    {
        $film = Film::findOrFail($id);
        $comments = $film->comments()->orderBy('id', 'desc')->get();
        $theaters = Theater::all();

        return view('page.lichchieu', ['film' => $film, 'comments' => $comments, 'theaters' => $theaters]);
    }

    public function ajaxShow($theaterID, $filmID)
    {
        $theater = Theater::findOrFail($theaterID);
        $calendars = $theater->calendars()->where('film_id', $filmID)->where('date_show', '>=', date('d/m/Y'))->orderBy('date_show', 'asc')->get();

        $arrCalTimes = [];
        foreach ($calendars as $cal) {
            foreach ($cal->calendarTimes as $calTimes) {
                $arrCalTimes[$cal->date_show][] = $calTimes;
            }
        }
        return response()->json([
            'theater' => $theater,
            'caltimes' => $arrCalTimes,
        ]);
    }
}
