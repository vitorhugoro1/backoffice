<?php

namespace Tests\Unit;

use App\Actions\Announcements\CreateAnnouncement;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class CreateAnnouncementsTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    private CreateAnnouncement $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new CreateAnnouncement;
    }

    /** @test */
    public function shouldCreateAnAnnouncement()
    {
        $input = [
            'subject' => $this->faker->sentence,
            'start_at' => now(),
            'expiration_at' => now(),
            'content' => $this->faker->realText(),
        ];

        $this->actingAs(User::factory()->create());

        $announcement = $this->service->create($input);

        $this->assertEquals($input['subject'], $announcement->subject);
        $this->assertEquals($input['start_at'], $announcement->start_at);
        $this->assertEquals($input['expiration_at'], $announcement->expiration_at);
        $this->assertEquals($input['content'], $announcement->content);
    }

    /** @test */
    public function willThrowExceptionValidation()
    {
        $input = [
            'subject' => '',
            'start_at' => now(),
            'expiration_at' => now(),
            'content' => $this->faker->realText(),
        ];

        $this->actingAs(User::factory()->create());

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->service->create($input);
    }
}
