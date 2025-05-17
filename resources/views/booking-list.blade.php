@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Booking
            </h2>

            <div>
                <x-primary-button @click="open = true">Lihat laporan</x-primary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-4">
                <div class="overflow-auto rounded-md border">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 border-b text-gray-700">
                            <tr>
                                <th class="px-4 py-2">Mobil</th>
                                <th class="px-4 py-2">Admin</th>
                                <th class="px-4 py-2">Tgl Booking</th>
                                <th class="px-4 py-2">Tgl Mulai</th>
                                <th class="px-4 py-2">Tgl Selesai</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Total Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td class="px-4 py-2">{{ $booking->car->name }}</td>
                                    <td class="px-4 py-2">{{ $booking->admin->name }}</td>
                                    <td class="px-4 py-2">{{ $booking->tgl_booking }}</td>
                                    <td class="px-4 py-2">{{ $booking->tgl_mulai }}</td>
                                    <td class="px-4 py-2">{{ $booking->tgl_selesai }}</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                                        {{ $booking->status_booking === 'selesai'
                                            ? 'bg-green-100 text-green-700'
                                            : ($booking->status_booking === 'batal'
                                                ? 'bg-red-100 text-red-700'
                                                : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ Str::ucfirst($booking->status_booking) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">Rp
                                        {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data booking.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
