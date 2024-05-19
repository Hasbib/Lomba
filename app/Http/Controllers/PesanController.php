<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Pesan;
use App\Models\Setting;

class PesanController extends Controller
{
    public function pesan()
    {
        $username = session('username');
        $name = session('name');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();
        return Inertia::render('Role/Admin/Pesan', [
            'username' => $username,
            'name' => $name,

            'unreadCount' => $unreadCount,

            'pesans' => Pesan::all()->map(function ($pesan) {
                return [
                    'id' => $pesan->id,
                    'nama' => $pesan->nama,
                    'email' => $pesan->email,
                    'nomor' => $pesan->nomor,
                    'pesan' => $pesan->pesan,
                    'status' => $pesan->status
                ];
            }),
            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }

    public function store(Request $request)
    {
        $pesan = Pesan::create($request->validate([
            'nama' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email'],
            'nomor' => ['required', 'max:50'],
            'pesan' => ['required', 'max:250'],
        ]));

        $pesan->status = 'Belum Dibaca';
        $pesan->save();

        return to_route('pesan.index')->with('message', 'Pesan berhasil dikirim');
    }

    public function updateStatus(Request $request, $id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->status = $request->status;
        $pesan->save();

        return response()->json(['success' => true]);
    }
}