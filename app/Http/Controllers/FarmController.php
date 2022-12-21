<?php

namespace App\Http\Controllers;

use App\Exports\FarmExport;
use App\Models\Farm;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;



class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['farm'] = Farm::orderBy('nis');
        return view('farm.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(Request $request)
    {
        $farm = Farm::where('id', '!=', null)->orderBy('created_at','desc');

        if ($request->status) {
            $farm->where('status', $request->status);
        }


        return datatables($farm)
            ->addIndexColumn()
            ->editColumn('tanggal_masuk', function ($d) {
                $formatedDate = Carbon::createFromFormat('Y-m-d', $d->tanggal_masuk)->format('d-m-Y');
                return $formatedDate;
            })
            ->addColumn('options', function ($row) {
                $act['edit'] = route('farm.edit', ['farm' => $row->id]);
                $act['data'] = $row;

                return view('farm.options', $act)->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function create()
    {
        return view('farm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = [
            'jk' => 'jenis kelamin',
        ];

        try {
            $request->validate(
                [
                    'nis' => 'required|numeric',
                    'tanggal_masuk' =>'required|date',
                    'jk' => 'required',
                    'status' => 'required|string',
                    'kondisi' => 'required|string',
                    'keterangan' => 'nullable'
                ],[],

                $attributes
            );

            $farm = new Farm;
            $farm->nis = $request->nis;
            $farm->tanggal_masuk = $request->tanggal_masuk;
            $farm->jk = $request->jk;
            $farm->status = $request->status;
            $farm->kondisi = $request->kondisi;
            $farm->keterangan = $request->keterangan;
            $farm->save();


            return redirect()->route('farm.index')->with(['message' => 'Data berhasil di simpan.']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('farm.index')->with(['error' => 'Data gagal di simpan.']);
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
        $farm = Farm::find($id);
        return view('farm.edit', compact('farm'));
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
        $attributes = [
            'jk' => 'jenis kelamin',
        ];
        try {
            $request->validate(
                [
                    'jk' => 'required',
                    'tanggal_masuk' =>'date',
                    'status' => 'required|string',
                    'kondisi' => 'required|string',
                    'keterangan' => 'nullable'
                ],
                [],
                $attributes
            );

            $farm = Farm::find($id);
            $farm->jk = $request->jk;
            $farm->status = $request->status;
            $farm->kondisi = $request->kondisi;
            $farm->keterangan = $request->keterangan;
            $farm->save();

            return redirect()->route('farm.index')->with(['message' => 'Data berhasil diperbarui.']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('farm.index')->with(['error' => 'Data gagal diperbarui.']);
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
        $farm = Farm::find($id);
        $farm->delete();

        return redirect()->route('farm.index')->with(['message' => 'Data berhasil dihapus.']);
    }
    public function exportData($request)
    {
        $farm = Farm::where('id', '!=', null);

        if ($request->status) {
            $farm->where('status', $request->status);
        }

        $data['status'] = $request->status;
        $data['farm'] = $farm->get();
        return $data;
    }

    public function pdf(Request $request)
    {
        $data = $this->exportData($request);

        $pdf = Pdf::loadview('farm.pdf', $data)
            ->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function excel(Request $request)
    {
        $data = $this->exportData($request);
        return Excel::download(new FarmExport($data), 'Laporan Data Sapi.xlsx');
    }
}
