@extends('layouts.app')
@section('title', 'Tokens')

@section('content')
<div class="">
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

    <table id="pagination-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Owner</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Access Token</th>
                <th scope="col" class="px-6 py-3">Last Update</th>
                <th scope="col" class="px-6 py-3">Visibility</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Generated</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tokens as $token)
                <tr data-token-id="{{ $token->id }}" data-token-user-id="{{ $token->user_id }}" data-token-email="{{ $token->email }}"
                    data-token-access-token="{{ $token->access_token }}" data-token-expires="{{ $token->expires }}"
                    data-token-visibility="{{ $token->visibility }}" data-token-status="{{ $token->status }}">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $token->id }}
                    </th>
                    <td class="px-6 py-4">{{ $token->user->name ?? 'N/A' }} ({{ $token->user->email ?? 'N/A' }})</td>
                    <td class="px-6 py-4">{{ $token->email }}</td>
                    <td class="px-6 py-4 token-access-token">{{ substr($token->access_token, 0, 50) }}...</td>
                    <td class="px-6 py-4">{{ $token->updated_at->diffForHumans() }}</td>
                    <td class="px-6 py-4 token-visibility">
                        @if ($token->visibility == 1)
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Public</span>
                        @else
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">Private</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 token-status">
                        @if ($token->status == 0)
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Dead</span>
                        @else
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">Active</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $totalGenerations[$token->email] ?? 0 }}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <button data-modal-target="editTokenModal" data-modal-toggle="editTokenModal" data-token-id="{{ $token->id }}" class="font-medium text-blue-600 hover:underline edit-token-btn">
                            Edit
                        </button>
                        <button data-modal-target="deleteTokenModal" data-modal-toggle="deleteTokenModal" data-token-id="{{ $token->id }}" class="font-medium text-red-600 hover:underline delete-token-btn">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr><td class="px-6 py-4" colspan="8">No tokens found.</td></tr>
            @endforelse
        </tbody>
    </table>

</div>

<div id="editTokenModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Edit Token Status & Visibility</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="editTokenModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form id="editTokenForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="token_id" id="edit_token_id">
                    <div class="mb-4">
                        <label for="edit_visibility" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Visibility</label>
                        <select name="visibility" id="edit_visibility" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <option value="0">Private</option>
                            <option value="1">Public</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="edit_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="edit_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <option value="0">Dead</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-end pt-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" class="py-2.5 px-5 mr-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="editTokenModal">Cancel</button>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Token</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="deleteTokenModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteTokenModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this token?</h3>
                <form id="deleteTokenForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="token_id" id="delete_token_id">
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="deleteTokenModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
            </div>
        </div>
    </div>
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

        // Edit Token - Populate Form
        $(".edit-token-btn").click(function() {
            const tokenId = $(this).data('token-id');
            const tokenRow = $(this).closest('tr');
            $("#edit_token_id").val(tokenId);
            $("#edit_visibility").val(tokenRow.data('token-visibility'));
            $("#edit_status").val(tokenRow.data('token-status'));
            $("#editTokenForm").attr('action', `/tokens/${tokenId}`);
        });

        // Edit Token Form Submit
        $("#editTokenForm").submit(function(e) {
            e.preventDefault();
            const tokenId = $("#edit_token_id").val();
            $.ajax({
                url: `/tokens/${tokenId}`,
                method: 'POST',
                data: $(this).serialize() + '&_method=PUT',
                success: function(response) {
                    $("#editTokenModal").hide();
                    window.location.reload(); // For simplicity, reload the page
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                    alert('Please check the form for errors');
                    console.log(errors);
                }
            });
        });

        // Delete Token - Set Form Action
        $(".delete-token-btn").click(function() {
            const tokenId = $(this).data('token-id');
            $("#delete_token_id").val(tokenId);
            $("#deleteTokenForm").attr('action', `/tokens/${tokenId}`);
        });

        // Delete Token Form Submit
        $("#deleteTokenForm").submit(function(e) {
            e.preventDefault();
            const tokenId = $("#delete_token_id").val();
            $.ajax({
                url: `/tokens/${tokenId}`,
                method: 'POST',
                data: $(this).serialize() + '&_method=DELETE',
                success: function(response) {
                    $("#deleteTokenModal").hide();
                    window.location.reload(); // For simplicity, reload the page
                },
                error: function() {
                    alert('Failed to delete token');
                }
            });
        });

        // Dismiss alerts after 5 seconds
        setTimeout(function() {
            $("#alert-success").fadeOut('slow');
        }, 5000);
    });
</script>
@endsection