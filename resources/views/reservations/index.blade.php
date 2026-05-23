<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-arial text-xl text-red-800 dark:text-red-500  leading-tight">
            {{ __('reseveeringen') }}
        </h2>
    </x-slot>

    <div class=" py-12   bg-gray-700" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 id="h4">uw resevaties:</h2>
            <div class="flex text-yellow-800 justify-between items-center mb-4">
                <a  id="h4" class="flex space-x-2" id="add-reseveering" href="{{ route('reservations.create') }}">
                    maak een resevatie &nbsp;
                    <img src="{{url(asset('storage/img/add-symbol.svg'))}}" href="{{ route('reservations.create') }}" width="20" height="20">
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                naam
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                aantal banen
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                aantal mensen
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                tijd resevatie
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                extra optie
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acties
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($data as $pakket)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pakket->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pakket->banen}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    volwassenen: {{ $pakket->num_adults }} <br>
                                    @if ($pakket->num_kids > 0)
                                        kinderren: {{ $pakket->num_kids }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{-- {{ \Carbon\Carbon::parse($pakket->time_start)->format('') }} <br> --}}
                                    om: {{$pakket->time_start}}<br>
                                    hoelang: {{ $pakket->duration }} uur
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pakket->exstra_opties->naam }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('reservations.edit', $pakket->id) }}" class="text-indigo-600 hover:text-indigo-900">Bewerken</a>
                                    <form action="{{ route('reservations.destroy', $pakket->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
