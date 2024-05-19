<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\RegLomba;
use App\Models\Lomba;
use App\Models\Setting;
use Illuminate\Http\Request;
use Redirect;

class RegLombaController extends Controller
{
    //
    public function daftarlomba(User $user)
    {
        $user = User::findOrFail(session('id'));

        if ($user) {
            $username = session('username');
            $name = session('name');
            return Inertia::render('Role/Peserta/Daftarlomba', [
                'user' => $user,
                'username' => $username,
                'name' => $name,

                'settings' => Setting::all()->map(function ($setting) {
                    return [
                        'id' => $setting->id,
                        'nama_event' => $setting->nama_event,
                        'logo_1' => $setting->logo_1,
                    ];
                })
            ]);
        } else {
            return;
        }
    }

    public function datatim(User $user, RegLomba $reglomba)
    {
        $user = User::findOrFail(session('id'));
        if ($user) {
            return Inertia::render('Role/Peserta/Daftar/Datatim', [
                'username' => $user->username,
                'name' => $user->name,
                'userId' => $user->id,
                'reglomba' => $reglomba,

                'settings' => Setting::all()->map(function ($setting) {
                    return [
                        'id' => $setting->id,
                        'nama_event' => $setting->nama_event,
                        'logo_1' => $setting->logo_1,
                    ];
                }),
                'lombas' => Lomba::all()->map(function ($lomba) {
                    return [
                        'id' => $lomba->id,
                        'nama_lomba' => $lomba->nama_lomba,
                    ];
                }),
            ]);
        } else {
            return;
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reg_nama_tim' => 'required|max:50',
            'reg_instansi' => 'required|max:50',
            'reg_nama_lomba' => 'required|exists:lombas,nama_lomba',
            'reg_no_whatsapp' => 'required|max:50',
            'reg_email' => 'required|max:50',
            'reg_bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'reg_peserta_id' => 'required|exists:users,id',
        ]);
        if ($request->hasFile('reg_bukti_pembayaran')) {
            $image = $request->file('reg_bukti_pembayaran');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/uploads', $imageName);
            $validated['reg_bukti_pembayaran'] = $imageName;
        }
        RegLomba::create($validated);
        return Redirect::route('reglomba.index')->with('message', 'Data tim berhasil di isi');
    }
    public function pengumpulankarya()
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Peserta/Daftar/Pengumpulankarya', [
            'username' => $username,
            'name' => $name,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
}