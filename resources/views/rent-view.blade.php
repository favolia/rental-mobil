<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $car->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col w-full items-center justify-between bg-white pb-16">
                <div class="w-full space-y-10">
                    <div class="">
                        <img draggable="false" src="{{ url($car->image) }}" alt="{{ $car->name }}"
                            class="w-full object-cover">
                    </div>

                    <div class="flex flex-col justify-center items-center gap-y-2">
                        <p class="text-4xl font-bold">Rp
                            {{ number_format($car->cost, 0, ',', '.') }}/Hari</p>
                        <p class="text-2xl text-gray-600">Transmisi:
                            {{ ucwords(str_replace('_', ' ', $car->transmission)) }}</p>
                        <p class="text-xl text-gray-600">
                            Kursi: {{ $car->seat }}
                        </p>
                    </div>

                </div>

                <div class="max-w-4xl mx-auto mt-16">
                    <form action="{{ route('rent.store', $car->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="w-full">
                                <label for="tgl_mulai" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Mulai:
                                </label>
                                <div class="flex items-center border rounded-lg px-3 py-2">
                                    <span class="mr-2 text-gray-500">📅</span>
                                    <input type="date" id="tgl_mulai" name="tgl_mulai"
                                        class="w-full outline-none border-0 focus:ring-0" required>
                                </div>
                            </div>

                            <div class="w-full">
                                <label for="tgl_selesai" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Selesai:
                                </label>
                                <div class="flex items-center border rounded-lg px-3 py-2">
                                    <span class="mr-2 text-gray-500">📅</span>
                                    <input type="date" id="tgl_selesai" name="tgl_selesai"
                                        class="w-full outline-none border-0 focus:ring-0" required>
                                </div>
                            </div>
                        </div>

                        <div id="summary" class="mt-4 text-center space-y-2 hidden">
                            <p class="text-lg font-semibold">Durasi: <span id="total-days">0</span> hari</p>
                            <p class="text-xl font-bold text-green-600">Total Biaya: Rp <span id="total-cost">0</span>
                            </p>
                        </div>

                        <div>
                            <x-primary-button type="submit" class="w-full items-center justify-center !text-lg">
                                Rental Sekarang
                            </x-primary-button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            const car = @json($car);
            if (car.status != 1) {
                alert("Mobil ini tidak tersedia untuk dibooking!");
                window.history.back();
            };

            const tglMulaiInput = document.getElementById("tgl_mulai");
            const tglSelesaiInput = document.getElementById("tgl_selesai");
            const summaryDiv = document.getElementById("summary");
            const totalDaysSpan = document.getElementById("total-days");
            const totalCostSpan = document.getElementById("total-cost");

            function updateSummary() {
                const startDate = new Date(tglMulaiInput.value);
                const endDate = new Date(tglSelesaiInput.value);

                if (tglMulaiInput.value && tglSelesaiInput.value && endDate >= startDate) {
                    const timeDiff = endDate.getTime() - startDate.getTime();
                    const dayCount = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;

                    const totalCost = dayCount * car.cost;

                    summaryDiv.classList.remove("hidden");
                    totalDaysSpan.textContent = dayCount;
                    totalCostSpan.textContent = totalCost.toLocaleString('id-ID');
                } else {
                    summaryDiv.classList.add("hidden");
                }
            }

            tglMulaiInput.addEventListener("change", updateSummary);
            tglSelesaiInput.addEventListener("change", updateSummary);
        </script>
    </x-slot>

</x-app-layout>
