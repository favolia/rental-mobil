<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mobil') }}
            </h2>


            <div x-data="{ open: false }">
                <x-primary-button @click="open = true">Tambah Mobil</x-primary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-x-4">
                        @foreach ($cars as $car)
                            <div x-data="{ open: false }">

                                <div
                                    class="rounded-xl border bg-white p-4 shadow-sm hover:shadow-md transition relative">
                                    <img src="{{ $car->image }}" alt="{{ $car->name }}"
                                        class="h-60 md:h-[28rem] lg:h-40 w-full object-cover object-center rounded-lg mb-4">

                                    <div class="space-y-1">
                                        <h2 class="text-lg font-semibold text-gray-800">{{ $car->name }}</h2>
                                        <p class="text-sm text-gray-600">Transmisi:
                                            {{ ucwords(str_replace('_', ' ', $car->transmission)) }}</p>
                                        <p class="text-sm text-gray-600">Kursi: {{ $car->seat }}</p>
                                        <p class="text-sm text-gray-600">Harga: Rp
                                            {{ number_format($car->cost, 0, ',', '.') }}</p>
                                        <div class="text-sm text-gray-600 flex justify-start items-center gap-1">Status:
                                            <div class="relative">
                                                <span
                                                    class="{{ $car->status == '1' ? 'bg-green-600' : 'bg-red-600' }} size-3 rounded-full block absolute"></span>
                                                <span
                                                    class="{{ $car->status == '1' ? 'bg-green-600' : 'bg-red-600' }} size-3 rounded-full animate-ping block"></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="absolute scale-[.8] origin-top-right top-0 right-0">
                                        <x-primary-button type="submit">
                                            Rental
                                        </x-primary-button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div></div>

    <x-slot name="script">
        <script>
            // document.querySelectorAll('form[id^="carForm-"]').forEach(form => {
            //     form.addEventListener('submit', async function(e) {
            //         e.preventDefault();

            //         const formData = new FormData(form);
            //         const csrf = form.querySelector('input[name="_token"]').value;
            //         const methodInput = form.querySelector('input[name="_method"]');
            //         const method = methodInput ? methodInput.value : 'POST';

            //         try {
            //             const res = await fetch(form.action, {
            //                 method: method,
            //                 headers: {
            //                     'X-CSRF-TOKEN': csrf
            //                 },
            //                 body: formData
            //             });

            //             const data = await res.json();

            //             if (data.status === 'success') {
            //                 window.location.reload();
            //             } else {
            //                 alert(data.message || 'Gagal menyimpan data.');
            //             }
            //         } catch (error) {
            //             console.error(error);
            //             alert('Terjadi kesalahan saat mengirim data.');
            //         }
            //     });
            // });
        </script>
    </x-slot>
</x-app-layout>
