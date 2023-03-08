<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {   
        $apartments_id=DB::table("apartments")->select("id")->pluck("id")->toArray();

        for ($i=0; $i <200 ; $i++) { 
            $rand_key = array_rand($apartments_id, 1);
            $apartment_id = $apartments_id[$rand_key];

            $message = new Message();
    
            $message->message=$faker->text(300);
            $message->email=$faker->email();
            $message->sender=$faker->name();
            $message->subject=$faker->word(1, true);

            $message->apartment_id = $apartment_id;

            $message->save();
        }



    }

    
}
