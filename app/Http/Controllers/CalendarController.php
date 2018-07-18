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
        $roomName = Room::where('id', $roomID)->get();
        $filmID = $request->film_id;

        $flag = true;
        foreach ($calDatas as $cal) {
            if ($roomID == $cal->room_id && $filmID == $cal->film_id && $dateShow == $cal->date_show) {
                $flag = false;
                break;
            }
        }

        if ($flag) {
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
            return redirect('admin/calendars/create')->with('error', 'Lỗi, phim đã có lịch chiếu ngày '.$dateShow .' ở ' . $roomName[0]->name);
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
        $calendar = Calendar::find($id);
        $rooms = Room::where('theater_id', $calendar->room->theater->id)->get();
        return view('admin.calendar.edit', ['calendar' => $calendar, 'rooms' => $rooms]);
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
        $calendar = Calendar::find($id);
        $calendar->room_id = $request->room_id;
        $calendar->date_show = $request->date_show;
        $calendar->save();

        // update times
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

        // add time if user choose
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
                $calTime = CalendarTime::find($calTimeID);
                $calTime->delete();
            }
        }


        return redirect('admin/calendars/'.$id.'/edit')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calendar = Calendar::find($id);
        $calendar->calendarTimes()->delete();
        $calendar->delete();

        return redirect('admin/calendars/')->with('success', 'Xóa thành công');
    }


    public function show($id)
    {
        $film = Film::find($id);
        $comments = $film->comments()->orderBy('id', 'desc')->get();
        $theaters = Theater::all();

        return view('page.lichchieu', ['film' => $film, 'comments' => $comments, 'theaters' => $theaters]);
    }

    public function ajaxShow($theaterID)
    {
        $theater = Theater::find($theaterID);
        $calendars = $theater->calendars;

        $arrCalTimes = [];
        foreach ($calendars as $cal) {
            foreach ($cal->calendarTimes as $calTimes) {
                $arrCalTimes[$cal->date_show][] = $calTimes;
            }
        }
        //dd($arrCalTimes);
        return response()->json([
            'theater' => $theater,
            'caltimes' => $arrCalTimes,
        ]);
    }
}
