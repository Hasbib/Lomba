<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Kriteria;
use App\Models\Pesan;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KriteriaController extends Controller
{
    //

    public function kriteria()
    {
        $username = session('username');
        $name = session('name');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Admin/Kriteria', [
            'username' => $username,
            'name' => $name,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            }),
            'kriterias' => Kriteria::all()->map(function ($kriteria) {
                return [
                    'id' => $kriteria->id,
                    'name' => $kriteria->name,
                    'bobot' => (int) $kriteria->bobot . '%'
                ];
            })
        ]);
    }
    public function tambahkriteria()
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Kriteria/Tambahkriteria', [
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:225',
            // 'bobot' => 'required|max:225'
        ]);

        Kriteria::create($validated);
        return Redirect::route('kriteria.index');
    }

    public function editkriteria(Kriteria $kriteria)
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Kriteria/Editkriteria', [
            'username' => $username,
            'name' => $name,

            'kriteria' => $kriteria,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $validated = $request->validate([
            'name' => 'required|max:225',
            // 'bobot' => 'required|max:225'
        ]);

        $kriteria->update($validated);
        return Redirect::route('kriteria.index');
    }

    public function detailkriteria(Kriteria $kriteria)
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Kriteria/Detailkriteria', [
            'username' => $username,
            'name' => $name,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            }),
            'kriteria' => [
                'id' => $kriteria->id,
                'name' => $kriteria->name,
                'bobot' => (int) $kriteria->bobot . '%'
            ]
        ]);
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return Redirect::route('kriteria.index');
    }
}