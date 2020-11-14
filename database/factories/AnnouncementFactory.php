<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startAt = now()->addDays($this->faker->numberBetween(1, 30));

        return [
            'subject' => $this->faker->sentence,
            'content' => $this->faker->realText(),
            'start_at' => $startAt,
            'expiration_at' => $this->faker->dateTimeBetween($startAt->toDateTime(), '+30 days'),
            'user_id' => User::factory(),
        ];
    }
}
