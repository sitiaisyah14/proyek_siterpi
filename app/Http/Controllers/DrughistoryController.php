<?php

namespace App\Http\Controllers;

use App\Exports\DrughistoryExport;
use App\Models\Drug;
use App\Models\Drughistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DrughistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drug = Drug::orderBy('nama_obat')->get();
        $from_date = Carbon::now()->startOfMonth()->format('Y-m-d');
        $to_date = Carbon::now()->endOfMonth()->format('Y-m-d');

        return view('historydrug.index', compact('drug', 'from_date', 'to_date'));
    }

    public function data(Request $request){
        $drughis = DB::table('drughistories')
        ->selectRaw('drughistories.*,drughistories.masuk as obatmasuk,drughistories.keluar as obatkeluar, users.name as user_name, drugs.nama_obat as drug_name,farms.nis as cow_nis, cow_health_histories.keterangan as keterangan ')
        ->join('users', 'users.id', '=', 'drughistories.user_id')
        ->join('drugs', 'drugs.id', '=', 'drughistories.drug_id')
        ->leftJoin('cow_health_histories','cow_health_histories.id', '=','drughistories.cowhealth_id')
        ->leftJoin('farms','farms.id', '=', 'cow_health_histories.farm_id')
        ->orderBy('created_at','desc');


        if ($request->from_date) {
            $drughis->whereDate('drughistories.tanggal', '>=', Carbon::parse($request->from_date));
        }

        if ($request->to_date) {
            $drughis->whereDate('drughistories.tanggal', '<=', Carbon::parse($request->to_date));
        }

        if ($request->drug_id) {
            $drughis->where('drughistories.drug_id', $request->drug_id);
        }

        return datatables($drughis)
            ->addIndexColumn()
            ->editColumn('user_name', function ($u) {
                return $u->user_name;
            })
            ->editColumn('drug_name', function ($n) {
                return $n->drug_name;
            })
            ->editColumn('keterangan', function ($t) {
                return $t->cow_nis.'-'.$t->keterangan;
            })
            ->editColumn('tanggal', function ($d) {
                $formatedDate = Carbon::createFromFormat('Y-m-d', $d->tanggal)->format('d-m-Y');
                return $formatedDate;
            })
            ->editColumn('masuk',function ($m) {
                return $m->masuk . ' Pcs';
            })
            ->editColumn('keluar',function ($k) {
                return $k->keluar . ' Pcs';
            })
            ->addColumn('options', function ($row) {
                $act['edit'] = route('historydrug.edit', ['historydrug' => $row->id]);
                $act['data'] = $row;

                return view('historydrug.options', $act)->render();
            })
            ->escapeColumns([])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drughis = Drughistory::all();
        $drug = Drug::all();
        return view('historydrug.create', compact('drughis', 'drug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'user_id' => 'required',
                'drug_id' => 'required',
                'cowhealth_id' => 'nullable',
                'tanggal' => 'required|date',
                'masuk' => 'required|numeric',
                'keluar' => 'required|numeric'
            ]);

            $drughis =  new Drughistory;
            $drughis->user_id = $request->user_id;
            $drughis->drug_id = $request->drug_id;
            $drughis->cowhealth_id = null;
            $drughis->tanggal = $request->tanggal;
            $drughis->masuk = $request->masuk;
            $drughis->keluar = $request->keluar;

            $drug = Drug::where('id', $request->drug_id);
            $value = $drug->value('stok_akhir');

            if ($request->keluar > $value) {
                return redirect()->route('historydrug.create')->with(['error'=> 'Data kurang dari permintaan']);
            } else {
                $drug->update(['stok_akhir' => $value + ($request->masuk) - ($request->keluar)]);
            }

            $drughis->save();
            return redirect()->route('historydrug.index')->with(['message' => 'Data berhasil disimpan']);

        }catch(\Throwable $th){
            throw $th;
            return redirect()->route('historydrug.index')->with(['message' => 'Data gagal disimpan']);
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
        $drughis = Drughistory::find($id);
        $drug = Drug::all();
        return view('historydrug.edit', compact('drughis', 'drug'));
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
        try{
            $request->validate([
                'drug_id' => 'required',
                'tanggal' => 'required|date',
                'masuk' => 'required|numeric',
                'keluar' => 'required|numeric'
            ]);

            $drughis = Drughistory::find($id);
            $drughis->user_id = $request->user_id;
            $drughis->drug_id = $request->drug_id;
            $drughis->tanggal = $request->tanggal;
            $drughis->masuk = $request->masuk;
            $drughis->keluar = $request->keluar;
            $drughis->save();

            $drug = Drug::select('id')->where('id', $request->drug_id)->first();
            $valueMasuk = Drughistory::where('drughistories.drug_id', '=', $drug->id)->sum('masuk');
            $valueKeluar = Drughistory::where('drughistories.drug_id', '=', $drug->id)->sum('keluar');

            $drug->update(['stok_akhir' => $valueMasuk - $valueKeluar]);

            return redirect()->route('historydrug.index')->with(['message' => 'Data berhasil diperbarui']);
        } catch(\Throwable $th){
            throw $th;
            return redirect()->route('historydrug.index')->with(['message' => 'Data gagal diperbarui']);
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
        $drughis = Drughistory::find($id);
        $drughis->delete();

        $drug = Drug::select('id')->where('id','=',$drughis->drug_id)->first();
        $valueMasuk = Drughistory::where('drughistories.drug_id', '=', $drug->id)->sum('masuk');
        $valueKeluar = Drughistory::where('drughistories.drug_id', '=', $drug->id)->sum('keluar');

        $drug->update(['stok_akhir' => $valueMasuk-$valueKeluar]);

        return redirect()->route('historydrug.index')->with(['message' => 'Data berhasil dihapus.']);
    }

    public function exportData($request)
    {
        $drughis = Drughistory::where('id', '!=', null);


        if ($request->drug_id) {
            $drughis->where('drughistories.drug_id', $request->drug_id);
        }

        if ($request->name) {
            $drughis->where('drughistories.user_id', $request->name);
        }

        if ($request->from_date) {
            $drughis->whereDate('drughistories.tanggal', '>=', Carbon::parse($request->from_date));
        }

        if ($request->to_date) {
            $drughis->whereDate('drughistories.tanggal', '<=', Carbon::parse($request->to_date));
        }

       $data['drug'] = Drug::find($request->drug_id);
       $data['name'] = $request->name;
       $data['drughis'] = $drughis->get();
       return $data;
    }

    public function pdf(Request $request)
    {
        $data = $this->exportData($request);

        $pdf = Pdf::loadview('historydrug.pdf', $data)
            ->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function excel(Request $request)
    {
        $data = $this->exportData($request);
        return Excel::download(new DrughistoryExport($data), 'Laporan Data Stok Obat.xlsx');
    }
}
