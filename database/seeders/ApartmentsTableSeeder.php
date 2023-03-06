<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        


        $apartments=[
            [
                'user_id' =>'1',
                'title' =>'Monolocale indipendente con bagno privato',
                'address'=>'Via roma, 56',
                'latitude'=>'41.90793',
                'longitude'=>'12.46557',
                'description' =>'Tutti, senza distinzioni, siete i benvenuti nel mio monolocale con bagno privato in uno dei quartieri più vivaci e centrali della Roma popolare!',
                'rooms_qty' => '3',
                'beds_qty' =>'3',
                'bathrooms_qty' =>'1',
                'mq' =>'40',
                'daily_price'=>'36'
            ],

            [
                'user_id' =>'2',
                'title' =>'Appartamento al Colosseo',
                'address'=>'Via pescara, 56',
                'latitude'=>'41.898647',
                'longitude'=>'12.481746',
                'description' =>'Appartamento nel centro di Roma. Giardino privato, aria condizionata, riscaldamento, WiFi, Netflix, smart TV 50, colazione inclusi nel prezzo!',
                'rooms_qty' => '4',
                'beds_qty' =>'6',
                'bathrooms_qty' =>'2',
                'mq' =>'70',
                'daily_price'=>'50'
            ],

            [
                'user_id' =>'3',
                'title' =>'Suite Termini con Balcone, Wi-Fi e A/C',
                'address'=>'Via caio, 56',
                'latitude'=>'41.902409',
                'longitude'=>'12.486631',
                'description' =>'B&B nel cuore di Roma a soli 5 minuti a piedi dalla Stazione Termini. Bellissima camera con balcone, tv 32", luce per lettura, bagno in camera, materasso in Memory, appendiabiti!',
                'rooms_qty' => '2',
                'beds_qty' =>'2',
                'bathrooms_qty' =>'2',
                'mq' =>'45',
                'daily_price'=>'40'
            ],

            [
                'user_id' =>'4',
                'title' => 'Splendido Loft Appartamento',
                'address'=>'Via trieste, 6',
                'latitude'=>'41.899023',
                'longitude'=>'12.483768',
                'description' =>'Il mio loft e\' uno spazio ricavato in palazzo del XXVI secolo nel cuore di Roma unico e accogliente',
                'rooms_qty' => '2',
                'beds_qty' =>'5',
                'bathrooms_qty' =>'2',
                'mq' =>'30',
                'daily_price'=>'25'
            ],

            [
                'user_id' =>'5',
                'title' => 'La Rosa dei Venti',
                'address'=>'Via Dante, 38',
                'latitude'=>'41.906671',
                'longitude'=>'12.493032',
                'description' =>'Bilocale vista mare molto spazioso con terrazzo e zona relax',
                'rooms_qty' => '4',
                'beds_qty' =>'8',
                'bathrooms_qty' =>'4',
                'mq' =>'90',
                'daily_price'=>'70'
            ],
        ];

        for ($i=0; $i <14 ; $i++) { 
            foreach ($apartments as $apartment) {
                $newApartment = new Apartment();
    
                $newApartment->user_id = $apartment['user_id'];
                $newApartment->title = $apartment['title'];
                $newApartment->address = $apartment['address'];
                $newApartment->latitude = $apartment['latitude'];
                $newApartment->longitude = $apartment['longitude'];
                $newApartment->description = $apartment['description'];
                $newApartment->rooms_qty= $apartment['rooms_qty'];
                $newApartment->beds_qty = $apartment['beds_qty'];
                $newApartment->bathrooms_qty = $apartment['bathrooms_qty'];
                $newApartment->daily_price = $apartment['daily_price'];
                $newApartment->mq = $apartment['mq'];
                
                $newApartment->save();
            };
        }


    }
}
