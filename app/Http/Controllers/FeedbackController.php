<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

/**
 * @OA\Get(
 * path="/api/feedback",
 * summary="all feedback",
 * description="Feedback",
 * security={{ "api": {} }},
 * operationId="index_4",
 * tags={"Feedback"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="name"),
 *       @OA\Property(property="surname", type="string", example="surname"),
 *       @OA\Property(property="position", type="string", example="position"),
 *       @OA\Property(property="comment", type="string", example="comment"),
 *       @OA\Property(property="rating_double", type="integer", example="5"),
 *      
 *        )
 *     )
 * ),
 **/
    public function index()
    {
        $feedback = Feedback::all();
        return FeedbackResource::collection($feedback);
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

     /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Post(
     * path="/api/feedback",
     * summary="feedback a new data",
     * description="new feedback",
     * tags={"Feedback"},
     * security={{ "api": {} }},
     * 
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="Feedback",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"name","surname","position","comment","rating_double"},
     *   @OA\Property(property="name", type="string", example="name"),
     *   @OA\Property(property="surname", type="string", example="surname"),
     *   @OA\Property(property="position", type="string", example="position"),
     *   @OA\Property(property="comment", type="string", example="comment"),
 *       @OA\Property(property="rating_double", type="integer", example="5"),
     *   
    
     *    ),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="The given data was invalid.")
     *        )
     *     ),
     *    @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *            @OA\MediaType(
     *             mediaType="application/json",
     *         ),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([

            'name'=>['required'],
            'surname'=>['required'],
            'position'=>['required'],
            'comment'=>['required'],

        ]);

        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->surname = $request->surname;
        $feedback->position = $request->position;
        $feedback->comment = $request->comment;
        $feedback->save();

        return response()->json(new FeedbackResource($feedback),200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/feedback/{feedback}",
     *      tags={"Feedback"},
     *      summary="feedback",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="feedback",
     *          description="feedback id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * ),
     */

    public function show($id)
    {
        $feedback = Feedback::find($id);
        if($feedback){
            return response()->json(new FeedbackResource($feedback),200);
        }

        return response()->json("Not feedback!",404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */

     /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/feedback/{feedback}",
     * summary="feedback a new data",
     * description="update feedback data",
     * security={{ "api": {} }},
     * tags={"Feedback"},
     * 
     * * *@OA\Parameter(name="feedback", 
     *        in="path", 
     *        description="Id of feedback", 
     *        required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass client credentials",
     *    @OA\JsonContent(
     *   required={"name","surname","position","comment","rating_update"},
     *   @OA\Property(property="name", type="string", example="name"),
     *   @OA\Property(property="surname", type="string", example="surname"),
     *   @OA\Property(property="position", type="string", example="position"),
     *   @OA\Property(property="comment", type="string", example="comment"),
 *       @OA\Property(property="rating_double", type="integer", example="5"),
     *   
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="The given data was invalid.")
     *        )
     *     ),
     *    @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *            @OA\MediaType(
     *             mediaType="application/json",
     *         ),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function update(Request $request,$id)
    {
        $feedback = Feedback::find($id);

        if($feedback){
            $request->validate([
                'name' => ['required'],
                'surname' => ['required'],
                'position' => ['required'],
                'comment' => ['required'],

            ]);

            
            $feedback->name = $request->name;
            $feedback->surname = $request->surname;
            $feedback->position = $request->position;
            $feedback->comment = $request->comment;
            $feedback->save();

            return response()->json(new FeedbackResource($feedback),200);
        }

        return response()->json("Not feedback for update !",404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     *      path="/api/feedback/{feedback}",
     *      
     *      tags={"Feedback"},
     *      summary="Delete existing feedback",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="feedback",
     *          description="feedback id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        if($feedback){
                 
            $feedback->delete();

            $data = [
                "success" => true,
                "message" =>"deleted succefuly"
            ];

            return response()->json($data);

        }
    }

}