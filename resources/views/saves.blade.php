<x-app-layout>
    <div class="mt-4 flex flex-wrap justify-center -mx-2">
        @if ($saves->isEmpty())
            <div class="text-center mt-28 text-gray-400 text-4xl">sin datos</div>
        @endif
        @foreach ($saves as $save)
            <div class="w-full mb-4">
                <div class="overflow-hidden mb-4">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2"><span class="text-gray-500 text-sm"
                                id="created-at-{{ $loop->iteration }}"></span>
                            Búsqueda: {{ $save->search }} </div>
                        <div class="mt-4 flex flex-wrap justify-center -mx-2">
                            @foreach ($save->results as $result)
                                <div class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 px-2 mb-4">
                                    <div class="bg-white dark:bg-[#31363F] rounded-lg overflow-hidden shadow-lg">
                                        @if (!empty($result->thumbnail))
                                            <div class="pb-1/1 bg-cover bg-center bg-no-repeat"
                                                style="background-image: url('{{ $result->thumbnail }}/preview')">
                                                <img src="{{ $result->thumbnail }}" alt="{{ $result->name }}"
                                                    class="object-cover object-center aspect-square w-full">
                                            </div>
                                        @else
                                            <div class="pb-1/1">
                                                <img src="{{ asset('player.png') }}" alt="Placeholder"
                                                    class="object-cover object-center aspect-square w-full">

                                            </div>
                                        @endif
                                        <div class="px-6 py-4">
                                            <div class="font-bold text-xl mb-2 truncate">{{ $result->name }}</div>

                                            <div class="flex justify-between items-center mb-2">
                                                <div>
                                                    <div class="flex items-center mb-1">
                                                        <div class="w-6 h-6 flex-shrink-0 mr-2">
                                                            <img src="{{ $result->flag }}"
                                                                alt="{{ $result->nationality }}"
                                                                class="object-contain w-full h-full"
                                                                title="{{ $result->nationality }}">
                                                        </div>
                                                        <p class="text-gray-700 dark:text-gray-300 text-base truncate">
                                                            @if ($result->age !== null)
                                                                {{ $result->date . ' (' . $result->age . ')' }}
                                                            @else
                                                                {{ $result->date }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <p class="text-gray-700 dark:text-gray-300 text-base truncate">
                                                        @if ($result->team === '_Retired Soccer')
                                                            Retirado
                                                        @elseif($result->team === '_Free Agent Soccer')
                                                            Agente libre
                                                        @elseif($result->team === '_Deceased Soccer')
                                                            Fallecido
                                                        @else
                                                            {{ $result->team }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div>
                                                    @if (!empty($result->equipment))
                                                        <img src="{{ $result->equipment }}"
                                                            alt="{{ $result->equipment }}"
                                                            class="object-cover object-center aspect-square w-16"
                                                            title="{{ $result->equipmentSeason }}">
                                                    @elseif($result->team === '_Retired Soccer')
                                                        <img src="{{ asset('retired.png') }}" alt="Retirado"
                                                            title="Retirado" class="object-cover object-center w-16">
                                                    @elseif($result->team === '_Free Agent Soccer')
                                                        <img src="{{ asset('freeAgent.png') }}" alt="Agente libre"
                                                            title="Agente libre"
                                                            class="object-cover object-center w-16">
                                                    @elseif($result->team === '_Deceased Soccer')
                                                        <img src="{{ asset('deceased.png') }}" alt="Fallecido"
                                                            title="Fallecido" class="object-cover object-center w-16">
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
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $saves->links() }}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var saveCreatedAt = @json(
                $saves->pluck('created_at')->map(function ($date) {
                    return $date->setTimezone('UTC')->toIso8601String();
                }));
            var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

            saveCreatedAt.forEach(function(dateString, index) {
                var createdAtElement = document.getElementById('created-at-' + (index + 1));
                var date = new Date(dateString);
                var localDate = new Date(date.toLocaleString("en-US", {
                    timeZone: userTimezone
                }));
                createdAtElement.textContent = localDate.toLocaleString();
            });
        });
    </script>
</x-app-layout>
