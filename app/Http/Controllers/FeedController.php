<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['feed'] = Feed::orderBy('nama_pakan');
        return view('feed.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function data(Request $request)
    {
        $feed = Feed::where('id', '!=', null);

        return datatables($feed)
            ->addIndexColumn()
            ->addColumn('options', function ($row) {
                $act['edit'] = route('feed.edit', ['feed' => $row->id]);
                $act['data'] = $row;

                return view('feed.options', $act)->render();
            })
            ->escapeColumns([])
            ->make(true);
    }
    public function create()
    {
        return view('feed.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                   'nama_pakan' => 'required|string',
                ],
                [],
            );

            $feed = new Feed;
            $feed->nama_pakan = $request->nama_pakan;
            $feed->stok_akhir = 0;

            $feed->save();
            return redirect()->route('feed.index')->with(['message' => 'Data berhasil di simpan.']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('feed.index')->with(['error' => 'Data gagal di simpan.']);
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
        $feed = Feed::find($id);
        return view('feed.edit',compact('feed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                   'nama_pakan' => 'required|string',

                ],
                [],
            );

            $feed = Feed::find($id);
            $feed->nama_pakan = $request->nama_pakan;


            $feed->save();
            return redirect()->route('feed.index')->with(['message' => 'Data berhasil diperbarui.']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('feed.index')->with(['error' => 'Data gagal diperbarui.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feed = Feed::find($id);
        if ($feed->feedHistory()->exists()) {
            return redirect()->route('feed.index')->with(['error' => 'Data gagal dihapus.']);
        }
        $feed->delete();
        return redirect()->route('feed.index')->with(['message' => 'Data berhasil dihapus.']);
    }
}
