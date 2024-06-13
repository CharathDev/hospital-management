<?php

namespace Database\Seeders;

use App\Models\Timeslot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Timeslot::factory()->create(
            [
                'time' => "9:00"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "9:30"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "10:00"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "10:30"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "11:00"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "11:30"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "2:00"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "2:30"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "3:00"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "3:30"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "4:00"
            ]
        );

        Timeslot::factory()->create(
            [
                'time' => "4:30"
            ]
        );
    }
}
