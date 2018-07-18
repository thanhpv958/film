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
    public function index()
    {
        $theaters = Theater::all();

        return view('admin.theater.list', ['theaters' => $theaters]);
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
                $filename = str_random(4) . '_' . $fileTheater->getClientOriginalName();
                $filename = $this->checkFileExist('img/theater/', $filename);
                $fileTheater->move('img/theater/', $filename);
                $theater->imguploads()->create([ 'image' => $filename ]);
            }
        }

        // create price tickets of theater
        $arrayType = $request->types;
        $arrayPrice = $request->price_per_tickets;

        for ($i = 0; $i < count($arrayType); $i++) {
            $ticketPrice = new TicketPrice;
            $ticketPrice->type = $arrayType[$i];
            $ticketPrice->price_per_ticket = $arrayPrice[$i];
            $ticketPrice->theater_id = $theater->id;
            $ticketPrice->save();
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
        $theater = Theater::find($id);
        $ticketPrice = TicketPrice::where('theater_id', $id)->get();
        return view('admin.theater.edit', ['theater' => $theater, 'ticketPrice' => $ticketPrice]);
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
        $theater = Theater::find($id);
        $theater->name = $request->name;
        $theater->phone = $request->phone;
        $theater->address = $request->address;
        $theater->description = $request->description;
        $theater->save();

        // delete image theater if user select
        if ($request->has('image_theater_id')) {
            foreach ($request->image_theater_id as $idDelImg) {
                $imgUpload = ImageUpload::find($idDelImg);
                if (file_exists('img/theater/' . $imgUpload->image)) {
                    unlink('img/theater/' . $imgUpload->image);
                }

                $imgUpload->delete();
            }
        }

        // update image
        if ($request->hasFile('image_theater')) {
            foreach ($request->file('image_theater') as $fileTheater) {
                $filename = str_random(4) . '_' . $fileTheater->getClientOriginalName();
                $filename = $this->checkFileExist('img/theater/', $filename);
                $fileTheater->move('img/theater/', $filename);
                $theater->imguploads()->create([ 'image' => $filename ]);
            }
        }

        // // update ticket price
        $arrayType = $request->types;
        $arrayIdType = $request->typeTickets_id;
        $arrayPrice = $request->price_per_tickets;

        //delete all ticket price in theater
        $ticketPrices = TicketPrice::where('theater_id', $theater->id)->delete();
        // update ticket price
        for ($i = 0; $i < count($arrayType); $i++) {
            $ticketPrice = new TicketPrice;
            $ticketPrice->type = $arrayType[$i];
            $ticketPrice->price_per_ticket = $arrayPrice[$i];
            $ticketPrice->theater_id = $theater->id;
            $ticketPrice->save();
        }
        return redirect('admin/theaters/'.$id.'/edit')->with('success', 'Sửa thành công');
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
        $theater = Theater::find($id);

        // imgupload
        $imgUpload = $theater->imguploads();
        $imgUpload->delete();

        // ticket prices
        foreach ($imgUpload->get() as $img) {
            if ($img->image != null && file_exists('img/theater/' . $img->image)) {
                unlink('img/theater/' . $img->image);
            }
        }
        $ticketPrice->delete();

        //records relationship: calendarTimes, calendars, rooms
        $rooms = $theater->rooms();
        foreach ($rooms->get() as $r) {
            foreach ($r->calendars as $cal) {
                foreach ($cal->calendarTimes as $calTime) {
                    $calTime->delete();
                }
                $cal->delete();
            }
        }
        $rooms->delete();

        //theater
        $theater->delete();

        return redirect('admin/theaters')->with('success', 'Xóa thành công');
    }


    // front end
    public function show()
    {
        $theaters = Theater::all();
        return view('page.theater', ['theaters' => $theaters]);
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
}
