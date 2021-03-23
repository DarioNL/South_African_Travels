<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Facility;
use App\Models\Travel;
use App\Models\traveler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('web')->check()) {
            $bookings = Booking::all()->where('user_id', '=', Auth::id());
            return view('bookings.index', compact('bookings'));
        }else{
            $bookings = Booking::all();
            return view('bookings.index', compact('bookings'));
        }
    }

    public function show($id)
    {
        $booking =Booking::find($id);
        if (Auth::guard('web')->check()) {
            if ($booking->user_id = Auth::id()) {
                return view('bookings.show', compact('booking'));
            }else{
                return redirect('/bookings');
            }

        }else{
            return view('bookings.show', compact('booking'));
        }
    }

    public function cancel($id)
    {
        $booking = Booking::find($id);
        return view('bookings.cancel', compact('booking'));
    }

    public function isPayed()
    {
        return view('bookings.payed');
    }

    public function postIsPayed($id){
        $booking = Booking::find($id);

        $booking->is_payed = 1;

        return redirect('/bookings');
    }

    public function postCancel($id){
        $booking = Booking::find($id);
        if (Auth::guard('web')->check()) {
            if ($booking->user_id = Auth::id()){
                $booking->travel->is_booked = 0;
                $booking->travel->save();
                $booking->delete();
            }
        }else{
            $booking->travel->is_booked = 0;
            $booking->travel->save();
            $booking->delete();
        }

        return redirect('/boekingen');
    }
}
