<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Models\Business;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $businesses = Business::paginate(5);

        return response()->json($businesses);
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
            'name' => 'required|string|min:3|max:15|unique:businesses,name',
            'open_hours' => 'required|string',
            'status' => 'required',    
        ]);

        if($validator->fails()) {
            return response()->json('Validator Fails');
        }

        $business = new Business;
        $business->user_id = Auth::id();
        $business->name = $request->name;
        $business->open_hours = $request->open_hours;
        $business->status = $request->status;
        $business->save();

        return response()->json(['Business Saved Successsfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
       if(! $business) {
            throw new NotFoundHttpException('Business does not exist');   
        }

        return response()->json($business);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {

        if(! $business) {
            throw new NotFoundHttpException('Business does not exist');   
        }

        if(! empty($request->name)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:3|max:15|unique:businesses,name'
            ]);
           
            if($validator->fails()) {
                return response()->json('name is empty', 400);
            };

            $business->name = $request->name;
        }

        if(! empty($request->opening_hours)) {
            $validator = Validator::make($request->all(), [
                'opening_hours' => 'required|string',
            ]);

            if($validator->fails()) {
                return response()->json('Opening hourss is empty', 400);
            };

            $business->opening_hours = $request->opening_hours;
        }

         if(! empty($request->status)) {
            $validator = Validator::make($request->all(), [
                'status' => 'required|boolean',
            ]);

            if($validator->fails()) {
                return response()->json('staus is empty', 400);
            };

            $business->status = $request->status;
        }


        if($business->isDirty()) {
            $business->save();

            return response()->json([
                'id' => $business->id,
                'message' => 'business updated successfully'
            ]);
        }

        return response()->json(['Nothing to Update '], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        if(! $business) {
           throw new NotFoundHttpException('business does not exist');
        }

        try {
            $business->delete();

            return response()->json([
                'id' => $business->id,
                'message' => 'Store delete Successfully'
            ]);
        } catch (HttpException $th) {
            throw $th;
        }
    
    }
}
