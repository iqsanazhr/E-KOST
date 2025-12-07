<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Facility;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua fasilitas untuk filter
        $facilities = Facility::all();

        // Query Kost yang sudah diapprove
        $kosts = Kost::with(['images', 'facilities'])
            ->where('status_verifikasi', 'approved')
            ->filter($request->only(['search', 'tipe', 'min_price', 'max_price', 'facilities']))
            ->latest()
            ->paginate(12);

        return view('pages.home', compact('kosts', 'facilities'));
    }

    public function show($id)
    {
        $query = Kost::with(['owner', 'images', 'facilities']);

        // Jika user bukan admin (atau guest), hanya tampilkan yang approved
        // Asumsi: Auth::check() && Auth::user()->isAdmin() untuk cek admin
        // Atau kita bisa cek session/guard. Untuk simpelnya, kita cek jika user login dan role admin.

        $isAdmin = false;
        if (auth()->check() && auth()->user()->role === 'admin') {
            $isAdmin = true;
        }

        if (!$isAdmin) {
            $query->where('status_verifikasi', 'approved');
        }

        $kost = $query->findOrFail($id);

        return view('pages.kost.show', compact('kost'));
    }

    public function features()
    {
        return view('pages.features');
    }

    public function help()
    {
        return view('pages.help');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function safety()
    {
        return view('pages.safety');
    }
}
