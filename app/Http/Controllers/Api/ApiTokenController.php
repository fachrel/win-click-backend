<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Token;
use App\Models\License;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiTokenController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'access_token' => 'required|string',
            'expires' => 'nullable|string',
            'user.email' => 'required|email',
            'user.image' => 'nullable|string',
            'user.name' => 'nullable|string',
            'public' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $userData = $request->input('user');
        $email = $userData['email'];
        $name = $userData['name'] ?? null;
        $image = $userData['image'] ?? null;
        $accessToken = $request->input('access_token');
        $expiresAt = $request->input('expires');
        $visibility = $request->input('public') ?? false;
        $status = $request->input('status') ?? true;

        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        $expires = $expiresAt ? Carbon::parse($expiresAt) : null;

        $token = Token::updateOrCreate(
            ['user_id' => $user->id, 'email' => $email], // Composite key: user_id and email
            [
                'access_token' => $accessToken,
                'expires' => $expires,
                'image' => $image,
                'name' => $name,
                'visibility' => $visibility,
                'status' => $status,
            ]
        );

        return response()->json(['message' => 'Token ' . ($token->wasRecentlyCreated ? 'created' : 'updated') . ' successfully', 'data' => $token], 201);
    }

    public function getToken(): \Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check for user's license with active or pending status
            $license = License::where('user_id', $user->id)
                ->where('license_type', 'imagefx-image-gen')
                ->whereIn('status', [0, 4]) // 0: active, 4: pending
                ->first();

            if (!$license) {
                return response()->json(['success' => false, 'message' => 'No active or pending license found for imagefx-image-gen.'], 404);
            }

            // Check for expired license
            if ($license->status === 0 && $license->valid_until && $license->valid_until->isPast()) {
                $license->status = 2; // Expired
                $license->save();
                return response()->json(['success' => false, 'message' => 'Your imagefx-image-gen license has expired.'], 403);
            }

            // Activate pending license if found
            if ($license->status === 4) { // Pending
                $license->status = 0; // Active
                $license->activation_date = now();
                $license->valid_until = now()->addDays($license->active_days);
                $license->save();
            }

            // Check for existing active token
            $token = Token::where('user_id', $user->id)->where('status', 1)->first();
            if ($token) {
                return response()->json([
                    'success' => true,
                    'token' => $token->access_token,
                    'email' => $token->email
                ]);
            }

            // If no user-specific token, check for a public token (only if authenticated)
            $publicToken = Token::where('visibility', 1)->where('status', 1)->first();

            if ($publicToken) {
                return response()->json([
                    'success' => true,
                    'token' => $publicToken->access_token,
                    'email' => $publicToken->email
                ]);
            }

            return response()->json(['success' => false, 'message' => 'No token found for this user.'], 404);
        }

        return response()->json(['success' => false, 'message' => 'Authentication required to get a token.'], 401);
    }
}
