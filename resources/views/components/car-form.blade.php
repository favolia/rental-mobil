@props(['car' => null])

@php
    $formId = 'carForm-' . ($car->id ?? 'new');
    $action = $car ? route('cars.update', $car->id) : route('cars.store');
    $method = 'POST';
@endphp

<div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div @click.outside="open = false">
        <form id="{{ $formId }}"
            class="rounded-xl border bg-white p-4 shadow-sm hover:shadow-md transition flex flex-col justify-start items-start w-[25rem]"
            action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($car)
                @method('POST')
            @endif

            {{-- Gambar & Preview --}}
            <div x-data="{ preview: '{{ $car?->image ?? 'https://kzmqzswrwee5icmdcac3.lite.vusercontent.net/placeholder.svg' }}' }" class="w-full h-fit">
                <input type="file" name="image" id="{{ $formId }}-image" accept="image/*" class="hidden"
                    @change="preview = URL.createObjectURL($event.target.files[0])">

                <label for="{{ $formId }}-image" class="cursor-pointer w-full h-fit relative">
                    <img :src="preview" alt="image"
                        class="h-60 w-full object-cover object-center rounded-lg mb-4">
                    <div class="absolute bottom-0 right-0 pointer-events-none">
                        <x-secondary-button type="button" class="scale-[.8] origin-bottom-right">
                            Edit
                        </x-secondary-button>
                    </div>
                </label>
            </div>

            {{-- Form Fields --}}
            <div class="flex flex-col justify-start items-start gap-y-4 w-full">
                <div class="flex gap-x-3 w-full">
                    <div class="w-full">
                        <x-input-label for="{{ $formId }}-name" value="Nama" />
                        <x-text-input id="{{ $formId }}-name" name="name" type="text" class="mt-1 w-full"
                            placeholder="Nama mobil" value="{{ $car->name ?? '' }}" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="{{ $formId }}-cost" value="Tarif (Rp)" />
                        <x-text-input id="{{ $formId }}-cost" name="cost" type="number" class="mt-1 w-full"
                            placeholder="Tarif mobil" value="{{ $car->cost ?? '' }}" />
                    </div>
                </div>

                <div class="flex gap-x-3 w-full">
                    <div class="w-full">
                        <x-input-label for="{{ $formId }}-transmission" value="Transmisi" />
                        <select id="{{ $formId }}-transmission" name="transmission" class="rounded-md w-full">
                            @foreach (['manual' => 'Manual', 'semi_otomatis' => 'Semi Otomatis', 'otomatis' => 'Otomatis'] as $key => $label)
                                <option value="{{ $key }}"
                                    {{ ($car->transmission ?? '') === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full">
                        <x-input-label for="{{ $formId }}-seat" value="Kursi" />
                        <select id="{{ $formId }}-seat" name="seat" class="rounded-md w-full">
                            @for ($i = 2; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ ($car->seat ?? '') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                {{-- Checkbox Status --}}
                <div class="flex items-center space-x-2">
                    <input id="{{ $formId }}-status" name="status" type="checkbox" value="1"
                        {{ isset($car) && $car->status ? 'checked' : '' }}
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                    <label for="{{ $formId }}-status" class="text-sm text-gray-700">Aktif</label>
                </div>

                <x-primary-button class="w-full justify-center items-center">
                    {{ $car ? 'Update' : 'Submit' }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
