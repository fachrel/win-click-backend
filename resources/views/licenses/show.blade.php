@extends('layouts.app')
@section('title', 'License Details')

@section('content')
<div class="">
    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">License Type</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->license_type }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">License Key</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->license_key }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->user ? $license->user->name . ' (' . $license->user->email . ')' : 'N/A' }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max Devices</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->max_devices }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valid Until</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->valid_until ? $license->valid_until->format('Y-m-d H:i:s') : 'N/A' }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Active Days</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->active_days }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Application</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->application }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            @switch($license->status)
                @case(0) Active @break
                @case(1) Inactive @break
                @case(2) Expired @break
                @case(3) Revoked @break
                @case(4) Pending @break
                @default Unknown
            @endswitch
        </p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Date</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->purchase_date ? $license->purchase_date->format('Y-m-d H:i:s') : 'N/A' }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activation Date</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->activation_date ? $license->activation_date->format('Y-m-d H:i:s') : 'N/A' }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Daily Generation Limit</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->daily_generation_limit }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Workers</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->workers }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->notes }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Version</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->version }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Is Trial</label>
        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->is_trial ? 'Yes' : 'No' }}</p>
    </div>

    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Devices MAC (JSON)</label>
        <pre class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->devices_mac }}</pre>
    </div>

    <a href="{{ route('licenses.index') }}" class="text-blue-700 hover:underline">Back to Licenses</a>
</div>
@endsection