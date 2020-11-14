<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'announcements' => Announcement::where('start_at', '<=', today()->startOfDay())
                ->where('expiration_at', '>=', today()->endOfDay())
                ->oldest()
                ->get()
        ]);
    }
}
