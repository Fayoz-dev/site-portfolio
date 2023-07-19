<?php

namespace App\Http\Controllers;

use App\Http\Resources\LeadCategoryResource;
use App\Models\LeadCategory;
use Illuminate\Http\Request;

class LeadCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
 * @OA\Get(
 * path="/api/lead_category",
 * summary="all category",
 * description="Lead Category",
 * security={{ "api": {} }},
 * operationId="index_2",
 * tags={"Lead_Category"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="name"),
 *      
 *        )
 *     )
 * ),
 **/
    public function index()
    {
        $leadCategory = LeadCategory::all();
        return LeadCategoryResource::collection($leadCategory);
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
     * path="/api/lead_category",
     * summary="category a new data",
     * description="new Category",
     * tags={"Lead_Category"},
     * security={{ "api": {} }},
     * 
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="Lead Category",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"name"},
     *   @OA\Property(property="name", type="string", example="name"),
    
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
        ]);

        $category = new LeadCategory();
        $category->name = $request->name;
        $category->save();

        return response()->json(new LeadCategoryResource($category),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeadCategory  $leadCategory
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     *      path="/api/lead_category/{lead_category}",
     *      tags={"Lead_Category"},
     *      summary="id",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="lead_category",
     *          description="category id",
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
        $category = LeadCategory::find($id);
        if($category){
            return response()->json(new LeadCategoryResource($category),200);
        }

        return response()->json("Not found LeadCatedory !",404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeadCategory  $leadCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadCategory $leadCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeadCategory  $leadCategory
     * @return \Illuminate\Http\Response
     */

      /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/lead_category/{lead_category}",
     * summary="Category a new data",
     * description="update category data",
     * security={{ "api": {} }},
     * tags={"Lead_Category"},
     * 
     * * *@OA\Parameter(name="lead_category", 
     *        in="path", 
     *        description="Id of user", 
     *        required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass client credentials",
     *    @OA\JsonContent(
     *   required={"name"},
     *   @OA\Property(property="name", type="string", example="name"),
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
        $category = LeadCategory::find($id);

        if($category){
            $request->validate([
                'name' => ['required'],
            ]);

            $category->name = $request->name;
            $category->save();
            return response()->json(new LeadCategoryResource($category),200);
        }

        return response()->json("not category for update ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeadCategory  $leadCategory
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Delete(
     *      path="/api/lead_category/{lead_category}",
     *      
     *      tags={"Lead_Category"},
     *      summary="Delete existing category",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="lead_category",
     *          description="category id",
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
        $category = LeadCategory::find($id);
        if($category){
            $category->delete();

            return response()->json("deleted success",200);
        }
    }
}
