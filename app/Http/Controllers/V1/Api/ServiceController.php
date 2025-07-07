<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Business;
use Illuminate\Http\Exceptions\HttpResponseException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = Business::where('user_id', Auth::id())->first();
        $services = Service::where('business_id', $business->id)->paginate(5);

        return response()->json($services);
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
            'name' => 'required|string|min:3|max:15|unique:services,name',
            'description' => 'required',
            'price' => 'required',    
        ]);

        if($validator->fails()) {
            return response()->json('Validator Fails');
        }

        $business = Business::where('id', Auth::id())->first();
        $service = new Service;
        $service->business_id = $business->id;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();

        return response()->json(['Service Saved Successsfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
         if(! $service) {
           throw new NotFoundHttpException('Service does not exist');
        }

         return response()->json($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
         if(!$service) {
            throw new NotFoundHttpException('Service is Empty');
        }

           $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:15|unique:services,name',
            'description' => 'required',
            'price' => 'required',    
        ]);

        if($validator->fails()) {
            return response()->json('Validator Fails');
        }

       // $business = Business::where('id', Auth::id())->first();
        $service->business_id = $request->business_id;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->update();

        return response()->json([
            'status' => 'success',
            'message' => 'Service Updated Successfully',
            'service' => $service
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if(! $service) {
           throw new NotFoundHttpException('Service does not exist');
        }

        try {
            $service->delete();

            return response()->json([
                'id' => $service->id,
                'message' => 'Service delete Successfully'
            ]);
        } catch (HttpException $th) {
            throw $th;
        }
    }
}
