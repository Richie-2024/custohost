<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Bookings</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6">Your Bookings</h1>

        @foreach ($bookings as $booking)
            <div class="p-4 mb-4 bg-white shadow rounded">
                <p><strong>Room:</strong> {{ $booking->room->room_number }}</p>
                <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>
