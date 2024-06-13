<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        State::factory()->create(
            [
                'state' => 'Negeri Sembilan'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Sabah'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Kedah'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Sarawak'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Perak'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Terengganu'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Kelantan'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Pahang'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Johor'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Selangor'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Perlis'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Melaka'
            ]
        );

        State::factory()->create(
            [
                'state' => 'Penang'
            ]
        );
    }
}
