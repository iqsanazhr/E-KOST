<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Kost $kost)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $kost->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
            'parent_id' => $request->input('parent_id'),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function destroy(\App\Models\Comment $comment)
    {
        // Authorize: User owns comment OR User is Admin
        if (auth()->id() != $comment->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
