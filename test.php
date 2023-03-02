<?php
$services = [
            [
                "name" => "",
                "price" => 2.99,
                "duration" => 24
            ],
            [
                "name" => "",
                "price" => 5.99,
                "duration" => 24
            ],
            [
                "name" => "",
                "price" => 9.99,
                "duration" => 24
            ]
        ];

        foreach ($services as $service) {
            var_dump($service["name"]);
        }