<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    // public function search()
    // {
    //     $lat = $_GET['lat'];
    //     $log = $_GET['log'];
    //     $circle_radius = 6371;
    //     $radius = $_GET['radius'];

    //     // $lat = 43.0911;
    //     // $log = 12.44;
    //     // $circle_radius = 6371;
    //     // $radius = 20;

    //     $services = Service::all();

    //     $houses = DB::select(DB::raw('SELECT , ( ' . $circle_radius . ' acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $log . ') ) + sin( radians(' . $lat . ') ) * sin( radians(latitude) ) ) ) AS distance FROM houses WHERE visible=1 HAVING distance < ' . $radius . ' ORDER BY distance'));

    //     // foreach ($houses as $key => $house) {
    //     //     foreach ($house->services as $key => $service) {
    //     //         dd($service);
    //     //         $house['services'] = $house->services;
    //     //     }
    //     //
    //     // };

    //     $promotions = Promotion::orderBy('price', 'DESC')->get();
    //     foreach ($promotions as $key => $promotion) {
    //         $sponsoredHouses = $promotion->houses()->where('visible', '1')->limit(8)->get();
    //     };

    //     return view('guest.search', compact('houses', 'sponsoredHouses', 'services'));
    // }

    // $lat = 45.46427; // latitudine dell'indirizzo cercato
    // $lng = 9.18951; // longitudine dell'indirizzo cercato
    // $raggio = 20; // raggio di ricerca in km (valore di default)
    // $citta = request('citta'); // città o indirizzo cercato
    // $stanze = request('stanze'); // numero minimo di stanze
    // $posti_letto = request('posti_letto'); // numero minimo di posti letto
    // $servizi_aggiuntivi = request('servizi_aggiuntivi'); // servizi aggiuntivi obbligatori

    // // Calcola la distanza tra l'indirizzo cercato e gli appartamenti nel database
    // // e seleziona solo quelli che rientrano nel raggio di ricerca
    // $appartamenti = DB::table('appartamenti')
    //     ->selectRaw('*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitudine ) ) * cos( radians( longitudine ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitudine ) ) ) ) AS distance', [$lat, $lng, $lat])
    //     ->whereRaw('( 6371 * acos( cos( radians(?) ) * cos( radians( latitudine ) ) * cos( radians( longitudine ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitudine ) ) ) ) < ?', [$lat, $lng, $lat, $raggio])
    //     ->orderBy('distance')
    //     ->get();

    // // Filtra gli appartamenti in base ai criteri di ricerca aggiuntivi
    // if ($citta) {
    //     $appartamenti = $appartamenti->where('citta', 'LIKE', '%' . $citta . '%');
    // }
    // if ($stanze) {
    //     $appartamenti = $appartamenti->where('stanze', '>=', $stanze);
    // }
    // if ($posti_letto) {
    //     $appartamenti = $appartamenti->where('posti_letto', '>=', $posti_letto);
    // }
    // if ($servizi_aggiuntivi) {
    //     foreach ($servizi_aggiuntivi as $servizio) {
    //         $appartamenti = $appartamenti->where($servizio, true);
    //     }
    // }

    // // Restituisci gli appartamenti che corrispondono ai criteri di ricerca
    // return view('risultati_ricerca', ['appartamenti' => $appartamenti]);
    // In questo esempio, la query SQL utilizza la funzione selectRaw() per calcolare la distanza tra l'indirizzo cercato e gli appartamenti nel database, e la funzione whereRaw() per selezionare solo quelli che rientrano nel raggio di ricerca. Successivamente, la query filtra gli appartamenti in base ai criteri di ricerca aggiuntivi (città, numero minimo di stanze, numero minimo di posti letto e servizi aggiuntivi obbligatori).


    public function search(Request $request)
    {

        // $data = [
        //     'lat' => 41.90793,
        //     'lon' => 12.46557,
        //     'radius' => 1.6910459936511,
        //     'min_rooms' => 2,
        //     'min_beds' => 3,
        //     'services' => [1, 4],
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

        // dump($nearby);

        $apartments = [];

/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */

if (array_key_exists('min_rooms', $data) || array_key_exists('min_beds', $data)|| array_key_exists('services', $data)){
 
        if ( array_key_exists('min_rooms', $data)&& $data['min_rooms'] > 0) {
            $dbApartments = DB::table("apartments")->select("id")
                ->whereIn("id", $nearby)
                ->where('rooms_qty', '>', $data['min_rooms'])
                ->get()
                ->pluck('id')
                ->toArray();


            $apartments = $dbApartments;
        }

        if ( array_key_exists('min_beds', $data) &&  $data['min_beds'] > 0) {

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

        if ( array_key_exists('services', $data) && count($data['services']) > 0) {
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

    }else{
        $apartments=$nearby;

    }
/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
       /*  $nearApartments = Apartment::whereIn('id', $apartments)->paginate(10); */
        $nearApartments = Apartment::whereIn('id', $apartments )->paginate(10);
        return response()->json($nearApartments);
    }
}
