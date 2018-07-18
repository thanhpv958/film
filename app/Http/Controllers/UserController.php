<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('checkLevel');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    public function showCustomer()
    {
        $users = User::all();

        return view('admin.user.listcus', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = str_random(4) . '_' . $file->getClientOriginalName();
            while (file_exists('storage/' . $filename)) {
                $filename = str_random(4) . '_' . $filename;
            }
            $file->move('storage/', $filename);
            $user->image = $filename;
        } else {
            $user->image = 'default-avatar.png';
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->birthday = $request->birthday;
        $user->rank = 1;
        $user->save();

        return redirect('admin/staf/create')->with('success', 'Thêm thành công');
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
        $roles = User::select('role')->distinct()->get();
        $user = User::find($id);

        return view('admin.user.edit', compact('roles', 'user'));
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
        $user = User::find($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = str_random(4) . '_' . $file->getClientOriginalName();
            while (file_exists('storage/' . $filename)) {
                $filename = str_random(4) . '_' . $filename;
            }
            $file->move('storage/', $filename);
            if (file_exists('storage/' . $user->image)) {
                unlink('storage/'. $user->image);
            }
            $user->image = $filename;
        };
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->birthday = $request->birthday;
        $user->rank =  1;
        $user->save();

        return redirect('admin/staf')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $sadmin = User::find(1);
        if ((Auth::user()->role) == $user->toArray()['role'] || $sadmin->id == 1) {
            return redirect('admin/users')->withErrors(['errors' => 'Bạn không được phép xoá']);
        } else {
            $user->delete();
            return redirect('admin/staf')->with('success', 'Xóa thành công');
        }
    }
    public function user()
    {
        return view('page.user.index');
    }
}
