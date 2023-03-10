<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$apartments = Apartment::paginate(20);

        // $sponsored = ApartmentSubscription::select('apartment_id')->get()->pluck('id')->toArray();

        $apartments = Apartment::with('images', 'services')
            ->orderBy('created_at', 'desc')
            ->paginate(15);



        return response()->json($apartments);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        $apartment->load('services', 'images');

        return response()->json($apartment);
    }
}
