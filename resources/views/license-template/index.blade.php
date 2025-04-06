@extends('layouts.app')
@section('title', 'License Templates')

@section('content')
<div class="">
    <div class="mb-6 flex justify-between items-center">
        <button data-modal-target="createLicenseTemplateModal" data-modal-toggle="createLicenseTemplateModal"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
            Create New Template
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
                        License Type
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Max Devices
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Application
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Daily Generation Limit
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Workers
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Version
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Is Trial
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Active Days
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Price
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
            @foreach ($licenseTemplates as $template)
                <tr data-template-id="{{ $template->id }}"
                    data-license-type="{{ $template->license_type }}"
                    data-max-devices="{{ $template->max_devices }}"
                    data-application="{{ $template->application }}"
                    data-daily-generation-limit="{{ $template->daily_generation_limit }}"
                    data-workers="{{ $template->workers }}"
                    data-version="{{ $template->version }}"
                    data-is-trial="{{ $template->is_trial }}"
                    data-active-days="{{ $template->active_days }}"
                    data-price="{{ $template->price }}">
                    <td class="px-6 py-4">{{ $template->license_type }}</td>
                    <td class="px-6 py-4">{{ $template->max_devices }}</td>
                    <td class="px-6 py-4">{{ $template->application }}</td>
                    <td class="px-6 py-4">{{ $template->daily_generation_limit }}</td>
                    <td class="px-6 py-4">{{ $template->workers }}</td>
                    <td class="px-6 py-4">{{ $template->version }}</td>
                    <td class="px-6 py-4">{{ $template->is_trial ? 'Yes' : 'No' }}</td>
                    <td class="px-6 py-4">{{ $template->active_days }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($template->price, 2, ',', '.') }}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <button data-modal-target="editLicenseTemplateModal" data-modal-toggle="editLicenseTemplateModal" data-template-id="{{ $template->id }}" class="font-medium text-blue-600 hover:underline edit-template-btn">
                            Edit
                        </button>
                        <button data-modal-target="deleteLicenseTemplateModal" data-modal-toggle="deleteLicenseTemplateModal" data-template-id="{{ $template->id }}" class="font-medium text-red-600 hover:underline delete-template-btn">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="createLicenseTemplateModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Create New License Template</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="createLicenseTemplateModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form id="createLicenseTemplateForm" action="{{ route('license-templates.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="license_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">License Type</label>
                        <input type="text" name="license_type" id="create_license_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="max_devices" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max Devices</label>
                        <input type="number" name="max_devices" id="create_max_devices" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="1">
                    </div>
                    <div class="mb-4">
                        <label for="application" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Application</label>
                        <input type="text" name="application" id="create_application" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <label for="daily_generation_limit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Daily Generation Limit</label>
                        <input type="number" name="daily_generation_limit" id="create_daily_generation_limit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="1000">
                    </div>
                    <div class="mb-4">
                        <label for="workers" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Workers</label>
                        <input type="number" name="workers" id="create_workers" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="1">
                    </div>
                    <div class="mb-4">
                        <label for="version" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Version</label>
                        <input type="text" name="version" id="create_version" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input id="create_is_trial" type="checkbox" name="is_trial" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="create_is_trial" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is Trial</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="active_days" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Active Days</label>
                        <input type="number" name="active_days" id="create_active_days" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="30">
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price (Rp)</label>
                        <input type="number" name="price" id="create_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="0.00" step="0.01">
                    </div>
                    <div class="flex items-center justify-end pt-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" class="py-2.5 px-5 mr-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="createLicenseTemplateModal">Cancel</button>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Template</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editLicenseTemplateModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Edit License Template</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="editLicenseTemplateModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form id="editLicenseTemplateForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="template_id" id="edit_template_id">
                    <div class="mb-4">
                        <label for="license_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">License Type</label>
                        <input type="text" name="license_type" id="edit_license_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="max_devices" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max Devices</label>
                        <input type="number" name="max_devices" id="edit_max_devices" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="1">
                    </div>
                    <div class="mb-4">
                        <label for="application" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Application</label>
                        <input type="text" name="application" id="edit_application" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <label for="daily_generation_limit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Daily Generation Limit</label>
                        <input type="number" name="daily_generation_limit" id="edit_daily_generation_limit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="1000">
                    </div>
                    <div class="mb-4">
                        <label for="workers" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Workers</label>
                        <input type="number" name="workers" id="edit_workers" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="1">
                    </div>
                    <div class="mb-4">
                        <label for="version" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Version</label>
                        <input type="text" name="version" id="edit_version" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input id="edit_is_trial" type="checkbox" name="is_trial" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="edit_is_trial" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is Trial</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="active_days" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Active Days</label>
                        <input type="number" name="active_days" id="edit_active_days" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="30">
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price (Rp)</label>
                        <input type="number" name="price" id="edit_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="0.00" step="0.01">
                    </div>
                    <div class="flex items-center justify-end pt-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" class="py-2.5 px-5 mr-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="editLicenseTemplateModal">Cancel</button>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Template</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="deleteLicenseTemplateModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteLicenseTemplateModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this license template?</h3>
                <form id="deleteLicenseTemplateForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="template_id" id="delete_template_id">
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="deleteLicenseTemplateModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section(section: 'scripts')
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

        // Create License Template Form Submit
        $("#createLicenseTemplateForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $("#createLicenseTemplateModal").hide();
                    window.location.reload();
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    alert('Please check the form for errors');
                    console.log(errors);
                }
            });
        });

        // Edit License Template - Populate Form
        $(".edit-template-btn").click(function() {
            const templateId = $(this).data('template-id');
            const templateRow = $(this).closest('tr');
            const licenseType = templateRow.data('license-type');
            const maxDevices = templateRow.data('max-devices');
            const application = templateRow.data('application');
            const dailyGenerationLimit = templateRow.data('daily-generation-limit');
            const workers = templateRow.data('workers');
            const version = templateRow.data('version');
            const isTrial = templateRow.data('is-trial');
            const activeDays = templateRow.data('active-days');
            const price = templateRow.data('price');

            $("#editLicenseTemplateForm").attr('action', `/license-templates/${templateId}`);
            $("#edit_template_id").val(templateId);
            $("#edit_license_type").val(licenseType);
            $("#edit_max_devices").val(maxDevices);
            $("#edit_application").val(application);
            $("#edit_daily_generation_limit").val(dailyGenerationLimit);
            $("#edit_workers").val(workers);
            $("#edit_version").val(version);
            $("#edit_is_trial").prop('checked', isTrial);
            $("#edit_active_days").val(activeDays);
            $("#edit_price").val(price);
        });

        // Edit License Template Form Submit
        $("#editLicenseTemplateForm").submit(function(e) {
            e.preventDefault();
            const templateId = $("#edit_template_id").val();
            $.ajax({
                url: `/license-templates/${templateId}`,
                method: 'POST',
                data: $(this).serialize() + '&_method=PUT', // Add _method=PUT for Laravel
                success: function(response) {
                    $("#editLicenseTemplateModal").hide();
                    window.location.reload();
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    alert('Please check the form for errors');
                    console.log(errors);
                }
            });
        });

        // Delete License Template - Set Form Action
        $(".delete-template-btn").click(function() {
            const templateId = $(this).data('template-id');
            $("#deleteLicenseTemplateForm").attr('action', `/license-templates/${templateId}`);
            $("#delete_template_id").val(templateId);
        });

        // Delete License Template Form Submit
        $("#deleteLicenseTemplateForm").submit(function(e) {
            e.preventDefault();
            const templateId = $("#delete_template_id").val();
            $.ajax({
                url: `/license-templates/${templateId}`,
                method: 'POST',
                data: $(this).serialize() + '&_method=DELETE', // Add _method=DELETE for Laravel
                success: function(response) {
                    $("#deleteLicenseTemplateModal").hide();
                    window.location.reload();
                },
                error: function() {
                    alert('Failed to delete license template');
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