<?php

namespace App\Actions\Announcements;

use App\Models\Announcement;
use Illuminate\Support\Facades\Validator;

class CreateAnnouncement
{
    /**
     * Create an Announcement
     *
     * @param array $input
     *
     * @return Announcement
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'subject' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'expiration_at' => ['required', 'date'],
            'content' => ['required', 'string'],
        ])->validateWithBag('createAnnouncementInformation');

        $announcement = new Announcement();
        $announcement->forceFill([
            'subject' => $input['subject'],
            'start_at' => $input['start_at'],
            'expiration_at' => $input['expiration_at'],
            'content' => $input['content'],
            'user_id' => auth()->id()
        ])->save();

        return $announcement;
    }
}
