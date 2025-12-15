<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marketing Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column: Request Form -->
                <div class="md:col-span-1">
                    <livewire:user-request-form />
                </div>

                <!-- Right Column: History & Status -->
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <livewire:user-request-history />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
