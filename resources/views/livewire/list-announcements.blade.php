<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Subject
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Start At
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Expiration At
                            </th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($announcements as $announcement)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="font-semibold">
                                    {{ $announcement->subject }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ $announcement->start_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ $announcement->expiration_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                <a href="{{ route('announcements.show', $announcement->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-2">View</a>
                                <a href="{{ route('announcements.edit', $announcement->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                <a wire:click="openDeleteModal({{ $announcement->id }})" href="#"
                                    class="text-red-600 hover:text-red-900">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-no-wrap">
                                {{ __('Not has Announcements.') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $announcements->links('layouts.custom-pagination') }}
            </div>
        </div>
    </div>

    <x-jet-confirmation-modal wire:model="confirmingAnnouncementDeletion">
        <x-slot name="title">
            Delete Announcement
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete your Announcement?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDeleteModal" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteAnnouncement" wire:loading.attr="disabled">
                Delete Announcement
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>