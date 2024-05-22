<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Models\Setting;
use Inertia\Inertia;
use App\Models\Pesan;

class SponsorController extends Controller
{
    //
    public function tambahsponsor()
    {

        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Sponsor/Tambahsponsor', [
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

    public function sponsor()
    {
        $username = session('username');
        $name = session('name');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Admin/Sponsor', [
            'username' => $username,
            'name' => $name,

            'unreadCount' => $unreadCount,

            'sponsors' => Sponsor::all()->map(function ($sponsor) {
                return [
                    'id' => $sponsor->id,
                    'name' => $sponsor->name,
                    'link' => $sponsor->link,
                    'logo' => $sponsor->logo,
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
            'name' => 'required|max:225',
            'link' => 'required|max:225',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/uploads/admin/sponsor', $imageName);
            $validated['logo'] = $imageName;
        }

        Sponsor::create($validated);
        // return Redirect::route('sponsor.index')->with('message', 'Created succesfully');
        return Redirect::route('sponsor.index');
    }

    public function destroy(Sponsor $sponsor)
    {
        if ($sponsor->logo) {
            Storage::delete('public/uploads/admin/sponsor/' . $sponsor->logo);
        }

        $sponsor->delete();
        // return Redirect::route("sponsor.index")->with('message', 'delete succesfully');
        return Redirect::route("sponsor.index");
    }

    public function editsponsor(Sponsor $sponsor)
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Sponsor/Editsponsor', [
            'username' => $username,
            'name' => $name,

            'sponsor' => $sponsor,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
    public function update(Request $request, Sponsor $sponsor)
    {

        $validations = [
            'form.name' => 'required|max:225',
            'form.link' => 'required|max:225',
        ];

        if ($request->hasFile('form.logo')) {
            $validations['form.logo'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validated = $request->validate($validations);

        // $validated = $request->validate([
        //     'form.name' => 'required|max:225',
        //     'form.link' => 'required|max:225',
        //     'form.logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        if ($request->hasFile('form.logo')) {
            // Jika ada file baru yang diunggah, hapus foto lama
            if ($sponsor->logo) {
                Storage::delete('public/uploads/admin/sponsor/' . $sponsor->logo);
            }
            $image = $request->file('form.logo');
            $imageName = $image->getClientOriginalName();
            // Menggunakan hanya nama file sebagai nama yang disimpan
            $imagePath = $request->file('form.logo')->storeAs('public/uploads/admin/sponsor', $imageName);
            $validated['form']['logo'] = $imageName;
        } else {
            $validated['form']['logo'] = $sponsor->logo;
        }

        $sponsor->update($validated['form']);
        // return Redirect::route('sponsor.index')->with('message', 'Update successfully');
        return Redirect::route('sponsor.index');
    }

    public function detailsponsor(Sponsor $sponsor)
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Sponsor/Detailsponsor', [
            'username' => $username,
            'name' => $name,

            'sponsor' => $sponsor,

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