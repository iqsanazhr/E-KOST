<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Kost $kost)
    {
        $user = Auth::user();

        if ($user->favorites()->where('kost_id', $kost->id)->exists()) {
            $user->favorites()->detach($kost->id);
            $status = 'removed';
            $message = 'Dihapus dari favorit';
        } else {
            $user->favorites()->attach($kost->id);
            $status = 'added';
            $message = 'Ditambahkan ke favorit';
        }

        return back()->with('success', $message);
    }

    public function index()
    {
        $favorites = Auth::user()->favorites()->with('images')->latest()->paginate(12);
        return view('pages.favorites', compact('favorites'));
    }
}
