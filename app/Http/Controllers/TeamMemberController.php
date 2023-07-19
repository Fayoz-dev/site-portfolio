<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamMemberResource;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use PHPUnit\Util\Log\TeamCity;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
 * @OA\Get(
 * path="/api/team_member",
 * summary="all team_member",
 * description="team_member",
 * security={{ "api": {} }},
 * operationId="team_member",
 * tags={"Team member"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="name"),
 *       @OA\Property(property="surname", type="string", example="surname"),
 *       @OA\Property(property="image", type="string", example="image"),
 *       @OA\Property(property="position", type="string", example="position"),
 *       
 *        )
 *     )
 * ),
 **/
    public function index()
    {
        $team = TeamMember::all();
        return TeamMemberResource::collection($team);
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
     * path="/api/team_member",
     * summary="team_member a new data",
     * description="team_member new organization",
     * tags={"Team member"},
     * security={{ "api": {} }},
     * 
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="Team member",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"name","surname","image","position"},
     *  @OA\Property(property="name", type="string", example="name"),
 *       @OA\Property(property="surname", type="string", example="surname"),
 *       @OA\Property(property="image", type="string", example="image"),
 *       @OA\Property(property="position", type="string", example="position"),
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
            'image' => ['required'],
            'position' => ['required']

        ]);

        $team = new TeamMember();
        $team -> name = $request -> name;
        $team ->surname = $request -> surname;
        $team -> image = $request -> image;
        $team -> position = $request -> position;
        $team -> save();

        return response()->json(new TeamMemberResource($team),200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */

       
    /**
     * @OA\Get(
     *      path="/api/team_member/{team_member}",
     *      tags={"Team member"},
     *      summary="team member",
     *      description="team_member_crud",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="team_member",
     *          description="team_member id",
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
        $team = TeamMember::find($id);
        if($team){

            return response()->json(new TeamMemberResource($team),200);
        }

        return response()->json("Not member",404);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teamMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */

    /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/team_member/{team_member}",
     * summary="Team_member a new data",
     * description="Portfolio_Join_Image_File_crud",
     * security={{ "api": {} }},
     * tags={"Team member"},
     * 
     * * *@OA\Parameter(name="team_member", in="path", description="Id of user", required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass category   credentials",
     *    @OA\JsonContent(
     *    required={"name","surname","image","position"},
     *    @OA\Property(property="name", type="string", example="name"),
 *       @OA\Property(property="surname", type="string", example="surname"),
 *       @OA\Property(property="image", type="string", example="image"),
 *       @OA\Property(property="position", type="string", example="position"),
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
        $team = TeamMember::find($id);
        if($team)
        {
            $request -> validate([

                'name' => ['required'],
                'surname' => ['required'],
                'image' => ['required'],
                'position' => ['required'],

            ]);

            $team -> name = $request -> name;
            $team -> surname = $request -> surname;
            $team -> image = $request -> image;
            $team -> position = $request ->position;
            $team -> save();
            
            return response()->json(new TeamMemberResource($team),200);
        }

        return response()->json("Not member for update",404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Delete(
     *      path="/api/team_member/{team_member}",
     *      
     *      tags={"Team member"},
     *      summary="Delete existing project",
     *      description="Portfolio_Join_Image_File_crud",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="team_member",
     *          description="team_member id",
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
        $team = TeamMember::find($id);
        if($team){

            $team -> delete();

            $data = [
                "success" => true,
                "message" => "deleted success"
            ];

            return response()->json($data,200);

        }
    }
}
