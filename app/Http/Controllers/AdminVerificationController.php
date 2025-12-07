<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;

class AdminVerificationController extends Controller
{
    public function index()
    {
        $pendingKosts = Kost::with('owner')->where('status_verifikasi', 'pending')->latest()->get();
        $activeKosts = Kost::with('owner')->where('status_verifikasi', 'approved')->latest()->get();
        return view('dashboard.admin.verification', compact('pendingKosts', 'activeKosts'));
    }

    public function approve($id)
    {
        $kost = Kost::findOrFail($id);
        $kost->update(['status_verifikasi' => 'approved']);

        return redirect()->back()->with('success', 'Kost disetujui.');
    }

    public function reject($id)
    {
        $kost = Kost::findOrFail($id);
        $kost->update(['status_verifikasi' => 'rejected']);

        return redirect()->back()->with('success', 'Kost ditolak.');
    }

    public function destroy($id)
    {
        $kost = Kost::findOrFail($id);
        $kost->delete();

        return redirect()->back()->with('success', 'Kost berhasil dihapus (delisting).');
    }
}
