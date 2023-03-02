<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Wi-fi',
                'icon' => 'fa-solid fa-wifi'
            ],
            [
                'name' => 'Cucina',
                'icon' => 'fa-solid fa-fire-burner'
            ],
            [
                'name' => 'Lavatrice',
                'icon' => ''
            ],
            [
                'name' => 'Asciugatrice',
                'icon' => ''
            ],
            [
                'name' => 'Riscaldamento',
                'icon' => 'fa-solid fa-fire'
            ],
            [
                'name' => 'Aria Condizionata',
                'icon' => 'fa-solid fa-wind'
            ],
            [
                'name' => 'TV',
                'icon' => 'fa-solid fa-tv'
            ],
            [
                'name' => 'Piscina',
                'icon' => 'fa-solid fa-water-ladder'
            ],
            [
                'name' => 'Palestra',
                'icon' => 'fa-solid fa-dumbbell'
            ],
            [
                'name' => 'Colazione',
                'icon' => 'fa-solid fa-mug-saucer'
            ],
            [
                'name' => 'Parcheggio',
                'icon' => 'fa-solid fa-square-parking'
            ],
        ];

        foreach ($services as $service) {

            $newService = new Service();

            $newService->name = $service['name'];
            $newService->icon = $service['icon'];

            $newService->save();
        }
    }
}
