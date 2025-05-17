<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index($id) {
        $car = Car::findOrFail($id);
        return view('rent-view', compact('car'));
    }

    public function storeBooking(Request $request, $id) {
        $car = Car::findOrFail($id);

        if ($car->status == 1) {
            $bookingInfo = Booking::create([
                'tgl_booking' => Carbon::now()->toDateString(),
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'status_booking' => 'pending',
                'user_id' => Auth::id(),
                'admin_id' => $car->admin_id,
                'car_id' => $car->id,
                'total_pembayaran' => $car->cost
            ]);

            $car->update([
                'status' => 0
            ]);
        } else {
            return redirect()->route('car.user')->with('error', 'Mobil ini tidak tersedia untuk di booking!');
        }

        return redirect()->route('booking.list');
    }

    public function viewBooking() {
        $userId = Auth::id();
        $bookings = Booking::with(['car', 'admin'])
            ->where('user_id', $userId)
            ->latest()
            ->get();
        return view('booking-list', compact('bookings'));
    }
}
