<?php

namespace App\Http\Livewire;

use App\Actions\Announcements\UpdateAnnouncementInformation;
use Livewire\Component;
use App\Models\Announcement;

class UpdateAnnouncementForm extends Component
{
    public array $state = [];

    public Announcement $announcement;

    public function mount(Announcement $announcement)
    {
        $this->state = $announcement->toArray();
        $this->announcement = $announcement;
    }

    public function render()
    {
        return view('livewire.update-announcement-form');
    }

    public function updateAnnouncementInformation(UpdateAnnouncementInformation $updater)
    {
        $updater->update(
            $this->announcement,
            array_merge(['user_id' => auth()->id()], $this->state)
        );

        $this->emit('saved');
    }
}
