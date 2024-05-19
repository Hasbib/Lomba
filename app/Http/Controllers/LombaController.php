<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Setting;
use Inertia\Inertia;
use App\Models\Pesan;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;

class LombaController extends Controller
{
    //
    public function lomba()
    {
        $username = session('username');
        $name = session('name');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Admin/Lomba', [
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
            'lombas' => Lomba::all()->map(function ($lomba) {
                return [
                    'id' => $lomba->id,
                    'nama_lomba' => $lomba->nama_lomba,
                    'biaya_pendaftaran' => $lomba->biaya_pendaftaran,
                    'nama_pj' => $lomba->nama_pj,
                    'kontak_pj' => $lomba->kontak_pj
                ];
            })
        ]);
    }
    public function tambahlomba()
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Lomba/Tambahlomba', [
            'username' => $username,
            'name' => $name,

            'kriterias' => Kriteria::all()->map(function ($kriteria) {
                return [
                    'id' => $kriteria->id,
                    'name' => $kriteria->name,
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
        $validated = $request->validate([
            'nama_lomba' => 'required|max:225',
            'deskripsi' => 'required',
            'nama_pj' => 'required|max:225',
            'kontak_pj' => 'required|max:225',
            'tempat' => 'required|max:225',
            'biaya_pendaftaran' => 'required|max:225',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'sertifikat' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'selectedKriterias' => 'required|array'
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/uploads', $imageName);
            $validated['gambar'] = $imageName;
        }
        if ($request->hasFile('sertifikat')) {
            $image = $request->file('sertifikat');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/uploads', $imageName);
            $validated['sertifikat'] = $imageName;
        }

        $lomba = Lomba::create($validated);
        // Simpan relasi antara lomba dan kriteria
        $lomba->kriterias()->attach($request->selectedKriterias);
        // Lomba::create($validated);
        return Redirect::route('lomba.index')->with('message', 'Created succes');
    }

    public function editlomba(Lomba $lomba, Kriteria $kriterias)
    {
        $username = session('username');
        $name = session('name');

        $lomba->load('kriterias');

        return Inertia::render('Role/Admin/Lomba/Editlomba', [
            'username' => $username,
            'name' => $name,

            'lomba' => $lomba,

            'kriterias' => Kriteria::all()->map(function ($kriteria) {
                return [
                    'id' => $kriteria->id,
                    'name' => $kriteria->name,
                ];
            }),
            'selectedKriterias' => $lomba->kriterias->pluck('id'),

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }

    public function update(Request $request, Lomba $lomba)
    {
        $validations = [
            'form.nama_lomba' => 'required|max:225',
            'form.deskripsi' => 'required',
            'form.nama_pj' => 'required|max:225',
            'form.kontak_pj' => 'required|max:225',
            'form.tempat' => 'required|max:225',
            'form.biaya_pendaftaran' => 'required|max:225',
        ];

        if ($request->hasFile('form.gambar')) {
            $validations['form.gambar'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        if ($request->hasFile('form.sertifikat')) {
            $validations['form.sertifikat'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validated = $request->validate($validations);

        if ($request->hasFile('form.gambar')) {
            // Jika ada file baru yang diunggah, hapus foto lama
            if ($lomba->gambar) {
                Storage::delete('public/uploads/' . $lomba->gambar);
            }
            $image = $request->file('form.gambar');
            $imageName = $image->getClientOriginalName();
            // Menggunakan hanya nama file sebagai nama yang disimpan
            $imagePath = $request->file('form.gambar')->storeAs('public/uploads', $imageName);
            $validated['form']['gambar'] = $imageName;
        } else {
            $validated['form']['gambar'] = $lomba->gambar;
        }

        if ($request->hasFile('form.sertifikat')) {
            // Jika ada file baru yang diunggah, hapus foto lama
            if ($lomba->sertifikat) {
                Storage::delete('public/uploads/' . $lomba->sertifikat);
            }
            $image = $request->file('form.sertifikat');
            $imageName = $image->getClientOriginalName();
            // Menggunakan hanya nama file sebagai nama yang disimpan
            $imagePath = $request->file('form.sertifikat')->storeAs('public/uploads', $imageName);
            $validated['form']['sertifikat'] = $imageName;
        } else {
            $validated['form']['sertifikat'] = $lomba->sertifikat;
        }

        $lomba->update($validated['form']);
        $lomba->kriterias()->sync($request->form['selectedKriterias']);
        return Redirect::route('lomba.index');
    }

    public function detaillomba(Lomba $lomba)
    {
        $username = session('username');
        $name = session('name');

        $lomba->load('kriterias');

        return Inertia::render('Role/Admin/Lomba/Detaillomba', [
            'username' => $username,
            'name' => $name,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            }),

            'lomba' => $lomba,
        ]);
    }

    public function destroy(Lomba $lomba)
    {
        if ($lomba->images) {
            Storage::delete('public/uploads/' . $lomba->images);
        }
        if ($lomba->sertifikat) {
            Storage::delete('public/uploads/' . $lomba->sertifikat);
        }

        $lomba->delete();
        return Redirect::route("lomba.index");
    }
}