@php
    use Illuminate\Support\Str;
    use App\Models\User;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Laporan
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-4">
                <div class="overflow-auto rounded-md border">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 border-b text-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-xs">Mobil</th>
                                @if (User::find(Auth::id())?->role === 'admin')
                                    <th class="px-4 py-2 text-xs">Pembeli</th>
                                @else
                                    <th class="px-4 py-2 text-xs">Admin</th>
                                @endif
                                <th class="px-4 py-2 text-xs">Booking</th>
                                <th class="px-4 py-2 text-xs">Mulai</th>
                                <th class="px-4 py-2 text-xs">Selesai</th>
                                <th class="px-4 py-2 text-xs">Durasi</th>
                                <th class="px-4 py-2 text-xs">Total Pembayaran</th>
                                <th class="px-4 py-2 text-xs">Tanggal Pembayaran</th>
                                <th class="px-4 py-2 text-xs">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td class="px-4 py-2 text-xs">{{ $booking->car->name }}</td>
                                    @if (User::find(Auth::id())?->role === 'admin')
                                        <td class="px-4 py-2 text-xs">{{ $booking->user->name }}</td>
                                    @else
                                        <td class="px-4 py-2 text-xs">{{ $booking->admin->name }}</td>
                                    @endif
                                    <td class="px-4 py-2 text-xs">{{ $booking->tgl_booking }}</td>
                                    <td class="px-4 py-2 text-xs">{{ $booking->tgl_mulai }}</td>
                                    <td class="px-4 py-2 text-xs">{{ $booking->tgl_selesai }}</td>
                                    @php
                                        $startDate = \Carbon\Carbon::parse($booking->tgl_mulai);
                                        $endDate = \Carbon\Carbon::parse($booking->tgl_selesai);
                                        $days = $startDate->diffInDays($endDate) + 1;
                                    @endphp
                                    <td class="px-4 py-2 text-xs">{{ $days }} Hari</td>
                                    <td class="px-4 py-2 text-xs">Rp
                                        {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 text-xs">
                                        {{ $booking->tgl_bayar }}
                                    </td>
                                    <td class="px-4 py-2 text-xs">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                                            {{ $booking->status_booking === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ Str::ucfirst($booking->status_booking) }}
                                        </span>
                                        @if ($booking->tgl_selesai && \Carbon\Carbon::parse($booking->tgl_selesai)->isPast())
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-700">
                                                Berakhir
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-500">
                                        Belum ada data.
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
