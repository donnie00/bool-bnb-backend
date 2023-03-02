<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptions = [
            [
                "name" => "silver",
                "price" => 2.99,
                "duration" => 24
            ],
            [
                "name" => "gold",
                "price" => 5.99,
                "duration" => 72
            ],
            [
                "name" => "diamond",
                "price" => 9.99,
                "duration" => 144
            ]
        ];

        foreach ($subscriptions as $subscription) {
            $newSub = new Subscription();
            $newSub->fill($subscription);
            $newSub->save();
        }
    }
}
