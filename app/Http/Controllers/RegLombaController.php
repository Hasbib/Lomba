<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\RegLomba;
use App\Models\Lomba;
use App\Models\Setting;
use App\Models\Submission;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Redirect;

class RegLombaController extends Controller
{
    //
    public function daftarlomba(User $user, Lomba $lomba)
    {
        $user = User::with('teamMembers')->findOrFail(session('id'));

        if ($user) {
            $username = session('username');
            $name = session('name');
            $regLomba = RegLomba::where('reg_peserta_id', $user->id)->whereStatus('draft')->first();
            $submission = Submission::where('sub_peserta_id', $user->id)->whereStatus('draft')->first();
            return Inertia::render('Role/Peserta/Daftarlomba', [
                'user' => $user,
                'username' => $username,
                'name' => $name,
                'reglomba' => $regLomba,
                'submission' => $submission,
                'members' => $user->teamMembers,
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
                ],
            ]);
        } else {
            return;
        }
    }

    public function addmember(Request $request)
    {
        $teamId = session('id');

        // Hapus semua anggota tim yang sudah ada
        $existingTeamMembers = TeamMember::where('team_peserta_id', $teamId)->get();

        foreach ($existingTeamMembers as $member) {
            if ($member->team_member_picture) {
                $this->deleteImage($member->team_member_picture);
            }
        }
        TeamMember::where('team_peserta_id', $teamId)->delete();

        // Tambahkan ketua tim
        $ketua = $request->input('ketua');
        $ketuaImage = $ketua['images'];
        $ketuaImagePath = null;
        if ($ketuaImage) {
            $ketuaImagePath = $this->copyImage($ketuaImage);
        }

        TeamMember::create([
            'team_peserta_id' => $teamId,
            'team_member_name' => $ketua['name'],
            'team_member_nik' => $ketua['nik'],
            'team_member_prodi' => $ketua['prodi'],
            'team_member_role' => $ketua['role'],
            'team_member_picture' => $ketuaImagePath
        ]);

        // Tambahkan anggota baru yang ada dalam form
        $members = $request->input('members');
        foreach ($members as $member) {
            // update only when has images
            $memberImagePath = null;
            if (isset($member['team_member_picture'])) {
                $memberImage = $member['team_member_picture'];
                if ($memberImage) {
                    $memberImagePath = $this->copyImage($memberImage);
                }
            }
            TeamMember::create([
                'team_peserta_id' => $teamId,
                'team_member_name' => $member['team_member_name'],
                'team_member_nik' => $member['team_member_nik'],
                'team_member_prodi' => $member['team_member_prodi'],
                'team_member_role' => $member['role'],
                'team_member_picture' => $memberImagePath
            ]);
        }

        return response()->json(['message' => 'Team member berhasil disimpan']);
    }


    private function copyImage($imageName)
    {
        $oldPath = 'public/uploads/peserta/profil/' . $imageName;
        $newPath = 'public/uploads/teammember/' . basename($imageName);
        // Salin gambar
        Storage::copy($oldPath, $newPath);
        return basename($imageName);
    }

    private function deleteImage($imageName)
    {
        $path = 'public/uploads/teammember/' . $imageName;
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    public function datatim(Lomba $lomba)
    {
        $user = User::findOrFail(session('id'));
        $regLomba = RegLomba::where('reg_peserta_id', $user->id)->whereStatus('draft')->first();
        if ($user) {
            return Inertia::render('Role/Peserta/Daftar/Datatim', [
                'username' => $user->username,
                'name' => $user->name,
                'userId' => $user->id,
                'reglomba' => $regLomba,

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
                'lomba' => [
                    'id' => $lomba->id,
                    'nama_lomba' => $lomba->nama_lomba,
                ],
            ]);
        } else {
            return;
        }
    }

    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'reg_nama_tim' => 'required|max:50',
        //     'reg_instansi' => 'required|max:50',
        //     'reg_nama_lomba' => 'required|exists:lombas,nama_lomba',
        //     'reg_no_whatsapp' => 'required|max:50',
        //     'reg_email' => 'required|max:50',
        //     'reg_bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'reg_peserta_id' => 'required|exists:users,id',
        // ]);
        // if ($request->hasFile('reg_bukti_pembayaran')) {
        //     $image = $request->file('reg_bukti_pembayaran');
        //     $imageName = $image->getClientOriginalName();
        //     $imagePath = $image->storeAs('public/uploads', $imageName);
        //     $validated['reg_bukti_pembayaran'] = $imageName;
        // }
        // RegLomba::create($validated);
        // return Redirect::route('reglomba.index')->with('message', 'Data tim berhasil di isi');


        if ($request->input('id') !== "undefined") {
            if ($request->input('id') !== "undefined") {
                $regLomba = RegLomba::findOrFail($request->input('id'));
                $oldImage = $regLomba->reg_bukti_pembayaran;
                $regLomba->update([
                    'reg_nama_tim' => $request->input('reg_nama_tim'),
                    'reg_instansi' => $request->input('reg_instansi'),
                    'reg_nama_lomba' => $request->input('reg_nama_lomba'),
                    'reg_no_whatsapp' => $request->input('reg_no_whatsapp'),
                    'reg_email' => $request->input('reg_email'),
                ]);

                if ($request->hasFile('reg_bukti_pembayaran')) {
                    $image = $request->file('reg_bukti_pembayaran');
                    $imageName = $image->getClientOriginalName();
                    $imagePath = $image->storeAs('public/uploads/peserta/registrasi', $imageName);
                    if ($oldImage) {
                        Storage::delete('public/uploads/peserta/registrasi/' . $oldImage);
                    }
                    $regLomba->reg_bukti_pembayaran = $imageName;
                    $regLomba->save();
                } else {
                    $regLomba->reg_bukti_pembayaran = $oldImage;
                    $regLomba->save();
                }
                $message = 'Data tim berhasil diupdate';
            }
        } else {
            $inputData = $request->all();
            if ($request->hasFile('reg_bukti_pembayaran')) {
                $image = $request->file('reg_bukti_pembayaran');
                $imageName = $image->getClientOriginalName();
                $imagePath = $image->storeAs('public/uploads/peserta/registrasi', $imageName);
                $inputData['reg_bukti_pembayaran'] = $imageName;
            }
            RegLomba::create($inputData);
            $message = 'Data tim berhasil diisi';
        }
        return Redirect::route('reglomba.index')->with('message', $message);
    }

    public function pengumpulankarya()
    {
        $user = User::findOrFail(session('id'));
        $SUBmission = Submission::where('sub_peserta_id', $user->id)->whereStatus('draft')->first();
        if ($user) {
            return Inertia::render('Role/Peserta/Daftar/Pengumpulankarya', [
                'username' => $user->username,
                'name' => $user->name,
                'userId' => $user->id,
                'submission' => $SUBmission,

                'settings' => Setting::all()->map(function ($setting) {
                    return [
                        'id' => $setting->id,
                        'nama_event' => $setting->nama_event,
                        'logo_1' => $setting->logo_1,
                    ];
                }),
            ]);
        } else {
            return;
        }
    }
    public function kirim(Request $request)
    {
        if ($request->input('id') !== "undefined") {
            if ($request->input('id') !== "undefined") {
                $SUBmission = Submission::findOrFail($request->input('id'));
                $oldImage = $SUBmission->sub_file;
                $SUBmission->update([
                    'sub_judul' => $request->input('sub_judul'),
                    'sub_deskripsi' => $request->input('sub_deskripsi'),
                    'sub_link' => $request->input('sub_link'),
                ]);

                if ($request->hasFile('sub_file')) {
                    $image = $request->file('sub_file');
                    $imageName = $image->getClientOriginalName();
                    $imagePath = $image->storeAs('public/uploads/peserta/registrasi', $imageName);
                    if ($oldImage) {
                        Storage::delete('public/uploads/peserta/registrasi/' . $oldImage);
                    }
                    $SUBmission->sub_file = $imageName;
                    $SUBmission->save();
                } else {
                    $SUBmission->sub_file = $oldImage;
                    $SUBmission->save();
                }
                $message = 'Data tim berhasil diupdate';
            }
        } else {
            $inputData = $request->all();
            if ($request->hasFile('sub_file')) {
                $image = $request->file('sub_file');
                $imageName = $image->getClientOriginalName();
                $imagePath = $image->storeAs('public/uploads/peserta/registrasi', $imageName);
                $inputData['sub_file'] = $imageName;
            }
            Submission::create($inputData);
            $message = 'Data tim berhasil diisi';
        }
        return Redirect::route('reglomba.index')->with('message', $message);
    }

    public function kirimHasil(Request $request)
    {
        $regLombaId = $request->input('regLombaId');
        $submissionId = $request->input('submissionId');

        $regLomba = RegLomba::findOrFail($regLombaId);
        $submission = Submission::findOrFail($submissionId);

        $regLomba->status = 'submitted';
        $submission->status = 'submitted';

        $regLomba->save();
        $submission->save();

        return response()->json(['isConfirmed' => true, 'message' => 'Karya berhasil dikirim']);
    }
}