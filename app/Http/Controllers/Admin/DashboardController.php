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

                array_push($lastApartments, $apartment);

                $apartmentId = $apartment['id'];
                $apartmentTitle = $apartment['title'];

                $message = Message::where('apartment_id', $apartmentId)->get()->toArray();

                if (count($message)) {
                    $messages[$apartmentTitle] = $message;
                    $totalMessages += count($message);
                }
            }
        }

        return view('Admin.dashboardUser', compact('user', 'userApartmentsCount', 'lastApartments', 'message', 'totalMessages'));
    }

    public function userMessages()
    {
        //Recupera l'utente dall'Auth
        $user = Auth::user();

        //Recupera tutti gli appartamenti di quell'utente e lo converte in array
        $userApartments = Apartment::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get()->toArray();

        $messages = [];

        foreach ($userApartments as $apartment) {

            $apartmentId = $apartment['id'];
            $apartmentTitle = $apartment['title'];

            $message = Message::where('apartment_id', $apartmentId)->get()->toArray();

            if (count($message)) {
                $messages[$apartmentTitle] = $message;
            }
        }

        

        return view('Admin.dashboardMessages', compact('user', 'messages'));
    }
}
