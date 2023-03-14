<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function userInfo()
    {

        //Recupera l'utente dall'Auth
        $user = Auth::user();

        //Recupera tutti gli appartamenti di quell'utente e lo converte in array
        $userApartments = Apartment::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get()->toArray();

        $userApartmentsCount = count($userApartments);

        $lastApartments = [];
        $totalMessages = 0;

        foreach ($userApartments as $apartment) {

            if (count($lastApartments) < 3) {

                $apartmentId = $apartment['id'];

                $apartmentTitle = $apartment['title'];
            }
            $apartment_messages = Message::where('apartment_id', $apartment["id"])->get()->toArray();

            if ($apartment_messages) {
                $totalMessages += count($apartment_messages);
            }
        }

        return view('Admin.dashboardUser', compact('user', 'userApartmentsCount', 'lastApartments', 'totalMessages'));
    }

    public function userMessages()
    {
        //Recupera l'utente dall'Auth
        $user = Auth::user();


        //Recupera tutti gli appartamenti di quell'utente e lo converte in array
        $userApartments = Apartment::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get()->toArray();


        $new_messages = [];
        $read_messages = [];


        $count_total_messages = 0;

        foreach ($userApartments as $key => $apartment) {

            $apartmentId = $apartment["id"];


            $new_apartment_messages = Message::where('apartment_id', $apartmentId)->where('read', 0)->get()->toArray();
            $read_apartment_messages = Message::where('apartment_id', $apartmentId)->where('read', 1)->get()->toArray();

            if ($new_apartment_messages) {
                // array_push($messages, $apartment_messages);

                $new_messages[$apartment['title'] . ' ' . strval($key)] = $new_apartment_messages;
                $count_total_messages += count($new_apartment_messages);
            }

            if ($read_apartment_messages) {
                // array_push($messages, $apartment_messages);

                $read_messages[$apartment['title'] . ' ' . strval($key)] = $read_apartment_messages;
                $count_total_messages += count($read_apartment_messages);
            }
        }

        return view('Admin.dashboardMessages', compact('user', 'new_messages', 'read_messages'));
    }
}
