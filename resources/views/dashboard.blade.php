<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Сервисы') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" flex  overflow-hidden shadow-xl sm:rounded-lg gap-2">
                @foreach($services as $service)
                    <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 w-1/2">
                        <div class="flex justify-between">
                            <div class="text-2xl dark:text-gray-200">
                                {{ $service->key }}
                            </div>
                            @if ($service->status == 1)
                                <div class="mt-2 dark:text-green-400">
                                    Успешно
                                </div>
                            @else
                                <div class="mt-2 dark:text-red-400">
                                    Ошибка
                                </div>
                            @endif
                        </div>
                        <div class="mt-2 dark:text-gray-400">
                            Количество логов: {{ $service->logs_count }}
                        </div>
                        <div class="mt-2 dark:text-gray-400">
                            Цель: {{ $service->count }}
                        </div>
                        <div class="mt-2 dark:text-gray-400">
                            Интервал: Каждые {{ $service->interval }} {{ $service->translate_frequency }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
