<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = User::orderBy('id');
        return view('user.index', $data);
    }

    public function data(Request $request)
    {
        $user = User::where('id', '!=', null);

        return datatables($user)
            ->addIndexColumn()
            ->addColumn('options', function ($row) {
                $act['edit'] = route('user.edit', ['user' => $row->id]);
                $act['data'] = $row;

                return view('user.options', $act)->render();
            })
            ->addColumn('foto', function ($d) {
                return '<img src="' . asset('storage/' . $d->foto) . '"' . 'alt="foto" width="100px" height="100px">';
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
        return view('user.create');
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
                    'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                    'name' => 'required|regex:/^[\pL\s]+$/u',
                    'username' => 'required|string|unique:users',
                    'password' => 'required|min:8',
                    'position' => 'required'
                ],
                [],
            );

            $user = new User;

            $user->name = ucwords($request->name);
            $user->username = $request->username;
            $user->password = Hash::make($request->password);

            if ($request->file('foto')) {
                $image_name = $request->file('foto')->store('foto_user', 'public');
            }
            $user->foto = $image_name;

            $user->position = $request->position;

            $user->save();

            return redirect()->route('user.index')->with(['message' => 'Data berhasil di simpan.']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('user.index')->with(['error' => 'Data gagal di simpan.']);
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
        $user = User::find($id);
        return view('user.edit', compact('user'));
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
                    'name' => 'required|regex:/^[\pL\s]+$/u',
                    'username' => 'required|string|unique:users,username,'.$id,
                    'password' => 'min:8|confirmed|nullable',
                    'position' => 'required'
                ],
                [],
            );

            $user = User::findOrFail($id);

            $user->name = ucwords($request->name);
            $user->username = $request->username;
            $user->position = $request->position;

            if ($request->hasFile('foto')) {
                $request->validate(
                    [
                        'foto' => 'image|max:2048|mimes:png,jpg,jpeg',
                    ],
                );
                if ($user->foto && file_exists(storage_path('app/public/' . $user->foto))) {
                    Storage::delete('public/' . $user->foto);
                }

                $image_name = $request->file('foto')->store('foto_user', 'public');
                $user->foto = $image_name;
            }
            if ($request->password && $request->password_confirmation) {

                $user->password = Hash::make($request->password);
            }


            $user->save();


            return redirect()->route('user.index')->with(['message' => 'Data berhasil diperbarui.']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('user.index')->with(['error' => 'Data gagal diperbarui.']);
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
        $user = User::find($id);

        $auth =  Auth::user();
        if ($auth->id == $id ) {
            return redirect()->route('user.index')->with(['error' => 'Data gagal dihapus,dikarenakan user sedang digunakan.']);
        } else {
            if ($user->drugHistory()->exists()) {
                return redirect()->route('user.index')->with(['error' => 'Data gagal dihapus.']);
            }
            if ($user->feedHistory()->exists()) {
                return redirect()->route('user.index')->with(['error' => 'Data gagal dihapus.']);
            }
            $user->delete();
            return redirect()->route('user.index')->with(['message' => 'Data berhasil dihapus.']);
            // delete
        }
    }
}

