<?php

namespace Tests\Unit\Livewire;

use App\Http\Livewire\ListAnnouncements;
use App\Models\Announcement;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;

class ListAnnouncementsTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    /** @test */
    public function listUserAnnouncements()
    {
        $author = User::factory()->create();

        $announcements = Announcement::factory(10)->create([
            'user_id' => $author
        ]);

        $announcementAnotherAuthor = Announcement::factory()->create();

        Livewire::actingAs($author);

        Livewire::test(ListAnnouncements::class)
            ->assertViewIs('livewire.list-announcements')
            ->assertSee($announcements->first()->subject)
            ->assertDontSee($announcementAnotherAuthor->subject);
    }

    /** @test */
    public function notShowingAnyAnnouncement()
    {
        Announcement::factory(10)->create();

        Livewire::actingAs(User::factory()->create());

        Livewire::test(ListAnnouncements::class)
            ->assertViewIs('livewire.list-announcements')
            ->assertSee('Not has Announcements.');
    }

    /** @test */
    public function canPaginateOnAnnouncements()
    {
        $author = User::factory()->create();

        Announcement::factory(20)->create([
            'user_id' => $author
        ]);

        $announcements = Announcement::whereUserId($author->id)->latest()->get();

        Livewire::actingAs($author);

        Livewire::test(ListAnnouncements::class)
            ->assertViewIs('livewire.list-announcements')
            ->assertSee($announcements->first()->subject)
            ->set('page', 2)
            ->assertSee($announcements->last()->subject);
    }
}
