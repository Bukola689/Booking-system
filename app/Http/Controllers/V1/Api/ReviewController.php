<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Exceptions\HttpResponseException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $reviews = Review::where('id', 'desc')->paginate(5);

       return response()->json($reviews);
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function business_review($id)
    {
       $reviews = Review::where('business_id', $id)->paginate(5);

       return response()->json($reviews);
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
            'review' => 'required',
            'stars' => 'required',
            'business_id' => 'required',    
        ]);

        if($validator->fails()) {
            return response()->json('Validator Fails');
        }

        $review = new Review;
        $review->user_id = Auth::id();
        $review->business_id = $business->id;
        $review->review = $request->review;
        $review->stars = $request->stars;
        $review->save();

        return response()->json(['Review Saved Successsfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
         if(! $review) {
           throw new NotFoundHttpException('Review does not exist');
        }

         return response()->json($review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
         $validator = Validator::make($request->all(), [
            'review' => 'required',
            'stars' => 'required',
            'business_id' => 'required',    
        ]);

        if($validator->fails()) {
            return response()->json('Validator Fails');
        }

        $review->user_id = Auth::id();
        $review->business_id = $business->id;
        $review->review = $request->review;
        $review->stars = $request->stars;
        $review->update();

        return response()->json(['Review Saved Successsfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
                if(! $review) {
           throw new NotFoundHttpException('Review does not exist');
        }

        try {
            $review->delete();

            return response()->json([
                'id' => $business->id,
                'message' => 'Review delete Successfully'
            ]);
        } catch (HttpException $th) {
            throw $th;
        }
    }
}
