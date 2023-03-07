<?php

namespace App\Http\Controllers\Admin\apartments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreApartmentRequest;
use App\Http\Requests\Admin\UpdateApartmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();

        $apartments = Apartment::where("user_id", $id)
            ->orderBy("created_at", "desc")
            ->get();
        return view("Admin.apartments.index", compact("apartments"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view("Admin.apartments.create", compact("services"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        $data = $request->validated();
        $id = Auth::id();

        $newApartment = [
            ...$data,
            "user_id" => $id,
            "latitude" => 98.57485,
            "longitude" => 98.57485,
        ];

        if (key_exists("cover_img", $data)) {
            $path = Storage::put("apartments_images", $data["cover_img"]);
        }

        $apartment = Apartment::create([
            ...$newApartment,
            'cover_img' => $path ?? null
        ]);

        if ($request->has('services')) {
            $apartment->services()->attach($data["services"]);
        }

        return redirect()->route("Admin.apartments.show", $apartment->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return view("Admin.apartments.show", compact("apartment"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        return view("Admin.apartments.edit", compact("apartment", "services"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $data = $request->validated();

        if (key_exists("cover_img", $data)) {
            $path = Storage::put("apartments_images", $data["cover_img"]);
            Storage::delete($apartment->cover_img);
        }


        $apartment->update([
            ...$data,
            "cover_img" => $path ?? $apartment->cover_img
        ]);

        $apartment->services()->sync($data["services"]);

        return redirect()->route("Admin.apartments.show", $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {

        if ($apartment->cover_img) {
            Storage::delete($apartment->cover_img);
        }

        $apartment->services()->detach();
        $apartment->subscriptions()->detach();

        $apartment->delete();

        return redirect()->route("Admin.apartments.index");
    }

    public function add_subscription(Request $request, Apartment $apartment)
    {

        $data = $request->validate([
            "subscription_id" => "exists:subscriptions,id"
        ]);

        // Per provare senza dati passati dal front-end
        // $id = 1;
        // $data = [];
        // $data["subscription_id"] = 6;

        $duration = DB::table("subscriptions")->select("duration")
            ->where("id", $data["subscription_id"])
            ->get();

        $exp_date = date("Y-m-d: H:i:s", strtotime("+{$duration[0]->duration} hours"));

        $apartment->subscriptions()->attach($data["subscription_id"]);

        DB::table("apartment_subscription")
            ->where("subscription_id", $data["subscription_id"])
            ->where("apartment_id", $apartment->id)
            ->update(["expiration_date" => $exp_date]);
    }
}
