<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\User;

class ReportSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'user')->get();
        foreach ($users as $user) {
            #$num = rand(1, 5);
            Report::factory()->count(3)->make()->each(function ($report) use ($user){
                $report->user_id = $user->id;

                if($report->anonymous) {
                    $report->author = 'Anonymous';
                } else {
                    $report->author = $user->name;
                }
                $report->save();
            });
        }
    }
}
