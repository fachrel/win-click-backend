@extends('layouts.app')
@section('title', 'Edit License')

@section('content')
<div class="">
    <form action="{{ route('licenses.update', $license->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="license_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">License Type</label>
            <input type="text" id="license_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->license_type }}" readonly>
        </div>

        <div class="mb-4">
            <label for="license_key" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">License Key</label>
            <input type="text" id="license_key" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->license_key }}" readonly>
        </div>

        <div class="mb-4">
            <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assign to User (Optional)</label>
            <select id="user_id" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="">-- Select a User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $license->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="">-- Select Status --</option>
                @foreach ($statuses as $key => $value)
                    <option value="{{ $key }}" {{ $license->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="valid_until" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valid Until</label>
            <input type="datetime-local" id="valid_until" name="valid_until" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->valid_until ? $license->valid_until->format('Y-m-d\TH:i') : '' }}">
        </div>

        <div class="mb-4">
            <label for="purchase_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Date</label>
            <input type="datetime-local" id="purchase_date" name="purchase_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->purchase_date ? $license->purchase_date->format('Y-m-d\TH:i') : '' }}">
        </div>

        <div class="mb-4">
            <label for="activation_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activation Date</label>
            <input type="datetime-local" id="activation_date" name="activation_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->activation_date ? $license->activation_date->format('Y-m-d\TH:i') : '' }}">
        </div>

        <div class="mb-4">
            <label for="devices_mac" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Devices MAC (JSON)</label>
            <textarea id="devices_mac" name="devices_mac" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->devices_mac }}</textarea>
            <small class="text-gray-500 dark:text-gray-400">Enter MAC addresses as a JSON array (e.g., ["AA:BB:CC:DD:EE:FF", "00:11:22:33:44:55"]).</small>
        </div>

        <div class="mb-4">
            <label for="max_devices" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max Devices</label>
            <input type="number" id="max_devices" name="max_devices" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->max_devices }}">
        </div>

        <div class="mb-4">
            <label for="application" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Application</label>
            <input type="text" id="application" name="application" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->application }}">
        </div>

        <div class="mb-4">
            <label for="daily_generation_limit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Daily Generation Limit</label>
            <input type="number" id="daily_generation_limit" name="daily_generation_limit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->daily_generation_limit }}">
        </div>

        <div class="mb-4">
            <label for="workers" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Workers</label>
            <input type="number" id="workers" name="workers" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->workers }}">
        </div>

        <div class="mb-4">
            <label for="version" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Version</label>
            <input type="text" id="version" name="version" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->version }}">
        </div>

        <div class="mb-4">
            <label for="active_days" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Active Days</label>
            <input type="number" id="active_days" name="active_days" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $license->active_days }}">
        </div>

        <div class="mb-4">
            <div class="flex items-center">
                <input id="is_trial" type="checkbox" name="is_trial" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ $license->is_trial ? 'checked' : '' }}>
                <label for="is_trial" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is Trial</label>
            </div>
        </div>

        <div class="mb-4">
            <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes</label>
            <textarea id="notes" name="notes" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $license->notes }}</textarea>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">Update License</button>
        <a href="{{ route('licenses.index') }}" class="inline-block ml-2 text-gray-500 hover:text-gray-700">Cancel</a>
    </form>
</div>
@endsection