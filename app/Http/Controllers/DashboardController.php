<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\TokenLog;
use Illuminate\Http\Request;
use App\Models\GenerationLog;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $totalImageFxRequestToday = TokenLog::whereDate('generation_date', $today)->sum('generation_count');
        $totalImageGeneratedToday = GenerationLog::whereDate('created_at', $today)->sum('generated_image_count');

        return view('dashboard', compact('totalImageFxRequestToday', 'totalImageGeneratedToday'));
    }
    public function gettotalImageFxRequestToday()
    {
        $today = Carbon::today();
        $totalImageFxRequestToday = TokenLog::whereDate('generation_date', $today)->sum('generation_count');

        return response()->json(['totalImageFxRequestToday' => $totalImageFxRequestToday]);
    }
    
}
