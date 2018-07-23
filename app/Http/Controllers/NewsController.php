<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewRequest;
use App\News;
use App\User;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return view('admin.new.list', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = News::all();
        $users = User::all();

        return view('admin.new.add', compact('news', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewRequest $request)
    {
        $new = new News;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = str_random(4) . '_' . preg_replace('/\s+/', '', $file->getClientOriginalName());
            while (file_exists('storage/img/news/' . $filename)) {
                $filename = str_random(4) . '_' . $filename;
            }
            $file->move('storage/img/news/', $filename);
            $new->image = $filename;
        };
        $new->title = $request->title;
        $new->body = $request->body;
        $new->type = $request->type;
        $new->status = $request->status;
        $new->user_id = $request->user_id;
        $new->save();

        return redirect('admin/news')->with('success', 'Thêm thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = News::find($id);

        return view('admin.new.edit', compact('new'));
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
        $new = News::find($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = str_random(4) . '_' . preg_replace('/\s+/', '', $file->getClientOriginalName());
            while (file_exists('storage/img/news/' . $filename)) {
                $filename = str_random(4) . '_' . $filename;
            }
            $file->move('storage/img/news/', $filename);
            if (file_exists('storage/img/news/' . $new->image)) {
                unlink('storage/img/news/'. $new->image);
            }
            $new->image = $filename;
        }
        $new->title = $request->title;
        $new->body = $request->body;
        $new->type = $request->type;
        $new->status = $request->status;
        $new->save();

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
        $new = News::find($id);
        $new->delete();

        return back()->with('success', 'Xóa thành công');
    }
    public function news()
    {
        $news = News::all();

        return view('page.tintuc', compact('news'));
    }
    public function newsDetail($id)
    {
        $news = News::all();
        $new = News::find($id);
        $latests = News::where('id', '<>', $id)->orderBy('created_at', 'desc')->where('type', '=', '1')->take(3)->get();

        return view('page.tinchitiet', ['news' => $news, 'new' => $new, 'latests' => $latests]);
    }
    public function promotions()
    {
        $promotions = News::all();

        return view('page.khuyenmai', ['promotions' => $promotions]);
    }
    public function promotionDetail($id)
    {
        $promotions = News::all();
        $promotion = News::find($id);
        $latest = News::where('id', '<>', $id)->where('type', '=', '2')->orderBy('created_at', 'desc')->take(3)->get();

        return view('page.kmchitiet', ['promotions' => $promotions, 'promotion' => $promotion, 'latest' => $latest]);
    }
}
