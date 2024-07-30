<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.fakultas', [
            'title'     => 'Fakultas & Jurusan',
            'fakultas'  => Fakultas::all(),
            'jurusan'   => Jurusan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            // 'nama_fasili'          => 'required|max:255|unique:profils,title',
            'nama_fakultas'   => 'required',
        ]);

        Fakultas::create($attr);

        return back()->with('message', 'Fakultas berhasil ditambah');
    }

    public function storeJurusan(Request $request)
    {
        $attr = $request->validate([
            // 'nama_fasili'          => 'required|max:255|unique:profils,title',
            'nama_fakultas'   => 'required',
            'nama_jurusan'   => 'required',
        ]);

        Jurusan::create($attr);

        return back()->with('message', 'Jurusan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function show(Fakultas $fakultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function edit(Fakultas $fakultas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fakultas $fakultas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fakultas::destroy($id);
        return back()->with('message_delete', 'Fakultas berhasil dihapus');
    }
    public function destroyJurusan($id)
    {
        Jurusan::destroy($id);
        return back()->with('message_delete', 'Jurusan berhasil dihapus');
    }
}
