<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
 * @OA\Get(
 * path="/api/client",
 * summary="all client",
 * description="Client",
 * security={{ "api": {} }},
 * operationId="index_client",
 * tags={"Client"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="name"),
 *       @OA\Property(property="surname", type="string", example="surname"),
 *       @OA\Property(property="email", type="string", example="a@a.com"),
 *       @OA\Property(property="password", type="string", example="123456"),
 *       @OA\Property(property="phone", type="string", example="914431063"),
 *       @OA\Property(property="notes", type="string", example="notes"),
 *        )
 *     )
 * ),
 **/
    public function index()
    {
        $client = Client::all();
        return ClientResource::collection($client);
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
     * path="/api/client",
     * summary="Client a new data",
     * description="new client",
     * tags={"Client"},
     * security={{ "api": {} }},
     * 
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="User",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"name","surname","email","password","phone","notes"},
     *   @OA\Property(property="name", type="string", example="name"),
     *   @OA\Property(property="surname", type="string", example="surname"),
     *   @OA\Property(property="email", type="string", example="a@a.com"),
     *   @OA\Property(property="password", type="string", example="123456"),
     *   @OA\Property(property="phone", type="string", example="12345678"),
     *   @OA\Property(property="notes", type="string", example="notes"),
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
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['email','unique:clients,email'],
            'password' => ['required'],
            'phone' => ['required'],
            'notes' => ['required'],
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->email = $request->email;
        $client->password = Hash::make($request->password);
        $client->phone = $request->phone;
        $client->notes = $request->notes;
        $client->save();

        return response()->json(new ClientResource($client),200);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/client/{client}",
     *      tags={"Client"},
     *      summary="client",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="client",
     *          description="client id",
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
        $client = Client::find($id);
        if($client){
            return response()->json(new ClientResource($client),200);

        }

        return response()->json("Client not found !",404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/client/{client}",
     * summary="Client a new data",
     * description="update client data",
     * security={{ "api": {} }},
     * tags={"Client"},
     * 
     * * *@OA\Parameter(name="client", 
     *        in="path", 
     *        description="Id of user", 
     *        required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass client credentials",
     *    @OA\JsonContent(
     *   required={"name","surname","email","password","phone","notes"},
     *   @OA\Property(property="name", type="string", example="name"),
     *   @OA\Property(property="surname", type="string", example="surname"),
     *   @OA\Property(property="email", type="string", example="a@a.com"),
     *   @OA\Property(property="password", type="string", example="123456"),
     *   @OA\Property(property="phone", type="string", example="12345678"),
     *   @OA\Property(property="notes", type="string", example="notes"),
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
        $client = Client::find($id);
        
        if($client){
            $request->validate([
                'name' => ['required'],
                'surname' => ['required'],
                'email' => ['email','unique:clients,email'],
                'password' => ['required'],
                'phone' => ['required'],
                'notes' => ['required'],
             ]);

             $client->name = $request->name;
             $client->surname = $request->surname;
             $client->email = $request->email;
             $client->password = Hash::make($request->password);
             $client->phone = $request->phone;
             $client->notes = $request->notes;
             $client->save();
             
             return response()->json(new ClientResource($client),200);

        }

        return response()->json("Not client for update",404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     *      path="/api/client/{client}",
     *      
     *      tags={"Client"},
     *      summary="Delete existing client",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="client",
     *          description="Client id",
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
        $client = Client::find($id);
        if($client){

            $client->delete();

            return response()->json("deleted success",200);
        }
    }
}
