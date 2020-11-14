<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithPagination;

class ListAnnouncements extends Component
{
    use WithPagination;

    public $confirmingAnnouncementDeletion = false;

    /**
     * @var Announcement|null
     */
    public $openedAnnouncement = null;

    public function render()
    {
        return view('livewire.list-announcements', [
            'announcements' => Announcement::whereUserId(auth()->id())->latest()->paginate(10)
        ]);
    }

    public function openDeleteModal(Announcement $announcement)
    {
        $this->confirmingAnnouncementDeletion = true;
        $this->openedAnnouncement = $announcement;
    }

    public function closeDeleteModal()
    {
        $this->reset(['confirmingAnnouncementDeletion', 'openedAnnouncement']);
    }

    public function deleteAnnouncement()
    {
        $this->openedAnnouncement->delete();
        $this->reset(['confirmingAnnouncementDeletion', 'openedAnnouncement']);
    }
}
