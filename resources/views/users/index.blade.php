@extends('layouts.app')
@section('title', 'Users')

{{-- @section('styles')
@endsection --}}

@section('content')
<div class="">
    <div class="mb-6 flex justify-between items-center">
        <button data-modal-target="createUserModal" data-modal-toggle="createUserModal" 
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
            Create New User
        </button>
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
                <th>
                    <span class="flex items-center">
                        Email
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Name
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Actions
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}">
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <button data-modal-target="viewUserModal" data-modal-toggle="viewUserModal" data-user-id="{{ $user->id }}" class="font-medium text-blue-600 hover:underline view-user-btn">
                            View
                        </button>
                        <button data-modal-target="editUserModal" data-modal-toggle="editUserModal" data-user-id="{{ $user->id }}" class="font-medium text-blue-600 hover:underline edit-user-btn">
                            Edit
                        </button>
                        <button data-modal-target="deleteUserModal" data-modal-toggle="deleteUserModal" data-user-id="{{ $user->id }}" class="font-medium text-red-600 hover:underline delete-user-btn">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Create User Modal -->
<div id="createUserModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Create New User</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="createUserModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form id="createUserForm" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="create_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="create_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="create_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="create_password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end pt-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" class="py-2.5 px-5 mr-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="createUserModal">Cancel</button>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Edit User</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="editUserModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="edit_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="edit_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password (leave blank to keep current)</label>
                        <input type="password" name="password" id="edit_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="edit_password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end pt-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" class="py-2.5 px-5 mr-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="editUserModal">Cancel</button>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View User Modal -->
<div id="viewUserModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-medium text-gray-900">User Details</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="viewUserModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-500">Name</h4>
                    <p id="view_name" class="text-base text-gray-900 mt-1"></p>
                </div>
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-500">Email</h4>
                    <p id="view_email" class="text-base text-gray-900 mt-1"></p>
                </div>
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-500">Created At</h4>
                    <p id="view_created_at" class="text-base text-gray-900 mt-1"></p>
                </div>
            </div>
            <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b">
                <button type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100" data-modal-hide="viewUserModal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="deleteUserModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteUserModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                <form id="deleteUserForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="deleteUserModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
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
        // Create User Form Submit
        $("#createUserForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Hide modal
                    $("#createUserModal").hide();
                    // Reload page with success message
                    window.location.reload();
                },
                error: function(xhr) {
                    // Handle validation errors
                    const errors = xhr.responseJSON.errors;
                    // You can display errors here
                    alert('Please check the form for errors');
                    console.log(errors);
                }
            });
        });

        // Edit User - Populate Form
        $(".edit-user-btn").click(function() {
            const userId = $(this).data('user-id');
            const userRow = $(this).closest('tr');
            const userName = userRow.data('user-name');
            const userEmail = userRow.data('user-email');
            
            // Set form action URL
            $("#editUserForm").attr('action', `/users/${userId}`);
            
            // Set form values
            $("#edit_name").val(userName);
            $("#edit_email").val(userEmail);
            
            // Clear password fields
            $("#edit_password").val('');
            $("#edit_password_confirmation").val('');
        });

        // Edit User Form Submit
        $("#editUserForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Hide modal
                    $("#editUserModal").hide();
                    // Reload page with success message
                    window.location.reload();
                },
                error: function(xhr) {
                    // Handle validation errors
                    const errors = xhr.responseJSON.errors;
                    // You can display errors here
                    alert('Please check the form for errors');
                    console.log(errors);
                }
            });
        });

        // View User Details
        $(".view-user-btn, .user-row").click(function() {
            // Only trigger on row click if it's not within the actions column
            if ($(this).hasClass('user-row') && $(event.target).closest('td:last-child').length) {
                return;
            }
            
            const userId = $(this).data('user-id') || $(this).closest('tr').data('user-id');
            const userRow = $(this).closest('tr');
            const userName = userRow.data('user-name');
            const userEmail = userRow.data('user-email');
            
            // Fetch additional user details from server
            $.ajax({
                url: `/users/${userId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Fill the modal with user details
                    $("#view_name").text(userName);
                    $("#view_email").text(userEmail);
                    $("#view_created_at").text(response.created_at);
                    
                    // Show the modal
                    const viewUserModal = document.getElementById('viewUserModal');
                    const modal = new Flowbite.Modal(viewUserModal);
                    modal.show();
                },
                error: function() {
                    alert('Failed to load user details');
                }
            });
        });

        // Delete User - Set Form Action
        $(".delete-user-btn").click(function() {
            const userId = $(this).data('user-id');
            $("#deleteUserForm").attr('action', `/users/${userId}`);
        });

        // Delete User Form Submit
        $("#deleteUserForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Hide modal
                    $("#deleteUserModal").hide();
                    // Reload page with success message
                    window.location.reload();
                },
                error: function() {
                    alert('Failed to delete user');
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