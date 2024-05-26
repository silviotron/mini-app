<x-app-layout>
    <div class="mt-4 flex flex-wrap justify-center -mx-2">





        <div class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 px-2 mb-4">
            <div class="bg-white dark:bg-[#31363F] rounded-lg overflow-hidden shadow-lg min-h-[24.25rem]">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2 truncate text-center">Nacionalidades</div>
                    @if ($flags->isEmpty())
                        <div class="text-center mt-28 text-gray-400">sin datos</div>
                    @endif
                    @foreach ($flags->take(10) as $flag)
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-6 h-6 flex-shrink-0 mr-2">
                                <img src="{{ $flag->flag }}" alt="Bandera" class="object-contain w-full h-full"
                                    title="{{ substr($flag->flag, 24, -5) }}">
                            </div>
                            <div class="w-full bg-gray-200  h-4 dark:bg-gray-700" title="{{ $flag->flag_count }}">
                                <div class="bg-[#76ABAE] h-full "
                                    style="width: {{ ($flag->flag_count / $flags[0]->flag_count) * 100 }}%;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 px-2 mb-4 ">
            <div class="bg-white dark:bg-[#31363F] rounded-lg overflow-hidden shadow-lg min-h-[24.25rem]">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2 truncate text-center">Edades</div>
                    @if ($ages->isEmpty())
                        <div class="text-center mt-28 text-gray-400">sin datos</div>
                    @endif
                    @foreach ($ages->take(10) as $age)
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-6 h-6 flex-shrink-0 mr-2">
                                @if ($age->age === 'deceased')
                                    <img src="{{ asset('deceased.png') }}" alt="fallecido"
                                        class="object-contain w-full h-full" title="fallecido">
                                @else
                                    <span>{{ $age->age }}</span>
                                @endif

                            </div>
                            <div class="w-full bg-gray-200  h-4 dark:bg-gray-700" title="{{ $age->age_count }}">
                                <div class="bg-[#76ABAE] h-full "
                                    style="width: {{ ($age->age_count / $ages[0]->age_count) * 100 }}%;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 px-2 mb-4">

            <div class="bg-white dark:bg-[#31363F] rounded-lg overflow-hidden shadow-lg mb-4">
                <div class="px-6 py-6">

                    <div class="font-bold text-xl mb-2 text-center">
                        <div>
                            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-3.5 truncate">
                                {{ $search ? $search : 'sin datos' }}</h5>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400  truncate">última
                                busqueda guardada</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#31363F] rounded-lg overflow-hidden shadow-lg mb-4">
                <div class="px-6 py-5">

                    <div class="font-bold text-xl mb-2  text-center">
                        <div>
                            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-3.5 truncate">
                                {{ $saves_count }}</h5>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400 ">Búsquedas guardadas</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#31363F] rounded-lg overflow-hidden shadow-lg mb-4">
                <div class="px-6 py-5">

                    <div class="font-bold text-xl mb-2  text-center">
                        <div>
                            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-3.5 truncate">
                                {{ $results_count }}</h5>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Resultados guardados</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



</x-app-layout>
