<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Illuminate\Http\Exceptions\HttpResponseException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::where('id', Auth::id())->with('service')->paginate(5);

        return response()->json($bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'service_id' => 'required',    
        ]);

        if($validator->fails()) {
            return response()->json('Validator Fails');
        }

        $booking = new Booking;
        $booking->user_id = Auth::id();
        $booking->service_id = $service->id;
        $booking->time = Carbon::now();
        $booking->save();

        return response()->json(['Service Saved Successsfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
         if(! $booking) {
           throw new NotFoundHttpException('Booking does not exist');
        }

         return response()->json($booking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
         $validator = Validator::make($request->all(), [
            'service_id' => 'required',    
        ]);

        if($validator->fails()) {
            return response()->json('Validator Fails');
        }

        $booking->user_id = Auth::id();
        $booking->service_id = $service->id;
        $booking->time = Carbon::now();
        $booking->update();

        return response()->json(['Service Saved Successsfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
         if(! $booking) {
           throw new NotFoundHttpException('Service does not exist');
        }

        try {
            $booking->delete();

            return response()->json([
                'id' => $bokings->id,
                'message' => 'Service delete Successfully'
            ]);
        } catch (HttpException $th) {
            throw $th;
        }
    }
}
