<?php

namespace App\Http\Controllers;

use App\Http\Resources\PortfolioCategoryResource;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 /**
 * @OA\Get(
 * path="/api/portfolio_category",
 * summary="all category",
 * description="Portfolio Category",
 * security={{ "api": {} }},
 * operationId="index_1",
 * tags={"Portfolio_Category"},
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
       $pc = PortfolioCategory::all();

       return PortfolioCategoryResource::collection($pc);
        
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
     * path="/api/portfolio_category",
     * summary="Client a new data",
     * description="new Category",
     * tags={"Portfolio_Category"},
     * security={{ "api": {} }},
     * 
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="Portfolio Category",
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
            'name' => ['required'],
        ]);

        $pc = new PortfolioCategory();

        $pc->name = $request->name;
        $pc->save();

        return response()->json(new PortfolioCategoryResource($pc),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PortfolioCategory  $portfolioCategory
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/portfolio_category/{portfolio_category}",
     *      tags={"Portfolio_Category"},
     *      summary="portfolio_category",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="portfolio_category",
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
        $pc = PortfolioCategory::find($id);

        if($pc){

            return response()->json(new PortfolioCategoryResource($pc),200);
        }

        return response()->json("Category NOt found!",404);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PortfolioCategory  $portfolioCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PortfolioCategory $portfolioCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PortfolioCategory  $portfolioCategory
     * @return \Illuminate\Http\Response
     */

     /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/portfolio_category/{portfolio_category}",
     * summary="Category a new data",
     * description="update category data",
     * security={{ "api": {} }},
     * tags={"Portfolio_Category"},
     * 
     * * *@OA\Parameter(name="portfolio_category", 
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
        $pc = PortfolioCategory::find($id);

        if($pc){

            $request->validate([

                'name' => ['required'],

            ]);

            $pc->name = $request->name;
            $pc->save();

            return response()->json(new PortfolioCategoryResource($pc),200);

        }

        return response()->json("Not Portfolio_Category for update",404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PortfolioCategory  $portfolioCategory
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Delete(
     *      path="/api/portfolio_category/{portfolio_category}",
     *      
     *      tags={"Portfolio_Category"},
     *      summary="Delete existing category",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="portfolio_category",
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
        $pc = PortfolioCategory::find($id);
        if($pc){
            $pc->delete();

            return response()->json("Deleted Success !",200);
        }
    }
}
