<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Setting;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\Pesan;

class SettingController extends Controller
{
    //
    public function tambahsetting()
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Setting/Tambahsetting', [
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
        // dd($request->all());
        $validated = $request->validate([
            'nama_event' => 'required|max:225',
            'judul' => 'required|max:225',
            'sub_judul' => 'required|max:225',
            'judul_deskripsi' => 'required|max:225',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'logo_1' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo_2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo_3' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('logo_1')) {
            $image = $request->file('logo_1');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/uploads/admin/setting', $imageName);
            $validated['logo_1'] = $imageName;
        }
        if ($request->hasFile('logo_2')) {
            $image = $request->file('logo_2');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/uploads/admin/setting', $imageName);
            $validated['logo_2'] = $imageName;
        }
        if ($request->hasFile('logo_3')) {
            $image = $request->file('logo_3');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/uploads/admin/setting', $imageName);
            $validated['logo_3'] = $imageName;
        }

        $validated['tanggal_mulai'] = Carbon::createFromFormat('Y-m-d', $validated['tanggal_mulai']);
        $validated['tanggal_berakhir'] = Carbon::createFromFormat('Y-m-d', $validated['tanggal_berakhir']);

        Setting::create($validated);
        return Redirect::route('setting.index')->with('message', 'Created succesfully');
    }

    public function setting()
    {
        $username = session('username');
        $name = session('name');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Admin/Setting', [
            'username' => $username,
            'name' => $name,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'judul' => $setting->judul,
                    'sub_judul' => $setting->sub_judul,
                    'tanggal_mulai' => Carbon::parse($setting->tanggal_mulai)->translatedFormat('d F Y'),
                    'tanggal_berakhir' => Carbon::parse($setting->tanggal_berakhir)->translatedFormat('d F Y'),
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }

    public function editsetting(Setting $setting)
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Setting/Editsetting', [
            'username' => $username,
            'name' => $name,

            'setting' => $setting,
            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }

    public function update(Request $request, Setting $setting)
    {
        $validations = [
            'form.nama_event' => 'required|max:225',
            'form.judul' => 'required|max:225',
            'form.sub_judul' => 'required|max:225',
            'form.judul_deskripsi' => 'required|max:225',
            'form.deskripsi' => 'required',
        ];
        if ($request->filled('form.tanggal_mulai')) {
            $validations['form.tanggal_mulai'] = 'required|date';
        }
        if ($request->filled('form.tanggal_mulai')) {
            $validations['form.tanggal_berakhir'] = 'required|date';
        }

        if ($request->hasFile('logo_1')) {
            $validations['logo_1'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        if ($request->hasFile('logo_2')) {
            $validations['logo_2'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        if ($request->hasFile('logo_3')) {
            $validations['logo_3'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validated = $request->validate($validations);

        if ($request->hasFile('form.logo_1')) {
            // Jika ada file baru yang diunggah, hapus foto lama
            if ($setting->logo_1) {
                Storage::delete('public/uploads/admin/setting/' . $setting->logo_1);
            }
            $image = $request->file('form.logo_1');
            $imageName = $image->getClientOriginalName();
            // Menggunakan hanya nama file sebagai nama yang disimpan
            $imagePath = $request->file('form.logo_1')->storeAs('public/uploads/admin/setting', $imageName);
            $validated['form']['logo_1'] = $imageName;
        } else {
            $validated['form']['logo_1'] = $setting->logo_1;
        }

        if ($request->hasFile('form.logo_2')) {
            // Jika ada file baru yang diunggah, hapus foto lama
            if ($setting->logo_2) {
                Storage::delete('public/uploads/admin/setting/' . $setting->logo_2);
            }
            $image = $request->file('form.logo_2');
            $imageName = $image->getClientOriginalName();
            // Menggunakan hanya nama file sebagai nama yang disimpan
            $imagePath = $request->file('form.logo_2')->storeAs('public/uploads/admin/setting', $imageName);
            $validated['form']['logo_2'] = $imageName;
        } else {
            $validated['form']['logo_2'] = $setting->logo_2;
        }

        if ($request->hasFile('form.logo_3')) {
            // Jika ada file baru yang diunggah, hapus foto lama
            if ($setting->logo_3) {
                Storage::delete('public/uploads/admin/setting/' . $setting->logo_3);
            }
            $image = $request->file('form.logo_3');
            $imageName = $image->getClientOriginalName();
            // Menggunakan hanya nama file sebagai nama yang disimpan
            $imagePath = $request->file('form.logo_3')->storeAs('public/uploads/admin/setting', $imageName);
            $validated['form']['logo_3'] = $imageName;
        } else {
            $validated['form']['logo_3'] = $setting->logo_3;
        }

        $setting->update($validated['form']);
        return Redirect::route('setting.index')->with('message', 'Update Sucesscully');
    }
}