<?php

namespace Tests\Unit;

use App\Actions\Announcements\UpdateAnnouncementInformation;
use App\Models\Announcement;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UpdateAnnouncementInformationTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    private UpdateAnnouncementInformation $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new UpdateAnnouncementInformation;
    }

    /** @test */
    public function shouldUpdateAnnouncementInformations()
    {
        $author = User::factory()->create();
        $announcement = Announcement::factory()->create([
            'user_id' => $author
        ]);
        $input = array_merge(
            $announcement->toArray(),
            [
                'subject' => 'Subject Updated',
            ]
        );

        $this->actingAs($author);

        $this->service->update($announcement, $input);

        $this->assertDatabaseHas('announcements', [
            'id' => $announcement->id,
            'subject' => $input['subject']
        ]);
    }

    /** @test */
    public function willThrowExceptionValidation()
    {
        $author = User::factory()->create();
        $announcement = Announcement::factory()->create([
            'user_id' => $author
        ]);
        $input = array_merge(
            $announcement->toArray(),
            [
                'subject' => '',
            ]
        );

        $this->actingAs($author);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->service->update($announcement, $input);
    }

    /** @test */
    public function shouldNotAuthorizeNotCreatorAction()
    {
        $announcement = Announcement::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $input = array_merge(
            $announcement->toArray(),
            [
                'subject' => '',
            ]
        );

        $this->actingAs(User::factory()->create());

        $this->expectException(\Illuminate\Auth\Access\AuthorizationException::class);

        $this->service->update($announcement, $input);
    }
}
