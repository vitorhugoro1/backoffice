<?php

namespace Tests\Unit\Livewire;

use App\Http\Livewire\CreateAnnouncementForm;
use App\Models\Announcement;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;

class CreateAnnouncementFormTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    /** @test */
    public function canCreateAnnouncement()
    {
        $this->actingAs(User::factory()->create());

        $state = [
            'subject' => $this->faker->sentence,
            'start_at' => now(),
            'expiration_at' => now(),
            'content' => $this->faker->realText(),
        ];

        Livewire::test(CreateAnnouncementForm::class)
            ->set('state', $state)
            ->call('createAnnouncement')
            ->assertRedirect(route('announcements.index'));

        $this->assertTrue(Announcement::whereSubject($state['subject'])->exists());
    }

    /** @test */
    public function willValidateRequiredField()
    {
        $this->actingAs(User::factory()->create());

        $state = [
            'subject' => '',
            'start_at' => now(),
            'expiration_at' => now(),
            'content' => $this->faker->realText(),
        ];

        Livewire::test(CreateAnnouncementForm::class)
            ->set('state', $state)
            ->call('createAnnouncement')
            ->assertHasErrors(['subject' => 'required']);
    }
}
