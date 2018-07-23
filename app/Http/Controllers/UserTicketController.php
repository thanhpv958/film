<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;

class UserTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $tk = [];
        foreach ($users as $user) {
            foreach ($user->tickets as $ticket) {
                $tk[] = $ticket;
            }
        }
        return view('admin.user_ticket.list', compact('tk'));
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        foreach ($ticket->seats as $seat) {
            $seat->delete();
        }
        $ticket->delete();

        return back()->with('success', 'Xoá thành công');
    }
}
