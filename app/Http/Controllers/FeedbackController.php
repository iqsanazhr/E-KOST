<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Feedback::create($request->all());

        return back()->with('success', 'Terima kasih atas masukan Anda!');
    }

    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(10);
        return view('dashboard.admin.feedbacks.index', compact('feedbacks'));
    }

    public function export()
    {
        $feedbacks = Feedback::latest()->get();
        $csvFileName = 'feedbacks_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($feedbacks) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Message', 'Created At']);

            foreach ($feedbacks as $feedback) {
                fputcsv($file, [
                    $feedback->id,
                    $feedback->name,
                    $feedback->email,
                    $feedback->message,
                    $feedback->created_at
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
