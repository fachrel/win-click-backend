@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800 dark:border-gray-700">
        <div id="total-tokens" class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{$totalImageFxRequestToday}}</div>
        <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Total ImageFx Request Today</h6>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800 dark:border-gray-700">
        <div class="text-3xl font-bold text-blue-500 dark:text-blue-400 mb-2">{{$totalImageGeneratedToday}}</div>
        <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Total Images Generated Today</h6>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800 dark:border-gray-700">
        <div class="text-3xl font-bold text-green-500 dark:text-green-400 mb-2">$1B+</div>
        <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Average Deal Size</h6>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800 dark:border-gray-700">
        <div class="text-3xl font-bold text-purple-500 dark:text-purple-400 mb-2">100+</div>
        <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Unicorn Acquisitions</h6>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function fetchTotalImageFxRequestToday() {
        fetch('{{ route('dashboard.total-imageFx-request-today') }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-tokens').textContent = data.totalImageFxRequestToday;
            })
            .catch(error => {
                console.error('Error fetching total tokens:', error);
            });
    }

    // Fetch total tokens initially
    fetchTotalImageFxRequestToday();

    // Fetch total tokens every 5 seconds (5000 milliseconds)
    setInterval(fetchTotalImageFxRequestToday, 5000);
</script>
@endsection