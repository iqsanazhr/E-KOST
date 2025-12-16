<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Facility;
use App\Models\KostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OwnerKostController extends Controller
{
    public function index()
    {
        $kosts = Auth::user()->kosts()->with('images')->latest()->get();
        return view('dashboard.owner.index', compact('kosts'));
    }

    public function create()
    {
        $facilities = Facility::all();
        return view('dashboard.owner.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kost' => 'required|string|max:255',
            'tipe' => 'required|in:putra,putri,campur',
            'harga_per_bulan' => 'required|numeric',
            'deskripsi' => 'required',
            'alamat_lengkap' => 'required',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'facilities' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $slug = \Illuminate\Support\Str::slug($request->nama_kost) . '-' . time();

        $kost = Auth::user()->kosts()->create([
            'nama_kost' => $request->nama_kost,
            'slug' => $slug,
            'tipe' => $request->tipe,
            'harga_per_bulan' => $request->harga_per_bulan,
            'deskripsi' => $request->deskripsi,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'status_verifikasi' => 'pending'
        ]);

        if ($request->has('facilities')) {
            $kost->facilities()->sync($request->facilities);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('kost-images', 'public');
                $kost->images()->create([
                    'path_foto' => $path,
                    'is_primary' => $index === 0 // Foto pertama jadi primary
                ]);
            }
        }

        return redirect()->route('owner.kosts.index')->with('success', 'Kost berhasil ditambahkan dan menunggu verifikasi.');
    }

    public function edit(Kost $kost)
    {
        if ($kost->user_id != Auth::id())
            abort(403);

        $facilities = Facility::all();
        return view('dashboard.owner.edit', compact('kost', 'facilities'));
    }

    public function update(Request $request, Kost $kost)
    {
        if ($kost->user_id != Auth::id())
            abort(403);

        $request->validate([
            'nama_kost' => 'required|string|max:255',
            'tipe' => 'required|in:putra,putri,campur',
            'harga_per_bulan' => 'required|numeric',
            'deskripsi' => 'required',
            'alamat_lengkap' => 'required',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'facilities' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $kost->update([
            'nama_kost' => $request->nama_kost,
            'tipe' => $request->tipe,
            'harga_per_bulan' => $request->harga_per_bulan,
            'deskripsi' => $request->deskripsi,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
        ]);

        if ($request->has('facilities')) {
            $kost->facilities()->sync($request->facilities);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('kost-images', 'public');
                $kost->images()->create([
                    'path_foto' => $path,
                    'is_primary' => false
                ]);
            }
        }

        return redirect()->route('owner.kosts.index')->with('success', 'Kost berhasil diperbarui.');
    }

    public function destroyImage(KostImage $image)
    {
        if ($image->kost->user_id != Auth::id())
            abort(403);

        Storage::disk('public')->delete($image->path_foto);
        $image->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function destroy(Kost $kost)
    {
        if ($kost->user_id != Auth::id())
            abort(403);

        $kost->delete();
        return redirect()->route('owner.kosts.index')->with('success', 'Kost berhasil dihapus.');
    }
}
