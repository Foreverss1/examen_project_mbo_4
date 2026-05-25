<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reservering bewerken
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">

                <form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="p-8 space-y-6">

                        {{-- Aantal personen --}}
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                Aantal personen
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-label for="num_adults" value="Volwassenen" />
                                    <x-input
                                        id="num_adults"
                                        name="num_adults"
                                        type="number"
                                        min="1"
                                        max="64"
                                        class="mt-1 block w-full"
                                        required
                                        value="{{ old('num_adults', $reservation->num_adults) }}"
                                    />

                                    @error('num_adults')
                                        <p class="text-red-500 text-sm mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <x-label for="num_kids" value="Kinderen" />
                                    <x-input
                                        id="num_kids"
                                        name="num_kids"
                                        type="number"
                                        min="0"
                                        max="48"
                                        class="mt-1 block w-full"
                                        value="{{ old('num_kids', $reservation->num_kids) }}"
                                    />

                                    @error('num_kids')
                                        <p class="text-red-500 text-sm mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Datum en tijd --}}
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                Wanneer wilt u komen?
                            </h3>

                            <div>
                                <x-label for="time_start" value="Begintijd" />

                                <x-input
                                    id="time_start"
                                    name="time_start"
                                    type="datetime-local"
                                    step="3600"
                                    min="{{ now()->format('Y-m-d\TH:00') }}"
                                    class="mt-1 block w-full"
                                    required
                                    value="{{ old('time_start', \Carbon\Carbon::parse($reservation->time_start)->format('Y-m-d\TH:i')) }}"
                                />

                                @error('time_start')
                                    <p class="text-red-500 text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- Reserveringsopties --}}
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                Reserveringsopties
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-label for="time" value="Hoe lang?" />

                                    <select
                                        id="time"
                                        name="time"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                        required
                                    >
                                        <option value="1" {{ old('time', $reservation->time) == 1 ? 'selected' : '' }}>1 uur</option>
                                        <option value="2" {{ old('time', $reservation->time) == 2 ? 'selected' : '' }}>2 uur</option>
                                    </select>

                                    @error('time')
                                        <p class="text-red-500 text-sm mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <x-label for="banen" value="Aantal banen" />

                                    <select
                                        id="banen"
                                        name="banen"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                        required
                                    >
                                        <option value="1" {{ old('banen', $reservation->banen) == 1 ? 'selected' : '' }}>1 baan</option>
                                        <option value="2" {{ old('banen', $reservation->banen) == 2 ? 'selected' : '' }}>2 banen</option>
                                        <option value="3" {{ old('banen', $reservation->banen) == 3 ? 'selected' : '' }}>3 banen</option>
                                    </select>

                                    @error('banen')
                                        <p class="text-red-500 text-sm mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                    <small class="text-gray-500">
                                        Op één baan kunnen maximaal
                                        8 volwassenen of 6 volwassenen + 4 kinderen.
                                    </small>
                                </div>
                            </div>
                        </div>

                        {{-- Extra opties --}}
                        <div>
                            <x-label for="exstra_opties_id" value="Extra opties" />

                            <select
                                id="exstra_opties_id"
                                name="exstra_opties_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                required
                            >
                                @foreach ($data as $option)
                                    <option value="{{ $option->id }}"
                                        {{ old('exstra_opties_id', $reservation->exstra_opties_id) == $option->id ? 'selected' : '' }}>
                                        {{ $option->naam }}
                                        - {{ $option->omschrijving }}
                                        (€{{ number_format($option->cost, 2, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>

                            @error('exstra_opties_id')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="bg-gray-50 px-8 py-4 text-right border-t">
                        <x-button>
                            Reservering bijwerken
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
