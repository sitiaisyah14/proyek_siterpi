<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employee'] = Employee::orderBy('nama');
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(Request $request)
    {
        $employee = Employee::where('id', '!=', null);

        return datatables($employee)
            ->addIndexColumn()
            ->addColumn('options', function ($row) {
                $act['edit'] = route('employee.edit', ['employee' => $row->id]);
                $act['data'] = $row;

                return view('employee.options', $act)->render();
            })
            ->addColumn('foto', function ($d) {
                return '<img src="' . asset('storage/' . $d->foto) . '"' . 'alt="foto" width="100px" height="100px">';
            })
            ->addColumn('jk',function ($r) {
                if ($r->jk == 'L') {
                    $text = 'Laki-Laki';
              } else {
                  $text = 'Perempuan';
              }
              return $text;
            })
            ->addColumn('tgl_lahir',function($t) {
                return date('d M  Y', strtotime($t->tgl_lahir));
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function create()
    {
        return view('employee.create');
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
                    'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                    'nama' => 'required|regex:/^[\pL\s]+$/u',
                    'jk' => 'required',
                    'tempat_lahir' => 'required|regex:/^[\pL\s]+$/u',
                    'tgl_lahir' => 'required|date'
                ],
                [],
                $attributes
            );

            $employee = new Employee;
            $employee->nip = $employee->nip;
            $employee->nama = ucwords($request->nama);
            $employee->jk = $request->jk;
            $employee->tempat_lahir =ucwords($request->tempat_lahir);
            $employee->tgl_lahir = $request->tgl_lahir;

            if ($request->file('foto')) {
                $image_name = $request->file('foto')->store('foto_pegawai', 'public');
            }
            $employee->foto = $image_name;

            $employee->save();
            return redirect()->route('employee.index')->with(['message' => 'Data berhasil di simpan.']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('employee.index')->with(['error' => 'Data gagal di simpan.']);
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
    public function ditdit($id)
    {
        $employee = Employee::find($id);
        return view('employee.edit', compact('employee'));
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
                    'nama' => 'required|regex:/^[\pL\s]+$/u',
                    'jk' => 'required',
                    'tempat_lahir' => 'required|regex:/^[\pL\s]+$/u',
                    'tgl_lahir' => 'required|date'
                ],
                [],
                $attributes
            );

            $employee = Employee::find($id);
            $employee->nip = $employee->nip;
            $employee->nama = ucwords($request->nama);
            $employee->jk = $request->jk;
            $employee->tempat_lahir =ucwords($request->tempat_lahir);
            $employee->tgl_lahir = $request->tgl_lahir;

            if ($request->hasFile('foto')) {
                    $request -> validate([
                        'foto' => 'image|max:2048|mimes:png,jpg,jpeg',
                    ],
                );
                if ($employee->foto && file_exists(storage_path('app/public/'.$employee->foto))) {
                    Storage::delete('public/'.$employee->foto);
                }

                $image_name = $request->file('foto')->store('foto_pegawai','public');
                $employee->foto = $image_name;
            }
            $employee->save();
            return redirect()->route('employee.index')->with(['message' => 'Data berhasil diperbarui.']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('employee.index')->with(['error' => 'Data gagal diperbarui.']);
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
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employee.index')->with(['message' => 'Data berhasil dihapus.']);
    }

    public function exportData($request)
    {
        $employee = Employee::where('id', '!=', null);

        $data['employee'] = $employee->get();
        return $data;
    }

    public function pdf(Request $request)
    {
        $data = $this->exportData($request);

        $pdf = Pdf::loadview('employee.pdf', $data)
            ->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function excel(Request $request)
    {
        $data = $this->exportData($request);
        return Excel::download(new EmployeeExport($data), 'Laporan Data Pegawai.xlsx');
    }
}
