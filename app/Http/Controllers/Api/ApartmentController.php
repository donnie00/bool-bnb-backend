<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sponsored = ApartmentSubscription::select('apartment_id')->get()->pluck('apartment_id')->toArray();

        if ($sponsored) {
            $apartments = Apartment::with('images', 'services', 'subscriptions')
                ->where('visible', 1)
                ->whereIn('id', $sponsored)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $apartments = Apartment::with('images', 'services')
                ->where('visible', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return response()->json($apartments);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        if ($apartment->visible === 1) {

            $apartment->load('services', 'images');

            return response()->json($apartment);
        } else {
            return response()->json('error');
        }
    }
}
