<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['drug'] = Drug::orderBy('nama_obat');
        return view('drug.index');
    }

    public function data(Request $request)
    {
        $drug = Drug::where('id', '!=', null);

        return datatables($drug)
            ->addIndexColumn()
            ->addColumn('options', function($row){
                $act['edit'] = route('drug.edit', ['drug' => $row->id]);
                $act['data'] = $row;

                return view('drug.options', $act)->render();
            })
            ->escapeColumns([])
            ->make(true);
        return view('feed.indexdrug');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drug.create');
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
                    'nama_obat' => 'required|string',
                    ],
                    [],
                );

                $drug = new Drug;
                $drug->nama_obat = $request->nama_obat;
                $drug->stok_akhir = 0;

                $drug->save();
                return redirect()->route('drug.index')->with(['message' => 'Data berhasil di simpan.']);
            } catch (\Throwable $th) {
                throw $th;
                return redirect()->route('drug.index')->with(['message' => 'Data gagal di simpan.']);
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
        $drug = Drug::find($id);
        return view('drug.edit',compact('drug'));
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
        try {
            $request->validate(
                [
                   'nama_obat' => 'required|string',
                ],
                [],
            );

            $drug = Drug::find($id);
            $drug->nama_obat = $request->nama_obat;

            $drug->save();
            return redirect()->route('drug.index')->with(['message' => 'Data berhasil diperbarui.']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('drug.index')->with(['message' => 'Data gagal diperbarui.']);
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
        $drug = Drug::find($id);
        if ($drug->drugHistory()->exists()) {
            return redirect()->route('drug.index')->with(['error' => 'Data gagal dihapus.']);
        }
        $drug->delete();
        return redirect()->route('drug.index')->with(['message' => 'Data berhasil dihapus.']);
    }
}
