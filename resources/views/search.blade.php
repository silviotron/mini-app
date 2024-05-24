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

                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <div class="flex items-center mb-1">
                                    <div class="w-6 h-6 flex-shrink-0 mr-2">
                                        <img src="{{ $player['flag'] }}" alt="{{ $player['strNationality'] }}"
                                            class="object-contain w-full h-full"
                                            title="{{ $player['strNationality'] }}">
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-300 text-base truncate">
                                        {{ $player['dateBorn'] . ' (' . $player['age'] . ')' }}</p>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 text-base truncate">
                                    @if ($player['strTeam'] === '_Retired Soccer')
                                        Retirado
                                    @elseif($player['strTeam'] === '_Free Agent Soccer')
                                        Agente libre
                                    @elseif($player['strTeam'] === '_Deceased Soccer')
                                        Fallecido
                                    @else
                                        {{ $player['strTeam'] }}
                                    @endif
                                </p>
                            </div>
                            <div>
                                @if (!empty($player['equipment']['strEquipment']))
                                    <img src="{{ $player['equipment']['strEquipment'] }}"
                                        alt="{{ $player['strPlayer'] }}"
                                        class="object-cover object-center aspect-square w-16"
                                        title="{{ $player['equipment']['strSeason'] }}">
                                @elseif($player['strTeam'] === '_Retired Soccer')
                                    <img src="{{ asset('retired.png') }}" alt="Retirado" title="Retirado"
                                        class="object-cover object-center w-16">
                                @elseif($player['strTeam'] === '_Free Agent Soccer')
                                    <img src="{{ asset('freeAgent.png') }}" alt="Agente libre" title="Agente libre"
                                        class="object-cover object-center w-16">
                                @elseif($player['strTeam'] === '_Deceased Soccer')
                                    <img src="{{ asset('deceased.png') }}" alt="Fallecido" title="Fallecido"
                                        class="object-cover object-center w-16">
                                @else
                                    <img src="{{ asset('jersey.png') }}" alt="Placeholder"
                                        class="object-cover object-center w-16">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if (!empty($players))
        <form action="{{ route('saveResults') }}" method="POST">
            @csrf
            <input type="hidden" name="search" value="{{ $search }}">
            @foreach ($players as $player)
                <input type="hidden" name="players[]" value="{{ json_encode($player) }}">
            @endforeach
            <button type="submit" class="bg-[#76ABAE] px-4 py-2 rounded">Guardar Resultados</button>
        </form>
    @endif
</x-app-layout>
