<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('bewerk resevering') }}
        </h2>
    </x-slot>


    <div class="py-12 ontent-center">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <h1>aantal mensen</h1>

                                <div class="col-span-6 sm:col-span-3">

                                    <x-label for="num_adults" value="{{ __('volwasennen ') }}" />
                                    <x-input id="num_adults" value="{{ $reservation->num_adults }}" min="1"
                                        name="num_adults" type="number" class="mt-1 block w-full" required />

                                    <x-label for="num_kids" value="{{ __('kinderren') }}" />
                                    <x-input id="num_kids" value="{{ $reservation->num_kids }}" min="1"
                                        name="num_kids" type="number" class="mt-1 block w-full" required /><br>
                                    <h1>waneer will u komen ?</h1>

                                    <x-label for="time_start" value="{{ __('begin') }}" />
                                    <x-input id="time_start" min="{{ $today }}"  value="{{ $reservation->time_start }}"
                                        name="time_start" type="datetime-local" class="mt-1 block w-full" required />

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-label for="time" value="{{ __('hoe lang ') }}" />
                                        <select id="time" name="time" class="mt-1 block w-full" required>
                                            <option value="1" @selected($reservation->hours == 1)>
                                                <p>1 uur</p>
                                            </option>
                                            <option value="2" @selected($reservation->hours == 2)>
                                                <p>2 uur</p>
                                            </option>
                                        </select>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-label for="banen" value="{{ __('hoe veel banen ') }}" />
                                            <small>op een baan kunnen 8 volwasen of 6 volwasen met 4 kinderen. </small>
                                            <select id="banen" name="banen" class="mt-1 block w-full" required>
                                                <option value="1">
                                                    <p>1</p>
                                                </option>
                                                <option value="2">
                                                    <p>2 </p>
                                                </option>
                                                <option value="3">
                                                    <p>3 </p>
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-label for="exstra_opties_id" value="{{ __('exstra_opties') }}" />
                                            <select id="exstra_opties_id"  value="{{ $reservation->exstra_opties_id }}" name="exstra_opties_id"
                                                class="mt-1 block w-full" required>
                                                @foreach ($data as $options)
                                                    <option value="{{ $options->id }}" @selected($options->id == $reservation->exstra_opties_id)>
                                                        {{ $options->naam }}:
                                                        {{ $options->omschrijving }}
                                                        &#8364; {{ $options->cost }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('mailbox')
                                {{ $message }}
                            @enderror
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <x-button>
                                    {{ __('Bererk') }}
                                </x-button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

</x-app-layout>
