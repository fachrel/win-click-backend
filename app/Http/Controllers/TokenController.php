<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\TokenLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TokenController extends Controller
{
    /**
     * Display a listing of the tokens.
     */
    public function index()
    {
        $tokens = Token::with('user')->get();
        $emails = $tokens->pluck('email')->unique()->filter();
        $totalGenerations = TokenLog::whereIn('email', $emails)
            ->groupBy('email')
            ->selectRaw('email, sum(generation_count) as total_generation')
            ->pluck('total_generation', 'email')
            ->toArray();
        return view('tokens.index', compact('tokens', "totalGenerations"));
    }

    /**
     * Show the form for editing the specified token.
     */
    public function edit(Token $token)
    {
        return response()->json($token); // Return JSON for AJAX
    }

    /**
     * Update the specified token in storage.
     */
    public function update(Request $request, Token $token)
    {
        $validator = Validator::make($request->all(), [
            'visibility' => 'required|integer|min:0|max:1',
            'status' => 'required|integer|min:0|max:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $token->update($request->only(['visibility', 'status']));

        return response()->json(['success' => 'Token updated successfully.']);
    }

    /**
     * Remove the specified token from storage.
     */
    public function destroy(Token $token)
    {
        $token->delete();
        return response()->json(['success' => 'Token deleted successfully.']);
    }
}
