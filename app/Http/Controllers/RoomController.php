<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theater;
use App\Room;
use App\Http\Requests\RoomRequest;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();

        return view('admin.room.list', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theaters =  Theater::pluck('name', 'id');

        return view('admin.room.add', compact('theaters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        $room = new Room;
        $room->name = $request->name;
        $room->num_row = $request->num_row;
        $room->num_seat = $request->num_row;
        $room->theater_id = $request->theater_id;
        $room->save();

        return redirect('admin/rooms')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);
        $theaters =  Theater::pluck('name', 'id')->all();

        return view('admin.room.edit', compact('room', 'theaters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        $room->name = $request->name;
        $room->num_row = $request->num_row;
        $room->num_seat = $request->num_seat;
        $room->theater_id = $request->theater_id;
        $room->save();

        return back()->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);

        foreach ($room->calendars as $cal) {
            foreach ($cal->tickets as $ticket) {
                foreach ($ticket->seats as $seat) {
                    $seat->delete();
                }
                $ticket->delete();
            }

            foreach ($cal->calendarTimes as $calTime) {
                $calTime->delete();
            }
            $cal->delete();
        }
        $room->delete();

        return back()->with('success', 'Xóa thành công');
    }
}
