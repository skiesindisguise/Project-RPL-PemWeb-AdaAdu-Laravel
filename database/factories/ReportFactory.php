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
            #'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'anonymous' => $isAnonymous,
            'public'    => $this->faker->boolean(50),
            'description' => implode("\n\n", $this->faker->paragraphs(20)),
            #'author' => $isAnonymous ? 'Anonim' : $this->faker->name,
            'report_date' => $this->faker->dateTimeBetween('-4 years', 'now'),
            'votes' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['Sedang Ditindaklanjuti', 'Selesai']),
            'tag' => $this->faker->randomElement(['Fasilitas', 'Pengaduan', 'Pelanggaran', 'kekerasan seksual']), // Sesuaikan dengan kebutuhan dan data tersedia'Fasilitas', // Sesuaikan dengan kebutuhan
            'photo' => $this->faker->imageUrl(640, 480, 'animals', true), // Menggunakan URL gambar dari Faker
            'status_desc' => $this->faker->sentence
        ];
    }
}
