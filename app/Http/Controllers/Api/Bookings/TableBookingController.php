<?php

namespace App\Http\Controllers\Api\Bookings;

use App\Http\Controllers\Controller;
use App\Models\Bookings\TableBooking;
use App\Notifications\Bookings\BookingStatusUpdated;
use Illuminate\Http\Request;

class TableBookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'guests' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $booking = TableBooking::create([
            'user_id' => $request->user()->id,
            'date'    => $request->date,
            'time'    => $request->time,
            'guests'  => $request->guests,
            'notes'   => $request->notes,
            'status'  => 'pending',
        ]);

        return response()->json($booking, 201);
    }

    public function myBookings(Request $request)
    {
        return response()->json(
            $request->user()->tableBookings()->get()
        );
    }


    public function index()
    {

        return response()->json(TableBooking::all());
    }

    public function updateStatus(Request $request, TableBooking $tableBooking)
    {

        $request->validate([
            'status' => 'required|in:pending,confirmed,rejected'
        ]);

        $tableBooking->update(['status' => $request->status]);

        try {
            if ($tableBooking->user) {
                $tableBooking->user->notify(new BookingStatusUpdated($tableBooking));
            }
        } catch (\Throwable) {
        }

        return response()->json($tableBooking, 200);
    }
}
