<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

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

        $data = $request->all();

        // dati che ricevo dalla chiamata
        // $data = [
        //     'lat' => 41.90793,
        //     'lon' => 12.46557,
        //     'radius' => 1.8
        // ];

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

        $distances = [];

        foreach ($dbCoord as $key => $coord) {

            $distance = acos((sin($searchCoord['lat'])) * (sin($coord['lat'])) + (cos($searchCoord['lat'])) * (cos($coord['lat'])) * (cos($coord['lon'] - $searchCoord['lon']))) * 6373;

            $distances[$key] = $distance;
        }

        $nearby = [];

        foreach ($distances as $key => $distance) {

            if ($distance <= $data['radius']) {
                array_push($nearby, $key);
            }
        }

        $nearApartments = Apartment::whereIn('id', $nearby)->paginate(10);

        return response()->json($nearApartments);
    }
}
