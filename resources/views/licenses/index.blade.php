@extends('layouts.app')
@section('title', 'Licenses')

@section('content')
<div class="">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('licenses.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
            Create New License
        </a>
    </div>

    @if(session('success'))
    <div id="alert-success" class="p-4 mb-4 text-green-800 border-green-300 rounded-lg bg-green-50" role="alert">
        <div class="flex items-center">
            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Success</span>
            <div>{{ session('success') }}</div>
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    @endif

    <table id="pagination-table">
        <thead>
            <tr>
                <th>License Type</th>
                <th>License Key</th>
                <th>User</th>
                <th>Max Devices</th>
                <th>Valid Until</th>
                <th>Application</th>
                <th>Status</th>
                <th>Active Days</th> <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($licenses as $license)
            <tr>
                <td>{{ $license->license_type }}</td>
                <td>{{ $license->license_key }}</td>
                <td>{{ $license->user ? $license->user->name : 'N/A' }}</td>
                <td>{{ $license->max_devices }}</td>
                <td>{{ $license->valid_until ? $license->valid_until->format('Y-m-d H:i:s') : 'N/A' }}</td>
                <td>{{ $license->application }}</td>
                <td>
                    @switch($license->status)
                        @case(0) <span class="bg-green-100 text-green-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span> @break
                        @case(1) <span class="bg-gray-100 text-gray-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Inactive</span> @break
                        @case(2) <span class="bg-red-100 text-red-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Expired</span> @break
                        @case(3) <span class="bg-orange-100 text-orange-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">Revoked</span> @break
                        @case(4) <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending</span> @break
                        @default <span class="bg-gray-100 text-gray-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Unknown</span>
                    @endswitch
                </td>
                <td>{{ $license->active_days }}</td> <td class="flex space-x-2">
                    <a href="{{ route('licenses.show', $license->id) }}" class="font-medium text-blue-600 hover:underline">View</a>
                    <a href="{{ route('licenses.edit', $license->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('licenses.destroy', $license->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this license?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        if (document.getElementById("pagination-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#pagination-table", {
                paging: true,
                perPage: 5,
                perPageSelect: [5, 10, 15, 20, 25],
                sortable: false
            });
        }

        // Dismiss alerts after 5 seconds
        setTimeout(function() {
            $("#alert-success").fadeOut('slow');
        }, 5000);
    });
</script>
@endsection