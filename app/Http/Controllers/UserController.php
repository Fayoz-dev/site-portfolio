<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public $dataError = [
        "data" => null,
        "error" => "District not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "District deleted successfully !",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

/**
 * @OA\Get(
 * path="/api/user",
 * summary="all user",
 * description="User",
 * security={{ "api": {} }},
 * operationId="index_user",
 * tags={"User"},
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
 *       @OA\Property(property="user_status", type="string", example="admin"),
 *        )
 *     )
 * ),
 **/

    public function index()
    {
        $user = User::all();
        return UserResource::collection($user);
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
     * path="/api/user",
     * summary="Post a new data",
     * description="Post new organization",
     * tags={"User"},
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
     *       required={"name","surname","email","password","phone","user_status"},
     *   @OA\Property(property="name", type="string", example="name"),
     *   @OA\Property(property="surname", type="string", example="surname"),
     *   @OA\Property(property="email", type="string", example="a@a.com"),
     *   @OA\Property(property="password", type="string", example="123456"),
     *   @OA\Property(property="phone", type="string", example="12345678"),
     *   @OA\Property(property="user_status", type="string", example="admin"),
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

        $request -> validate([

            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['email','unique:users,email'],
            'password' => ['required'],
            'phone' => ['required'],
            'user_status' => ['required'],

        ]);

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password =Hash::make($request->password);
        $user->phone = $request->phone;
        $user->user_status = $request->user_status;
        $user->save();

        return response()->json(new UserResource($user),200);

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    /**
     * @OA\Get(
     *      path="/api/user/{user}",
     *      tags={"User"},
     *      summary="user",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="user",
     *          description="user id",
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
        $user = User::find($id);
        if($user){

            return response()->json(new UserResource($user),200);
           }

           return response()->json("Not found user !",404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/user/{user}",
     * summary="Post a new data",
     * description="update user data",
     * security={{ "api": {} }},
     * tags={"User"},
     * 
     * * *@OA\Parameter(name="user", in="path", description="Id of user", required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass category   credentials",
     *    @OA\JsonContent(
     *   required={"name","surname","email","password","phone","user_status"},
     *   @OA\Property(property="name", type="string", example="name"),
     *   @OA\Property(property="surname", type="string", example="surname"),
     *   @OA\Property(property="email", type="string", example="a@a.com"),
     *   @OA\Property(property="password", type="string", example="123456"),
     *   @OA\Property(property="phone", type="string", example="12345678"),
     *   @OA\Property(property="user_status", type="string", example="admin"),
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
        $user = User::find($id);

        if($user){

            $request->validate([

                'name' => ['required'],
                'surname' => ['required'],
                'email' => ['email','unique:users,email'],
                'password' => ['required'],
                'phone' => ['required'],
                'user_status' => ['required'],

            ]);

            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password =Hash::make($request->password);
            $user->phone = $request->phone;
            $user->user_status = $request->user_status;
            $user->save();

            return response()->json(new UserResource($user),200);
        }

        return response()->json("Not user for update",404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     *      path="/api/user/{user}",
     *      
     *      tags={"User"},
     *      summary="Delete existing project",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="user",
     *          description="User id",
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
        $user = User::find($id);

        if($user){

            $user->delete();

            return response()->json("deleted success !");
        }
    }
}
