<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateAnnouncementForm;
use App\Models\Announcement;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Livewire\Livewire;
use Tests\DuskTestCase;

class AnnouncementControllerTest extends DuskTestCase
{
    use WithFaker, DatabaseMigrations;

    /** @test */
    public function showUserAnnouncements()
    {
        $author = User::factory()->create();

        $announcements = Announcement::factory(10)->create([
            'user_id' => $author
        ]);

        $this->browse(function ($browse) use ($author, $announcements) {
            $browse->loginAs($author)
                ->visit(route('announcements.index'))
                ->assertSee($announcements->first()->subject);
        });
    }

    /** @test */
    public function canCreateAnnouncement()
    {
        $author = User::factory()->create();

        $this->browse(function ($browse) use ($author) {
            $browse->loginAs($author)
                ->visit(route('announcements.create'))
                ->pause(1000)
                ->type('#subject', 'Some subject')
                ->type('#start_at', today()->format('d/m/Y'))
                ->type('#expiration_at', today()->format('d/m/Y'))
                ->type('#content', $this->faker->realText())
                ->press('SAVE')
                ->waitForRoute('announcements.index')
                ->assertPathIs('/announcements');

            $this->assertTrue(Announcement::whereSubject('Some subject')->exists());
        });
    }

    /** @test */
    public function canUpdateAnnouncement()
    {
        $author = User::factory()->create();
        $announcement = Announcement::factory()->create([
            'user_id' => $author
        ]);

        $this->browse(function ($browse) use ($author, $announcement) {
            $browse->loginAs($author)
                ->visit(route('announcements.edit', $announcement->id))
                ->pause(1000)
                ->type('#subject', 'Some subject')
                ->press('SAVE')
                ->waitForText('Saved.')
                ->assertPathIs("/announcements/{$announcement->id}/edit");

            $this->assertTrue(Announcement::whereSubject('Some subject')->exists());
        });
    }
}
