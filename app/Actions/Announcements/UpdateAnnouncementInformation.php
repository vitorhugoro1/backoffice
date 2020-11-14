<?php

namespace App\Actions\Announcements;

use App\Models\Announcement;
use Illuminate\Support\Facades\Validator;

class UpdateAnnouncementInformation
{
    public function update(Announcement $announcement, array $input)
    {
        Validator::make($input, [
            'subject' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'expiration_at' => ['required', 'date'],
            'content' => ['required', 'string'],
        ])->validateWithBag('updateAnnouncementInformation');

        $announcement->forceFill([
            'subject' => $input['subject'],
            'start_at' => $input['start_at'],
            'expiration_at' => $input['expiration_at'],
            'content' => $input['content'],
        ])->save();
    }
}
