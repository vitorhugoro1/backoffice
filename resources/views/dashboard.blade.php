<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-2xl">
                        Announcements of Day!
                    </div>

                    <div class="mt-6 text-gray-500">
                        <div class="flex flex-col space-y-3">
                            @forelse ($announcements as $announcement)
                            <div class="bg-green-100 flex flex-col p-3 rounded-xl">
                                <div class="font-bold text-sm">{{ $announcement->subject }}</div>
                                <div class="text-xs">{{ $announcement->content }}</div>
                            </div>
                            @empty
                                <div class="text-bold text-xl">{{ __('Without Announcements Today!') }}</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>