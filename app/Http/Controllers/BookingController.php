<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;

class BookingController extends Controller
{
    public function index($id)
    {
        $car = Car::findOrFail($id);
        return view('rent-view', compact('car'));
    }

    public function storeBookingApi(Request $request) {
        $car = Car::find($request->car_id);

        if (!$car) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Car not found.'
            ], 404);
        }

        $validated = $request->validate([
            'tgl_mulai' => 'required|date|after_or_equal:today',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        if ($car->status != 1) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Car is not available for booking.'
            ], 400);
        }

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'message' => "This user doesn't exist!"
            ]);
        }

        $startDate = Carbon::parse($validated['tgl_mulai']);
        $endDate = Carbon::parse($validated['tgl_selesai']);
        $days = $startDate->diffInDays($endDate) + 1;
        $total = $days * $car->cost;

        $bookingInfo = Booking::create([
            'tgl_booking' => Carbon::now()->toDateString(),
            'tgl_mulai' => $validated['tgl_mulai'],
            'tgl_selesai' => $validated['tgl_selesai'],
            'status_booking' => 'pending',
            'user_id' => $request->user_id,
            'admin_id' => $request->admin_id,
            'car_id' => $request->car_id,
            'total_pembayaran' => $total,
        ]);

        $car->update([
            'status' => 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Booking successfully created.',
            'data' => $bookingInfo
        ]);
    }

    public function storeBooking(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'tgl_mulai' => 'required|date|after_or_equal:today',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        if ($car->status == 1) {
            $startDate = Carbon::parse($request->tgl_mulai);
            $endDate = Carbon::parse($request->tgl_selesai);
            $days = $startDate->diffInDays($endDate) + 1;

            $total = $days * $car->cost;

            $bookingInfo = Booking::create([
                'tgl_booking' => Carbon::now()->toDateString(),
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'status_booking' => 'pending',
                'user_id' => Auth::id(),
                'admin_id' => $car->admin_id,
                'car_id' => $car->id,
                'total_pembayaran' => $total,
            ]);

            $car->update([
                'status' => 0,
            ]);

            return redirect()->route('booking.list')->with('success', 'Booking berhasil dibuat.');
        } else {
            return redirect()->route('car.user')->with('error', 'Mobil ini tidak tersedia untuk di booking!');
        }
    }

    public function viewBooking()
    {
        $user = User::find(Auth::id());
        if ($user->role == 'admin') {
            $bookings = Booking::with(['car', 'user', 'admin'])->where('status_booking', 'pending')->latest()->get();
            return view('booking-list', compact('bookings'));
        } else {
            $bookings = Booking::with(['car', 'user', 'admin'])
                ->where('user_id', $user->id)
                ->where('status_booking', 'pending')
                ->latest()
                ->get();
            return view('booking-list', compact('bookings'));
        }
    }

    public function listBookingApi(Request $request, $id = null) {
        $status = $request->query('status'); // Read status from query string

        $query = Booking::with(['car', 'user', 'admin'])->latest();

        if ($id !== null) {
            $query->where('user_id', $id);
        }

        if ($status !== null) {
            $query->where('status_booking', $status);
        }

        $bookings = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $bookings
        ]);
    }

    public function deleteBooking($id) {
        $booking = Booking::findOrFail($id);

        $booking->delete();

        return redirect()->back();
    }

    public function deleteBookingApi(Request $request) {
        $booking = Booking::find($request->id);

        if (!$booking) {
            return response()->json(['status' => 'failed', 'message' => 'Booking not found!'], 404);
        }
        $booking->delete();
        return response()->json(['status' => 'success', 'message' => 'Booking successfully deleted!']);
    }

    public function viewReport() {
        $user = User::find(Auth::id());
        if ($user->role == 'admin') {
            $bookings = Booking::with(['car', 'user', 'admin'])->where('status_booking', 'paid')->latest()->get();
            return view('report-view', compact('bookings'));
        }
        $bookings = Booking::with(['car', 'user', 'admin'])->where('user_id', $user->id)->where('status_booking', 'paid')->latest()->get();

        return view('report-view', compact('bookings'));
    }

    public function payBookingApi(Request $request) {
        $bookingId = $request->id;
        $booking = Booking::find($bookingId);

        if ($booking->status_booking == 'paid') {
            return response()->json([
                'status' => 'failed',
                'message' => 'This booking is already paid!'
            ], 406);
        }

        if (!$booking) {
            return response()->json([
                'status' => 'failed',
                'message' => 'The specified booking is not found!'
            ], 404);
        }

        $booking->update([
            'tgl_bayar' => Carbon::now()->toDateString(),
            'status_booking' => 'paid'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Booking paid successfully!'
        ]);
    }

    public function payBooking($id) {
        $bookingId = $id;
        $booking = Booking::find($bookingId);

        if ($booking->status_booking == 'paid') {
            return response()->json([
                'status' => 'failed',
                'message' => 'This booking is already paid!'
            ], 406);
        }

        if (!$booking) {
            return response()->json([
                'status' => 'failed',
                'message' => 'The specified booking is not found!'
            ], 404);
        }

        $booking->update([
            'tgl_bayar' => Carbon::now()->toDateString(),
            'status_booking' => 'paid'
        ]);

        return redirect()->route('report');
    }
}
