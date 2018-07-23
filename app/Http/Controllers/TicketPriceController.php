<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theater;
use App\TicketPrice;

class TicketPriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckRoleAdmin')->except(['show']);
    }

    public function index()
    {
        $theaters = Theater::all();

        return view('admin.ticketPrice.list', compact('theaters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theaters = Theater::pluck('name', 'id')->all();

        return view('admin.ticketPrice.add', compact('theaters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticketPrice = new TicketPrice;
        $tpDatas = TicketPrice::all();

        $tpType = $request->type;
        $theaterID = $request->theater_id;
        $theaterName = Theater::find($theaterID)->name;

        $flag = true;
        foreach ($tpDatas as $tp) {
            if ($tpType == $tp->type && $theaterID == $tp->theater_id) {
                $flag = false;
                break;
            }
        }

        if ($flag) {
            $ticketPrice->type = $tpType;
            $ticketPrice->price_per_ticket = $request->price_per_ticket;
            $ticketPrice->theater_id = $theaterID;
            $ticketPrice->save();

            return redirect('admin/ticketprices')->with('success', 'Thêm thành công');
        } else {
            return back()->withErrors("Vé $tpType này đã được thêm vào rạp $theaterName.");
        }
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
        $ticketPrice = TicketPrice::findOrFail($id);
        $theaters = Theater::pluck('name', 'id')->all();

        return view('admin.ticketPrice.edit', compact('ticketPrice', 'theaters'));
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
        $ticketPrice = TicketPrice::findOrFail($id);
        $ticketPrice->price_per_ticket = $request->price_per_ticket;
        $ticketPrice->theater_id = $request->theater_id;
        $ticketPrice->save();

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
        $ticketPrice = TicketPrice::findOrFail($id);
        $ticketPrice->delete();

        return back()->with('success', 'Xóa thành công');
    }
}
