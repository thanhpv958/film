<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TheaterRequest;
use App\Theater;
use App\TicketPrice;
use App\ImageUpload;

class TheaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('CheckRoleAdmin')->except(['show', 'showPage', 'ajaxShow']);
    }
    public function index()
    {
        $theaters = Theater::all();

        return view('admin.theater.list', compact('theaters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.theater.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TheaterRequest $request)
    {
        // create theater
        $theater = new Theater;
        $theater->name = $request->name;
        $theater->phone = $request->phone;
        $theater->address = $request->address;
        $theater->description = $request->description;
        $theater->save();

        // create image
        if ($request->hasFile('image_theater')) {
            foreach ($request->file('image_theater') as $fileTheater) {
                $filename = str_random(4) . '_' . preg_replace('/\s+/', '', $fileTheater->getClientOriginalName());
                $filename = $this->checkFileExist('storage/img/theater/', $filename);
                $fileTheater->move('storage/img/theater/', $filename);
                $theater->imguploads()->create([ 'image' => $filename ]);
            }
        }

        return redirect('admin/theaters')->with('success', 'Thêm thành công');
    }

    public function checkFileExist($path, $filename)
    {
        while (file_exists($path . $filename)) {
            return str_random(4) . '_' . $filename;
        }
        return $filename;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $theater = Theater::findOrFail($id);
        $ticketPrice = TicketPrice::where('theater_id', $id)->get();

        return view('admin.theater.edit', compact('theater', 'ticketPrice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TheaterRequest $request, $id)
    {
        //create theater
        $theater = Theater::findOrFail($id);
        $theater->name = $request->name;
        $theater->phone = $request->phone;
        $theater->address = $request->address;
        $theater->description = $request->description;
        $theater->save();

        // delete image theater if user select
        if ($request->has('image_theater_id')) {
            foreach ($request->image_theater_id as $imgDelID) {
                $imgUpload = ImageUpload::findOrFail($imgDelID);
                if (file_exists('storage/img/theater/' . $imgUpload->image)) {
                    unlink('storage/img/theater/' . $imgUpload->image);
                }

                $imgUpload->delete();
            }
        }

        //update image
        if ($request->hasFile('image_theater')) {
            foreach ($request->file('image_theater') as $fileTheater) {
                $filename = str_random(4) . '_' . preg_replace('/\s+/', '', $fileFilm->getClientOriginalName());
                $filename = $this->checkFileExist('storage/img/theater/', $filename);
                $fileTheater->move('storage/img/theater/', $filename);
                $theater->imguploads()->create([ 'image' => $filename ]);
            }
        }

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
        $ticketPrice = TicketPrice::where('theater_id', $id);
        $theater = Theater::findOrFail($id);

        // imgupload
        $imgUpload = $theater->imguploads();
        foreach ($imgUpload->get() as $img) {
            if ($img->image != null && file_exists('storage/img/theater/' . $img->image)) {
                unlink('storage/img/theater/' . $img->image);
            }
        }
        $imgUpload->delete();

        $ticketPrice->delete();

        //records relationship: calendarTimes, calendars, rooms
        $rooms = $theater->rooms();
        foreach ($rooms->get() as $r) {
            foreach ($r->calendars as $cal) {
                foreach ($cal->calendarTimes as $calTime) {
                    $calTime->delete();
                }
                foreach ($cal->tickets as $ticket) {
                    foreach ($ticket->seats as $seat) {
                        $seat->delete();
                    }
                    $ticket->delete();
                }
                $cal->delete();
            }
        }
        $rooms->delete();
        $theater->delete();

        return back()->with('success', 'Xóa thành công');
    }


    // front end
    public function show()
    {
        $theaters = Theater::all();
        return view('page.theater', compact('theaters'));
    }

    public function ajaxShow($id)
    {
        $theater = Theater::find($id);
        $imgUpload = $theater->imguploads()->orderBy('id', 'desc')->get();
        return response()->json([
            'theater' => $theater,
            'imgUpload' => $imgUpload,
        ]);
    }

    public function showPage($id)
    {
        $theater = Theater::findOrFail($id);
        $imgUpload = $theater->imguploads()->orderBy('id', 'desc')->get();
        return view('page.theater', compact('theater', 'imgUpload'));
    }
}
