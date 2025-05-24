@props(['car' => null, 'tgl_mulai' => null, 'tgl_selesai' => null, 'booking_id' => null])

@php
    $action = route('pay.booking', $booking_id);
    $method = 'POST';

    $durasiHari = null;
    $totalHarga = null;

    if ($tgl_mulai && $tgl_selesai) {
        $start = \Carbon\Carbon::parse($tgl_mulai);
        $end = \Carbon\Carbon::parse($tgl_selesai);
        $durasiHari = $start->diffInDays($end) + 1;
        $totalHarga = $durasiHari * $car->cost;
    }
@endphp

<div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" x-cloak>
    <div @click.outside="open = false">
        <form id="pay"
            class="rounded-xl border bg-white p-4 shadow-sm hover:shadow-md transition flex flex-col justify-start items-start w-[25rem]"
            action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)

            {{-- Preview Gambar --}}
            <div x-data="{ preview: '{{ $car->image ?? 'https://kzmqzswrwee5icmdcac3.lite.vusercontent.net/placeholder.svg' }}' }" class="w-full h-fit">
                <label class="cursor-pointer w-full h-fit relative">
                    <img :src="preview" alt="image"
                        class="h-60 w-full object-cover object-center rounded-lg mb-4">
                </label>
            </div>

            {{-- Informasi Mobil --}}
            <div class="flex flex-col justify-start items-start gap-y-4 w-full">
                <div class="flex gap-x-3 w-full">
                    <div class="w-full">
                        <p class="text-sm text-gray-700">Mobil</p>
                        <h2>{{ $car->name }}</h2>
                    </div>
                    <div class="w-full">
                        <p class="text-sm text-gray-700">Harga Per Hari</p>
                        <h2>Rp {{ number_format($car->cost, 0, ',', '.') }}</h2>
                    </div>
                </div>

                <div class="flex gap-x-3 w-full">
                    <div class="w-full">
                        <p class="text-sm text-gray-700">Transmisi</p>
                        <h2>{{ $car->transmission }}</h2>
                    </div>
                    <div class="w-full">
                        <p class="text-sm text-gray-700">Jumlah Kursi</p>
                        <h2>{{ $car->seat }}</h2>
                    </div>
                </div>

                {{-- Durasi dan Total --}}
                <div class="flex gap-x-3 w-full">
                    @if ($durasiHari)
                        <div class="w-full">
                            <p class="text-sm text-gray-700">Durasi Sewa</p>
                            <h2>{{ $durasiHari }} Hari</h2>
                        </div>

                        <div class="w-full">
                            <p class="text-sm text-gray-700">Total Harga</p>
                            <h2 class="font-semibold text-green-600">Rp {{ number_format($totalHarga, 0, ',', '.') }}
                            </h2>
                        </div>
                    @endif
                </div>

                <x-primary-button class="w-full justify-center items-center mt-4">
                    Bayar
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
