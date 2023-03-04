<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imgJson = Storage::get('database/data/immagini.json');

        $apartmentsImages = json_decode($imgJson, true);

        foreach ($apartmentsImages as $images) {
            $newImage = new Image();

            $newImage->apartment_id = 1;
            foreach ($images as $image) {
                $newImage->image = $image;
            }
        }
    }
}
