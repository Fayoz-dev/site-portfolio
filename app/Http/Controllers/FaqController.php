<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
 * @OA\Get(
 * path="/api/faq",
 * summary="all faq",
 * description="Faqs",
 * security={{ "api": {} }},
 * operationId="index_3",
 * tags={"Faq"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="question", type="string", example="name"),
 *       @OA\Property(property="answer", type="string", example="name"),
 *      
 *        )
 *     )
 * ),
 **/
    public function index()
    {
        $faq = Faq::all();
        return FaqResource::collection($faq);
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
     * path="/api/faq",
     * summary="faq a new data",
     * description="new faq",
     * tags={"Faq"},
     * security={{ "api": {} }},
     * 
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="new faq",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"question","answer"},
     *   @OA\Property(property="question", type="string", example="question"),
     *   @OA\Property(property="answer", type="string", example="answer"),
    
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
            'question' => ['required'],
            'answer' => ['required'],
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return response()->json(new FaqResource($faq),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/api/faq/{faq}",
     *      tags={"Faq"},
     *      summary="faq",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="faq",
     *          description="faq id",
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
        $faq = Faq::find($id);

        if($faq){

            return response()->json(new FaqResource($faq),200);
        }

        return response()->json("Not found faq !",404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */

      /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/faq/{faq}",
     * summary="faq a new data",
     * description="update faq data",
     * security={{ "api": {} }},
     * tags={"Faq"},
     * 
     * * *@OA\Parameter(name="faq", 
     *        in="path", 
     *        description="Id of user", 
     *        required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass client credentials",
     *    @OA\JsonContent(
     *   required={"question","answer"},
     *   @OA\Property(property="question", type="string", example="name"),
     *   @OA\Property(property="answer", type="string", example="name"),
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
    public function update(Request $request, $id)
    {
        $faq = Faq::find($id);

        if($faq){
            $request->validate([

                'question' => ['required'],
                'answer' => ['required'],

            ]);

            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return response()->json(new FaqResource($faq),200);
        }

        return response()->json("Not update for faq",404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Delete(
     *      path="/api/faq/{faq}",
     *      
     *      tags={"Faq"},
     *      summary="Delete existing category",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="faq",
     *          description="faq id",
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
        $faq = Faq::find($id);
        if($faq){
            $faq->delete();

            $data = [
                "success" => true,
                "message" => "Deleted successfully"
            ];
            return response()->json($data);
        }
    }
}
