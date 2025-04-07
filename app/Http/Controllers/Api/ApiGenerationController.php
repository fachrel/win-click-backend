<?php

namespace App\Http\Controllers\Api;

use App\Models\Token;
use App\Models\TokenLog;
use Illuminate\Http\Request;
use App\Models\GenerationLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiGenerationController extends Controller
{
    public function logGeneration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'prompt' => 'required|string',
            'aspect_ratio' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'message' => 'nullable|string',
            'generated_image_count' => 'nullable',
            'seed' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $email = $request->input('email');
        $prompt = $request->input('prompt');
        $aspectRatio = $request->input('aspect_ratio');
        $status = $request->input('status');
        $message = $request->input('message');
        $imageCount = $request->input('generated_image_count');
        $seed = $request->input('seed');

        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 404);
        }

        // Save to generation_logs table
        GenerationLog::create([
            'prompts' => $prompt,
            'email' => $email,
            'user_id' => $user->id,
            'aspect_ratio' => $aspectRatio,
            'status' => $status,
            'message' => $message,
            'generated_image_count' => $imageCount,
            'seed' => $seed,
        ]);

        $today = now()->toDateString();

        if ($status == 429 || $status == 401){
            Token::where('email', $email)
                ->update(['status' => 0]);
        }

        // Increment token log only if status is 200
        if ($status == 200) {
            $tokenLog = TokenLog::where('email', $email)
                ->where('generation_date', $today)
                ->first();

            if ($tokenLog) {
                $tokenLog->increment('generation_count');
            } else {
                TokenLog::create([
                    'email' => $email,
                    'generation_date' => $today,
                    'generation_count' => 1,
                ]);
            }
        }else {
            Token::where('email', $email)
            ->update(['status' => 0]);
        }

        return response()->json(['message' => 'Generation logged successfully.'], 200);
    }

}
