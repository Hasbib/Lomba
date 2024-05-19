<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Pesan;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Storage;

class UsersController extends Controller
{
    public function login()
    {
        return Inertia::render('Utama/Login', [
            'users' => User::all(),
        ]);
    }
    public function daftar()
    {
        return Inertia::render('Utama/Daftar', [
            'users' => User::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:50'],
            'username' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email'],
            'password' => ['required'],
        ]);

        $existingUser = User::where('email', $validatedData['email'])->first();
        if ($existingUser) {
            return redirect()->back()->withErrors(['email' => 'Email sudah terdaftar', 'username' => 'Username sudah terdaftar']);
        }
        $existingUserUsername = User::where('username', $validatedData['username'])->first();
        if ($existingUserUsername) {
            return redirect()->back()->withErrors(['username' => 'Username sudah terdaftar', 'email' => 'Email sudah terdaftar']);
        }

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = $request->input('role', 'peserta');

        $user = User::create($validatedData);

        switch ($validatedData['role']) {
            case 'admin':
                return redirect()->route('administrator')->with('message', 'Akun berhasil dibuat');
            case 'juri':
                return redirect()->route('administrator')->with('message', 'Akun berhasil dibuat');
            case 'petugas':
                return redirect()->route('administrator')->with('message', 'Akun berhasil dibuat');
            case 'peserta':
                Auth::login($user);
                $request->session()->put('id', $user->id);
                $request->session()->put('username', $user->username);
                $request->session()->put('name', $user->name);
                $request->session()->put('role', $user->role);
                $request->session()->put('isLoggedIn', true);
                return redirect()->route('overview')->with('message', 'Akun berhasil dibuat');
            default:
                return redirect('/')->with('error', 'Unauthorized access.');
        }
    }



    public function show(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->put('id', Auth::user()->id);
            $request->session()->put('username', Auth::user()->username);
            $request->session()->put('name', Auth::user()->name);
            $request->session()->put('role', Auth::user()->role);
            $request->session()->put('isLoggedIn', true);

            return [
                'login' => true,
                'role' => Auth::user()->role
            ];
        } else {
            return redirect()->back()->withErrors(['username' => 'Invalid username or password.']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();  // Clear all session data
        return redirect()->route('login')->with('message', 'Successfully logged out');
    }

    public function partisipan()
    {
        $username = session('username');
        $name = session('name');

        $peserta = User::where('role', 'peserta')->get();
        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Admin/Partisipan', [
            'username' => $username,
            'name' => $name,

            'unreadCount' => $unreadCount,

            'users' => $peserta->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'prodi' => $user->prodi,
                    'status' => $user->status,
                    'created_at' => $user->created_at->format('Y-m-d')
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

    public function profil(User $user)
    {
        $user = User::findOrFail(session('id'));

        if ($user) {
            return Inertia::render('Role/Peserta/Profilpeserta', [
                'user' => $user,
                'username' => $user->username,
                'name' => $user->name,

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

    public function update(Request $request, User $user)
    {

        $validations = [
            'form.name' => 'required|max:225',
            'form.email' => 'required|max:225',
            'form.nik' => 'required|max:225',
            'form.prodi' => 'required|max:225',
            'form.kontak' => 'required|max:225',
        ];

        if ($request->hasFile('form.images')) {
            $validations['form.images'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validated = $request->validate($validations);

        if ($request->hasFile('form.images')) {
            if ($user->images) {
                Storage::delete('public/uploads/' . $user->images);
            }
            $image = $request->file('form.images');
            $imageName = $image->getClientOriginalName();
            $imagePath = $request->file('form.images')->storeAs('public/uploads', $imageName);
            $validated['form']['images'] = $imageName;
        } else {
            $validated['form']['images'] = $user->images;
        }
        if (
            $user->name === $validated['form']['name'] &&
            $user->email === $validated['form']['email'] &&
            $user->nik === $validated['form']['nik'] &&
            $user->prodi === $validated['form']['prodi'] &&
            $user->kontak === $validated['form']['kontak'] &&
            $user->images === $validated['form']['images']
        ) {
            return redirect()->route('profil.index')->with(['message' => ['info' => 'Tidak ada perubahan', 'edited' => false]]);
        }

        $user->update($validated['form']);

        return redirect()->route('profil.index')->with(['message' => ['info' => 'Perubahan berhasil disimpan', 'edited' => true]]);


        // $user = User::findOrFail(session('id'));
        // $validated = request()->validate([
        //     'name' => 'required|max:225',
        //     'email' => 'required|max:225',
        //     'nik' => 'required|max:225',
        //     'prodi' => 'required|max:225',
        //     'kontak' => 'required|max:225',
        // ]);
        // if (
        //     $user->name === $validated['name'] &&
        //     $user->email === $validated['email'] &&
        //     $user->nik === $validated['nik'] &&
        //     $user->prodi === $validated['prodi'] &&
        //     $user->kontak === $validated['kontak']
        // ) {

        //     return Redirect::route('profil.index')->with(['message' => ['info' => 'Tidak ada perubahan', 'edited' => false]]);
        // }
        // $user->update($validated);

        // return Redirect::route('profil.index')->with(['message' => ['info' => 'Perubahan berhasil disimpan', 'edited' => true]]);
    }

    public function lupapassword()
    {
        return Inertia::render('Utama/Lupapassword');
    }

    public function showemail(Request $request, User $user)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
        ]);

        // $user->sendEmailVerificationNotification();
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email tidak terdaftar']);
        }

        return Redirect::route('login')->name('message', 'Konfirmasi Email');
    }

    public function konfirmasi()
    {
        return Inertia::render('Utama/Konfirmasi');
    }

    public function updatepw(Request $request, User $user)
    {
        //     $validated = $request->validate([
        //         'password' => ['required'],
        //     ]);
        //     $validatedData['password'] = bcrypt($validatedData['password']);

        //     $user->update($validated);
        //     return Redirect::route('login')->with('message', 'Update succesfully');
    }    // {
    //     return Inertia::render('Utama/Auth/VerifyEmail', [
    //         'users' => User::all(),
    //     ]);
    // }

}