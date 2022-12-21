<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Feedhistory;
use App\Exports\FeedHistoryExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FeedhistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feed = Feed::orderBy('nama_pakan')->get();
        $from_date = Carbon::now()->startOfMonth()->format('Y-m-d');
        $to_date = Carbon::now()->endOfMonth()->format('Y-m-d');

        return view('historyfeed.index', compact('feed', 'from_date', 'to_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $feedhis = DB::table('feedhistories')
            ->selectRaw('feedhistories.*, users.name as user_name, feeds.nama_pakan as feed_name')
            ->join('users', 'users.id', '=', 'feedhistories.user_id')
            ->join('feeds', 'feeds.id', '=', 'feedhistories.feed_id')
            ->orderBy('created_at','desc');

        if ($request->from_date) {
            $feedhis->whereDate('feedhistories.tanggal', '>=', Carbon::parse($request->from_date));
        }

        if ($request->to_date) {
            $feedhis->whereDate('feedhistories.tanggal', '<=', Carbon::parse($request->to_date));
        }

        if ($request->feed_id) {
            $feedhis->where('feedhistories.feed_id', $request->feed_id);
        }

        return datatables($feedhis)
            ->addIndexColumn()
            ->editColumn('user_name', function ($u) {
                return $u->user_name;
            })
            ->editColumn('feed_name', function ($n) {
                return $n->feed_name;
            })
            ->editColumn('tanggal', function ($d) {
                $formatedDate = Carbon::createFromFormat('Y-m-d', $d->tanggal)->format('d-m-Y');
                return $formatedDate;
            })
            ->editColumn('masuk',function ($m) {
                return $m->masuk . ' Kg';
            })
            ->editColumn('keluar',function ($k) {
                return $k->keluar . ' Kg';
            })
            ->addColumn('options', function ($row) {
                $act['edit'] = route('historyfeed.edit', ['historyfeed' => $row->id]);
                $act['data'] = $row;

                return view('historyfeed.options', $act)->render();
            })
            ->escapeColumns([])
            ->make(true);
    }
    public function create()
    {
        $feedhis = Feedhistory::all();
        $feed = Feed::all();
        return view('historyfeed.create', compact('feedhis', 'feed'));
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
            $request->validate([
                'user_id' => 'required',
                'feed_id' => 'required',
                'tanggal' => 'required|date',
                'masuk' => 'required|numeric',
                'keluar' => 'required|numeric'
            ]);

            $feedhis =  new Feedhistory;
            $feedhis->user_id = $request->user_id;
            $feedhis->feed_id = $request->feed_id;
            $feedhis->tanggal = $request->tanggal;
            $feedhis->masuk = $request->masuk;
            $feedhis->keluar = $request->keluar;

            $feed = Feed::where('id', $request->feed_id);
            $value = $feed->value('stok_akhir');

            if ($request->keluar > $value) {
                return redirect()->route('historyfeed.create')->with(['error' => 'Data kurang dari permintaan']);
            } else {
                $feed->update(['stok_akhir' => $value + ($request->masuk) - ($request->keluar)]);
            }

            $feedhis->save();
            return redirect()->route('historyfeed.index')->with(['message' => 'Data berhasil disimpan']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('historyfeed.index')->with(['message' => 'Data gagal disimpan']);
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
        $feedhis = Feedhistory::find($id);
        $feed = Feed::all();
        return view('historyfeed.edit', compact('feedhis', 'feed'));
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
            $request->validate([
                'feed_id' => 'required',
                'tanggal' => 'required|date',
                'masuk' => 'required|numeric',
                'keluar' => 'required|numeric'
            ]);

            $feedhis = Feedhistory::find($id);
            $feedhis->user_id = $request->user_id;
            $feedhis->feed_id = $request->feed_id;
            $feedhis->tanggal = $request->tanggal;
            $feedhis->masuk = $request->masuk;
            $feedhis->keluar = $request->keluar;
            $feedhis->save();

            $feed = Feed::select('id')->where('id', $request->feed_id)->first();

            $valueMasuk = Feedhistory::where('feedhistories.feed_id', '=', $feed->id)->sum('masuk');
            $valueKeluar = Feedhistory::where('feedhistories.feed_id', '=', $feed->id)->sum('keluar');

            $feed->update(['stok_akhir' => $valueMasuk-$valueKeluar]);


            return redirect()->route('historyfeed.index')->with(['message' => 'Data berhasil diperbarui']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('historyfeed.index')->with(['message' => 'Data gagal diperbarui']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $feedhis = Feedhistory::find($id);
        $feedhis->delete();

        $feed = Feed::select('id')->where('id', '=', $feedhis->feed_id)->first();
        $valueMasuk = Feedhistory::where('feedhistories.feed_id', '=', $feed->id)->sum('masuk');
        $valueKeluar = Feedhistory::where('feedhistories.feed_id', '=', $feed->id)->sum('keluar');

        $feed->update(['stok_akhir' => $valueMasuk - $valueKeluar]);

        return redirect()->route('historyfeed.index')->with(['message' => 'Data berhasil dihapus.']);
    }

    public function exportData($request)
    {
        $feedhis = DB::table('feedhistories')
            ->selectRaw('feedhistories.*, users.name as user_name, feeds.nama_pakan as feed_name')
            ->join('users', 'users.id', '=', 'feedhistories.user_id')
            ->join('feeds', 'feeds.id', '=', 'feedhistories.feed_id');

        if ($request->from_date) {
            $feedhis->whereDate('feedhistories.tanggal', '>=', Carbon::parse($request->from_date));
        }

        if ($request->to_date) {
            $feedhis->whereDate('feedhistories.tanggal', '<=', Carbon::parse($request->to_date));
        }

        if ($request->feed_id) {
            $feedhis->where('feedhistories.feed_id', $request->feed_id);
        }

        $data['feed'] = Feed::find($request->feed_id);
        $data['feedhis'] = $feedhis->get();
        return $data;
    }
    public function pdf(Request $request)
    {
        $data = $this->exportData($request);

        $pdf = Pdf::loadview('historyfeed.pdf', $data)
            ->setPaper('f4', 'potrait');

        return $pdf->stream();
    }
    public function excel(Request $request)
    {
        $data = $this->exportData($request);
        return Excel::download(new FeedHistoryExport($data), 'Laporan Data Stok Pakan.xlsx');
    }
}
