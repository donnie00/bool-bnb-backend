<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        // $data = [
        //     'lat' => 41.89056,
        //     'lon' => 12.49427,
        //     'radius' => 2.3,
        //     'min_rooms' => 2,
        //     'min_beds' => 4,
        //     'services' => [1, 4, 6, 2, 7],
        // ];


        $data = $request->all();

        // Punto di partenza
        $searchCoord = [
            'lat' => deg2rad($data['lat']),
            'lon' => deg2rad($data['lon']),
        ];


        //Punto del mio appartamento da recuperare a database
        $apartmentsCoord = Apartment::select('id', 'latitude', 'longitude')->get();

        $dbCoord = [];

        foreach ($apartmentsCoord as $apartmentCoord) {
            $toPush['lat'] = deg2rad($apartmentCoord['latitude']);
            $toPush['lon'] = deg2rad($apartmentCoord['longitude']);

            $dbCoord[$apartmentCoord['id']] = $toPush;
        }

        /*esempio  1:{123415,2344534} */

        $distances = [];


        foreach ($dbCoord as $key => $coord) {

            $distance = acos((sin($searchCoord['lat'])) * (sin($coord['lat'])) + (cos($searchCoord['lat'])) * (cos($coord['lat'])) * (cos($coord['lon'] - $searchCoord['lon']))) * 6373;

            $distances[$key] = $distance;
        }

        asort($distances);

        /*      dump($distances); */


        $nearby = [];

        foreach ($distances as $key => $distance) {

            // if ($distance <= $data['radius']) {
            //     dump($distance);
            //     dump($data['radius']);
            //     dump('true');
            //     array_push($nearby, $key);
            // } else {
            //     dump($distance);
            //     dump($data['radius']);
            //     dump('false');
            // }

            if ($distance <= $data['radius']) {
                array_push($nearby, $key);
            }
        }
        /*
        $apartments = $nearby; */
        $apartments = [];

        /* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */

        if (array_key_exists('min_rooms', $data) || array_key_exists('min_beds', $data) || array_key_exists('services', $data)) {

            if (array_key_exists('min_rooms', $data) && $data['min_rooms'] > 0) {
                $dbApartments = DB::table("apartments")->select("id")
                    ->whereIn("id", $nearby)
                    ->where('rooms_qty', '>', $data['min_rooms'])
                    ->get()
                    ->pluck('id')
                    ->toArray();
                $apartments = $dbApartments;
            }

            if (array_key_exists('min_beds', $data) &&  $data['min_beds'] > 1) {

                $dbApartments = Apartment::select("id")->whereIn('id', $nearby)
                    ->where('beds_qty', '>', $data['min_beds'])
                    ->get()
                    ->pluck('id')
                    ->toArray();

                foreach ($apartments as $key => $apartment) {
                    if (!in_array($apartment, $dbApartments)) {
                        array_splice($apartments, $key, 1);
                    }
                }
            }

            if (in_array('services', $data) && count($data['services'])) {
                foreach ($data['services'] as $service) {
                    $dbApartments = ApartmentService::select('apartment_id')->whereIn('apartment_id', $nearby)->where('service_id', $service)->get()->pluck('apartment_id')->toArray();
                    array_merge($apartments, $dbApartments);

                    foreach ($apartments as $key => $apartment) {
                        if (!in_array($apartment, $dbApartments)) {
                            array_splice($apartments, $key, 1);
                        }
                    }
                }
            }
        } else {
            $apartments = $nearby;
        }

        $nearApartments = Apartment::with('images')->where('visible', 1)->whereIn('id', $apartments)->paginate(10);

        return response()->json($nearApartments);
    }
}
