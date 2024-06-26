<x-app-layout>
    <div class="">
        <form action="{{ route('search') }}" method="GET" class="flex items-center space-x-4">
            <input type="text" name="search" placeholder="Buscar jugador..."
                class="flex-grow p-2 border rounded text-[#222831]"
                value="{{ old('search', isset($search) ? $search : '') }}">
            <button type="submit"
                class="bg-[#31363F] text-[#EEEEEE] dark:bg-[#76ABAE]  px-4 py-2 rounded">Buscar</button>
        </form>
    </div>
    @if (session('success'))
        <div class="flex justify-center mt-4 mb-4">
            <div class="bg-green-200 text-green-700 px-4 py-2 rounded-md">
                {{ session('success') }}
            </div>
        </div>
    @elseif (session('error'))
        <div class="flex justify-center mt-4 mb-4">
            <div class="bg-red-200 text-red-700 px-4 py-2 rounded-md">
                {{ session('error') }}
            </div>
        </div>
    @endif
    <div class="mt-4 flex flex-wrap justify-center -mx-2">
        @if (isset($players) && count($players) === 0)
            <div class="text-center mt-28 text-gray-400 text-4xl">sin resultados</div>
        @elseif(isset($players))
            @foreach ($players as $player)
                <div class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 px-2 mb-4">
                    <div class="bg-white dark:bg-[#31363F] rounded-lg overflow-hidden shadow-lg">
                        @if (!empty($player['strThumb']))
                            <div class="pb-1/1 bg-cover bg-center bg-no-repeat"
                                style="background-image: url('{{ $player['strThumb'] }}/preview')">
                                <img src="{{ $player['strThumb'] }}" alt="{{ $player['strPlayer'] }}"
                                    class="object-cover object-center aspect-square w-full">
                            </div>
                        @else
                            <div class="pb-1/1">
                                <img src="{{ asset('player.png') }}" alt="Placeholder"
                                    class="object-cover object-center aspect-square w-full">

                            </div>
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
                                            @if ($player['age'] !== null)
                                                {{ $player['dateBorn'] . ' (' . $player['age'] . ')' }}
                                            @else
                                                {{ $player['dateBorn'] }}
                                            @endif
                                        </p>
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
        @endif

    </div>
    @if (!empty($players) && !session('success'))
        <form action="{{ route('saveResults') }}" method="POST">
            @csrf
            <button type="submit" class="bg-[#31363F] text-[#EEEEEE] dark:bg-[#76ABAE]  px-4 py-2 rounded">Guardar
                Resultados</button>
        </form>
    @endif
</x-app-layout>
