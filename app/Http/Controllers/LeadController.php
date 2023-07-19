<?php

namespace App\Http\Controllers;

use App\Http\Resources\LeadResource;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      /**
 * @OA\Get(
 * path="/api/lead",
 * summary="all lead",
 * description="Lead",
 * security={{ "api": {} }},
 * operationId="index_lead",
 * tags={"Lead"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="name"),
 *       @OA\Property(property="surname", type="string", example="surname"),
 *       @OA\Property(property="email", type="string", example="a@a.com"),
 *       @OA\Property(property="phone", type="string", example="914431063"),
 *       @OA\Property(property="lead_category_id", type="string", example="1"),
 *        )
 *     )
 * ),
 **/
    public function index()
    {
        $lead = Lead::all();

        return LeadResource::collection($lead);
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
     * path="/api/lead",
     * summary="lead a new data",
     * description="new lead",
     * tags={"Lead"},
     * security={{ "api": {} }},
     * 
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="lead",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"name","surname","email","phone","lead_category_id"},
     *   @OA\Property(property="name", type="string", example="name"),
     *   @OA\Property(property="surname", type="string", example="surname"),
 *       @OA\Property(property="email", type="string", example="a@a.com"),
 *       @OA\Property(property="phone", type="string", example="914431063"),
 *       @OA\Property(property="lead_category_id", type="string", example="1"),
    
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
        $request -> validate([

            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['email','unique:leads,email'],
            'phone' => ['required'],
            'lead_category_id' => ['required'],

        ]);

        $lead = new Lead();
        $lead -> name = $request -> name;
        $lead -> surname = $request-> surname;
        $lead -> email = $request -> email;
        $lead -> phone = $request -> phone;
        $lead -> lead_category_id = $request -> lead_category_id;
        $lead -> save();

        return response()->json(new LeadResource($lead),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     *      path="/api/lead/{lead}",
     *      tags={"Lead"},
     *      summary="lead",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="lead",
     *          description="lead id",
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
        $lead = Lead::find($id);

        if($lead){
            return response()->json(new LeadResource($lead),200);
        }

        return response()->json("Lead not found !",404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */

      /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/lead/{lead}",
     * summary="lead a new data",
     * description="update lead data",
     * security={{ "api": {} }},
     * tags={"Lead"},
     * 
     * * *@OA\Parameter(name="lead", 
     *        in="path", 
     *        description="Id of lead", 
     *        required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass client credentials",
     *    @OA\JsonContent(
     *   required={"name","surname","email","phone","lead_category_id"},
     *   @OA\Property(property="name", type="string", example="name"),
     *   @OA\Property(property="surname", type="string", example="surname"),
 *       @OA\Property(property="email", type="string", example="a@a.com"),
 *       @OA\Property(property="phone", type="string", example="914431063"),
 *       @OA\Property(property="lead_category_id", type="string", example="1"),
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
        $lead = Lead::find($id);

        if($lead){

            $request -> validate([

                'name' => ['required'],
                'surname' => ['required'],
                'email' => ['email'],
                'phone' => ['required'],
                'lead_category_id' => ['required'],
                

            ]);

            
            $lead->name = $request->name;
            $lead->surname = $request->surname;
            $lead->email = $request->email;
            $lead->phone = $request->phone;
            $lead->lead_category_id = $request->lead_category_id;
            $lead->save();

            return response()->json(new LeadResource($lead),200);
        }

        return response()->json("Not lead for update",404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     *      path="/api/lead/{lead}",
     *      
     *      tags={"Lead"},
     *      summary="Delete existing category",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="lead",
     *          description="lead id",
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
        $lead = Lead::find($id);

        if($lead){

            $lead->delete();

            $data = [

                "success" => true,
                "message" => "deleted success"


            ];

            return response()->json($data,200);

        }


        
    }
}
