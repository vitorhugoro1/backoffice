<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Actions\Announcements\CreateAnnouncement;

class CreateAnnouncementForm extends Component
{
    public array $state = [];

    public function render()
    {
        return view('livewire.create-announcement-form');
    }

    public function createAnnouncement(CreateAnnouncement $creator)
    {
        $announcement = $creator->create(
            $this->state
        );

        return redirect()->route('announcements.edit', $announcement->id);
    }
}
