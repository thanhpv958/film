<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use App\Category;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::all();

        return view('admin.film.list', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.film.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $film = new Film;

        if ($request->hasFile('image')) {
            $fileFilm = $request->file('image');
            $filename = str_random(4) . '_' . $fileFilm->getClientOriginalName();
            while (file_exists('storage/img/film/' . $filename)) {
                $filename = str_random(4) . '_' . $filename;
            }
            $fileFilm->move('storage/img/film', $filename);
            $film->image = $filename;
        };

        $film->name = $request->name;
        $film->description = $request->description;
        $film->open_date = $request->open_date;
        $film->duration = $request->duration;
        $film->status = $request->status;
        $film->trailer_url = $request->trailer_url;
        $film->type = $request->type;
        $film->save();
        foreach ($request->category as $catID) {
            $film->categories()->attach($catID);
        }

        return redirect('admin/films')->with('success', 'Thêm thành công');
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
        $film = Film::find($id);
        $categories = Category::all();

        return view('admin.film.edit', compact('film', 'categories'));
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
        $film = Film::find($id);

        if ($request->hasFile('image')) {
            $fileFilm = $request->file('image');
            $filename = str_random(4) . '_' . $fileFilm->getClientOriginalName();
            while (file_exists('storage/img/film/' . $filename)) {
                $filename = str_random(4) . '_' . $filename;
            }

            if (file_exists('storage/img/film/' . $film->image)) {
                unlink('storage/img/film/' . $film->image);
            }
            $fileFilm->move('storage/img/film', $filename);
            $film->image = $filename;
        };

        $film->name = $request->name;
        $film->description = $request->description;
        $film->open_date = $request->open_date;
        $film->duration = $request->duration;
        $film->status = $request->status;
        $film->trailer_url = $request->trailer_url;
        $film->type = $request->type;

        if ($request->has('category')) {
            $film->categories()->detach();
            foreach ($request->category as $catID) {
                $film->categories()->attach($catID);
            }
        } else {
            $film->categories()->detach();
        }

        $film->save();

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
        $film = Film::find($id);

        foreach ($film->comments as $comment) {
            $comment->delete();
        }

        if (file_exists('storage/img/film/' . $film->image)) {
            unlink('storage/img/film/' . $film->image);
        }
        $film->categories()->detach();
        $film->delete();

        return back()->with('success', 'Xóa thành công');
    }
}
