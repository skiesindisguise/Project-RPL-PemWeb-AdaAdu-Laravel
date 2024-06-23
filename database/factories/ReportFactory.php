<?php
namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition()
    {
        $isAnonymous = $this->faker->boolean(30);
        
        return [
            'user_id' => User::factory(), // Ensure user_id is generated
            'title' => $this->faker->sentence,
            'anonymous' => $isAnonymous,
            'public'    => $this->faker->boolean(50),
            'description' => implode("\n\n", $this->faker->paragraphs(20)),
            'author' => $isAnonymous ? 'Anonymous' : $this->faker->name,
            'report_date' => $this->faker->dateTimeBetween('-4 years', 'now')->format('Y-m-d'),
            'votes' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['Sedang Ditindaklanjuti', 'Selesai']),
            'tag' => $this->faker->randomElement(['Fasilitas', 'Pengaduan', 'Pelanggaran', 'Kekerasan seksual']),
            'photo' => $this->faker->imageUrl(640, 480, 'animals', true),
            'status_desc' => $this->faker->sentence
        ];
    }
}

