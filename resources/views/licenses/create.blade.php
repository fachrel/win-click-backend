@extends('layouts.app')
@section('title', 'Create License')

@section('content')
<div class="">
    <form action="{{ route('licenses.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="license_template_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select License Template</label>
            <select id="license_template_id" name="license_template_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                <option value="">-- Select a Template --</option>
                @foreach ($licenseTemplates as $template)
                    <option value="{{ $template->id }}"
                            data-max-devices="{{ $template->max_devices }}"
                            data-application="{{ $template->application }}"
                            data-daily-generation-limit="{{ $template->daily_generation_limit }}"
                            data-workers="{{ $template->workers }}"
                            data-version="{{ $template->version }}"
                            data-is-trial="{{ $template->is_trial }}">
                        {{ $template->license_type }} (Price: Rp {{ number_format($template->price, 2, ',', '.') }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assign to User (Optional)</label>
            <select id="user_id" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="">-- Select a User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes</label>
            <textarea id="notes" name="notes" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"></textarea>
        </div>

        <div class="mb-4">
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="">-- Select Status --</option>
                @foreach ($statuses as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">Create License</button>
        <a href="{{ route('licenses.index') }}" class="inline-block ml-2 text-gray-500 hover:text-gray-700">Cancel</a>
    </form>
</div>
@endsection