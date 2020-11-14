<?php

namespace Tests\Unit\Livewire;

use App\Http\Livewire\UpdateAnnouncementForm;
use App\Models\Announcement;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Livewire\Livewire;

class UpdateAnnouncementFormTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    /** @test */
    public function canUpdateAnnouncement()
    {
        $author = User::factory()->create();

        $announcement = Announcement::factory()->create([
            'user_id' => $author
        ]);

        $state = array_merge(
            $announcement->toArray(),
            [
                'subject' => 'Updated Subject'
            ]
        );

        Livewire::actingAs($author);

        Livewire::test(UpdateAnnouncementForm::class, ['announcement' => $announcement])
            ->set('state', $state)
            ->call('updateAnnouncementInformation')
            ->assertEmitted('saved');

        $this->assertDatabaseHas('announcements', [
            'id' => $announcement->id,
            'subject' => $state['subject']
        ]);
    }

    /** @test */
    public function doesNotCanUpdateAnnouncement()
    {
        $author = User::factory()->create();

        $announcement = Announcement::factory()->create();

        $state = array_merge(
            $announcement->toArray(),
            [
                'subject' => 'Updated Subject'
            ]
        );

        Livewire::actingAs($author);

        Livewire::test(UpdateAnnouncementForm::class, ['announcement' => $announcement])
            ->set('state', $state)
            ->call('updateAnnouncementInformation')
            ->assertForbidden();
    }

    /** @test */
    public function willValidateRequiredField()
    {
        $author = User::factory()->create();

        $announcement = Announcement::factory()->create([
            'user_id' => $author
        ]);

        $state = array_merge(
            $announcement->toArray(),
            [
                'subject' => ''
            ]
        );

        Livewire::actingAs($author);

        Livewire::test(UpdateAnnouncementForm::class, ['announcement' => $announcement])
            ->set('state', $state)
            ->call('updateAnnouncementInformation')
            ->assertHasErrors([
                'subject' => 'required'
            ]);
    }
}
