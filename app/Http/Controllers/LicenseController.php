<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\LicenseTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $licenses = License::with('user')->get();
        return view('licenses.index', compact('licenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $licenseTemplates = LicenseTemplate::all();
        $users = User::all();
        $statuses = [
            0 => 'Active',
            1 => 'Inactive',
            2 => 'Expired',
            3 => 'Revoked',
            4 => 'Pending',
        ];
        return view('licenses.create', compact('licenseTemplates', 'users', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'license_template_id' => 'required|exists:license_templates,id',
            'user_id' => 'nullable|exists:users,id',
            'notes' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1,2,3,4',
        ]);
    
        $template = LicenseTemplate::findOrFail($request->license_template_id);
    
        License::create([
            'user_id' => $request->user_id,
            'license_type' => $template->license_type,
            'license_key' => Str::uuid(), // Generate a unique license key
            'max_devices' => $template->max_devices,
            'application' => $template->application,
            'daily_generation_limit' => $template->daily_generation_limit,
            'workers' => $template->workers,
            'version' => $template->version,
            'is_trial' => $template->is_trial,
            'active_days' => $template->active_days, // Add active_days from the template
            'notes' => $request->notes,
            'status' => $request->status ?? 4, // Default to pending if not provided
            'purchase_date' => now(), // Set purchase date on creation
        ]);
    
        return redirect()->route('licenses.index')->with('success', 'License created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(License $license)
    {
        return view('licenses.show', compact('license'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(License $license)
    {
        $users = User::all();
        $statuses = [
            0 => 'Active',
            1 => 'Inactive',
            2 => 'Expired',
            3 => 'Revoked',
            4 => 'Pending',
        ];
        return view('licenses.edit', compact('license', 'users', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, License $license)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'status' => 'nullable|integer|in:0,1,2,3,4',
            'notes' => 'nullable|string',
            'valid_until' => 'nullable|date',
            'purchase_date' => 'nullable|date',
            'activation_date' => 'nullable|date',
            'devices_mac' => 'nullable|json',
            'max_devices' => 'nullable|integer|min:1',
            'application' => 'nullable|string',
            'daily_generation_limit' => 'nullable|integer|min:0',
            'workers' => 'nullable|integer|min:0',
            'version' => 'nullable|string',
            'is_trial' => 'nullable|boolean',
            'active_days' => 'nullable|integer|min:1', // Add validation for active_days
        ]);
    
        $license->update($request->all());
    
        return redirect()->route('licenses.index')->with('success', 'License updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(License $license)
    {
        $license->delete();
        return redirect()->route('licenses.index')->with('success', 'License deleted successfully.');
    }
}