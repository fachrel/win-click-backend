<?php

namespace App\Http\Controllers;

use App\Models\LicenseTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LicenseTemplateController extends Controller
{
    /**
     * Display a listing of the license templates.
     *
     */
    public function index()
    {
        $licenseTemplates = LicenseTemplate::all();
        return view('license-template.index', compact('licenseTemplates'));
    }

    /**
     * Store a newly created license template in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'license_type' => 'required|string|unique:license_templates',
            'max_devices' => 'nullable|integer|min:1',
            'application' => 'nullable|string',
            'daily_generation_limit' => 'nullable|integer|min:1',
            'workers' => 'nullable|integer|min:1',
            'version' => 'nullable|string',
            'active_days' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'is_trial' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $licenseTemplate = LicenseTemplate::create($request->all());

        return response()->json(['data' => $licenseTemplate, 'message' => 'License template created successfully'], 201);
    }

    /**
     * Display the specified license template.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $licenseTemplate = LicenseTemplate::find($id);

        if (!$licenseTemplate) {
            return response()->json(['message' => 'License template not found'], 404);
        }

        return response()->json(['data' => $licenseTemplate]);
    }

    /**
     * Update the specified license template in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $licenseTemplate = LicenseTemplate::find($id);

        if (!$licenseTemplate) {
            return response()->json(['message' => 'License template not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'license_type' => 'sometimes|required|string|unique:license_templates,license_type,' . $id,
            'max_devices' => 'nullable|integer|min:1',
            'application' => 'nullable|string',
            'daily_generation_limit' => 'nullable|integer|min:1',
            'workers' => 'nullable|integer|min:1',
            'version' => 'nullable|string',
            'active_days' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'is_trial' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $licenseTemplate->update($request->all());

        return response()->json(['data' => $licenseTemplate, 'message' => 'License template updated successfully']);
    }

    /**
     * Remove the specified license template from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $licenseTemplate = LicenseTemplate::find($id);

        if (!$licenseTemplate) {
            return response()->json(['message' => 'License template not found'], 404);
        }

        $licenseTemplate->delete();

        return response()->json(['message' => 'License template deleted successfully']);
    }
}