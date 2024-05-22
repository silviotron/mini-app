<x-app-layout>
    <div class="">
        <form action="{{ route('search') }}" method="GET" class="flex items-center space-x-4">
            <input type="text" name="search" placeholder="Buscar jugador..."
                class="flex-grow p-2 border rounded text-[#222831]" value="{{ old('search', $search) }}">
            <button type="submit" class="bg-[#76ABAE]  px-4 py-2 rounded">Buscar</button>
        </form>
    </div>
    <div class="mt-4 flex flex-wrap justify-center -mx-2">
        @foreach ($players as $player)
            <div class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 px-2 mb-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md">
                    @if (!empty($player['strThumb']))
                        <div class="pb-1/1 bg-cover bg-center bg-no-repeat"
                            style="background-image: url('{{ $player['strThumb'] }}/preview')">
                            <img src="{{ $player['strThumb'] }}" alt="{{ $player['strPlayer'] }}"
                                class="object-cover object-center aspect-square w-full">
                        </div>
                    @else
                        <img src="{{ asset('player.png') }}" alt="Placeholder" class="object-cover object-center">
                    @endif
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 truncate">{{ $player['strPlayer'] }}</div>
                        <p class="text-gray-700 dark:text-gray-300 text-base truncate">Nacionalidad:
                            {{ $player['strNationality'] }}</p>
                        <p class="text-gray-700 dark:text-gray-300 text-base truncate">Nacimiento:
                            {{ $player['dateBorn'] }}</p>
                        <p class="text-gray-700 dark:text-gray-300 text-base truncate">Equipo:
                            @if ($player['strTeam'] === '_Retired Soccer')
                                Retirado
                            @else
                                {{ $player['strTeam'] }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>





</x-app-layout>
