<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'author' => $this->faker->name,
            'report_date' => $this->faker->date,
            'votes' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['Sedang Ditindaklanjuti', 'Selesai']),
            'tag' => $this->faker->randomElement(['Fasilitas', 'Pengaduan', 'Pelanggaran', 'kekerasan seksual']), // Sesuaikan dengan kebutuhan dan data tersedia'Fasilitas', // Sesuaikan dengan kebutuhan
            'photo' => $this->faker->imageUrl(640, 480, 'animals', true), // Menggunakan URL gambar dari Faker
            'status_desc' => $this->faker->sentence
        ];
    }
}
