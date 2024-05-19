<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sponsor;
use App\Models\Berita;
use App\Models\Setting;
use Inertia\Inertia;
use App\Models\Pesan;
use App\Models\Lomba;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Index', [
            'isLoggedIn' => $request->session()->get('isLoggedIn', false),
            'sponsors' => Sponsor::all()->map(function ($sponsor) {
                return [
                    'id' => $sponsor->id,
                    'name' => $sponsor->name,
                    'link' => $sponsor->link,
                    'logo' => $sponsor->logo,
                ];
            }),
            'beritas' => Berita::all()->map(function ($berita) {
                return [
                    'id' => $berita->id,
                    'judul' => $berita->judul,
                    'deskripsi_awal' => $berita->deskripsi_awal,
                    'tanggal_upload' => Carbon::parse($berita->tanggal_upload)->translatedFormat('d F Y'),
                    'images' => $berita->images,
                ];
            }),
            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'judul' => $setting->judul,
                    'sub_judul' => $setting->sub_judul,
                    'judul_deskripsi' => $setting->judul_deskripsi,
                    'deskripsi' => $setting->deskripsi,
                    'tanggal_mulai' => Carbon::parse($setting->tanggal_mulai)->translatedFormat('d F Y'),
                    'tanggal_berakhir' => Carbon::parse($setting->tanggal_berakhir)->translatedFormat('d F Y'),
                    'logo_1' => $setting->logo_1,
                    'logo_2' => $setting->logo_2,
                    'logo_3' => $setting->logo_3,
                ];
            }),
            'lombas' => Lomba::all()->map(function ($lomba) {
                return [
                    'id' => $lomba->id,
                    'nama_lomba' => $lomba->nama_lomba,
                    'gambar' => $lomba->gambar,
                ];
            })
        ]);
    }
    public function kontak(Request $request)
    {
        return Inertia::render('Utama/Kontak', [
            'isLoggedIn' => $request->session()->get('isLoggedIn', false),
            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                    'logo_2' => $setting->logo_2,
                ];
            })
        ]);
    }

    public function lupapassword()
    {
        return Inertia::render('Utama/Lupapassword');
    }
    public function dashboard()
    {
        $username = session('username');
        $name = session('name');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();
        return Inertia::render('Role/Admin/Dashboard', [
            'username' => $username,
            'name' => $name,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }

    public function administrator()
    {
        $username = session('username');
        $name = session('name');
        $pengawas = User::whereIn('role', ['admin', 'juri', 'petugas'])->get();

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Admin/Administrator', [
            'username' => $username,
            'name' => $name,

            'unreadCount' => $unreadCount,

            'users' => $pengawas->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                    'lomba' => $user->lomba,
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
    public function tambahadministrator()
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Administrator/Tambahadministrator', [
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

    public function detailadministrator(User $user)
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Administrator/Detailadministrator', [
            'username' => $username,
            'name' => $name,

            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'password' => $user->password,
                'email' => $user->email,
                'role' => $user->role,
                'lomba' => $user->lomba,
                'created_at' => $user->created_at->format('Y-m-d')
            ],
            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }

    public function tim()
    {
        $username = session('username');
        $name = session('name');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();
        return Inertia::render('Role/Admin/Tim', [
            'username' => $username,
            'name' => $name,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }

    public function tabeltim()
    {
        $username = session('username');
        $name = session('name');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Admin/Tim/Tabeltim', [
            'username' => $username,
            'name' => $name,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
    public function detailtim()
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Admin/Tim/Detailtim', [
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

    public function rangking()
    {
        $username = session('username');
        $name = session('name');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Admin/Adminrangking', [
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
                    'gambar' => $lomba->gambar,
                ];
            })
        ]);
    }
    public function tabelrangking()
    {
        $username = session('username');
        $name = session('name');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Admin/Rangking/Tabelrangking', [
            'username' => $username,
            'name' => $name,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }



    public function dashboardjuri()
    {
        $username = session('username');
        return Inertia::render('Role/Juri/Dashboardjuri', [
            'username' => $username,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);

    }
    public function rangkingjuri()
    {
        $username = session('username');
        return Inertia::render('Role/Juri/Rangkingjuri', [
            'username' => $username,

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
                    'gambar' => $lomba->gambar,
                ];
            })
        ]);
    }
    public function tabelrangkingjuri()
    {
        $username = session('username');
        return Inertia::render('Role/Juri/Rangking/Tabelrangkingjuri', [
            'username' => $username,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
    public function lombajuri()
    {
        $username = session('username');
        return Inertia::render('Role/Juri/Lombajuri', [
            'username' => $username,

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
                    'gambar' => $lomba->gambar,
                ];
            })
        ]);
    }
    public function tabellomba()
    {
        $username = session('username');
        return Inertia::render('Role/Juri/Lomba/Tabellomba', [
            'username' => $username,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
    public function nilai()
    {
        $username = session('username');
        return Inertia::render('Role/Juri/Lomba/Nilai', [
            'username' => $username,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
    public function editnilai()
    {
        $username = session('username');
        return Inertia::render('Role/Juri/Lomba/Editnilai', [
            'username' => $username,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
    public function timdetailjuri()
    {
        $username = session('username');
        return Inertia::render('Role/Juri/Lomba/Timdetailjuri', [
            'username' => $username,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }



    public function dashboardpetugas()
    {
        $username = session('username');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Petugas/Dashboardpetugas', [
            'username' => $username,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
    public function partisipanpetugas()
    {
        $username = session('username');

        $peserta = User::where('role', 'peserta')->get();

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Petugas/Partisipanpetugas', [
            'username' => $username,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            }),
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
            })
        ]);
    }
    public function timpetugas()
    {
        $username = session('username');
        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Petugas/Timpetugas', [
            'username' => $username,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
    public function timdetail()
    {
        $username = session('username');
        return Inertia::render('Role/Petugas/Tim/Timdetail', [
            'username' => $username,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
    public function pesanpetugas()
    {
        $username = session('username');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Petugas/Pesanpetugas', [
            'username' => $username,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            }),
            'pesans' => Pesan::all()->map(function ($pesan) {
                return [
                    'id' => $pesan->id,
                    'nama' => $pesan->nama,
                    'email' => $pesan->email,
                    'nomor' => $pesan->nomor,
                    'pesan' => $pesan->pesan,
                    'status' => $pesan->status,
                ];
            }),
        ]);
    }
    public function updateStatus(Request $request, $id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->status = $request->status;
        $pesan->save();

        return response()->json(['success' => true]);
    }

    public function rangkingpetugas()
    {
        $username = session('username');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Petugas/Rangkingpetugas', [
            'username' => $username,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }
    public function petugasrangking()
    {
        $username = session('username');

        $unreadCount = Pesan::where('status', 'Belum Dibaca')->count();

        return Inertia::render('Role/Petugas/Rangking/Petugasrangking', [
            'username' => $username,

            'unreadCount' => $unreadCount,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            })
        ]);
    }


    public function overviewpeserta()
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Peserta/Overviewpeserta', [
            'username' => $username,
            'name' => $name,

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
                    'gambar' => $lomba->gambar,
                ];
            })
        ]);
    }
    public function detailpeserta(Lomba $lomba)
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Peserta/Detailpeserta', [
            'username' => $username,
            'name' => $name,

            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'nama_event' => $setting->nama_event,
                    'logo_1' => $setting->logo_1,
                ];
            }),
            'lomba' => [
                'id' => $lomba->id,
                'nama_lomba' => $lomba->nama_lomba,
                'deskripsi' => $lomba->deskripsi,
            ],
        ]);
    }

    public function notifikasipeserta()
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Peserta/Notifikasipeserta', [
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
    public function reportpeserta()
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Peserta/Reportpeserta', [
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
    public function detailtimreport()
    {
        $username = session('username');
        $name = session('name');
        return Inertia::render('Role/Peserta/Report/Detailtimreport', [
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




    public function proses()
    {
        return Inertia::render('Proses');
    }


}