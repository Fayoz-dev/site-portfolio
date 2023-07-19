<?php

namespace App\Http\Controllers;

use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/**
 * @OA\Get(
 * path="/api/portfolio",
 * summary="all portfolio",
 * description="Portfolio",
 * security={{ "api": {} }},
 * operationId="index_portfolio",
 * tags={"Portfolio"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="title", type="string", example="title"),
 *       @OA\Property(property="category_id", type="integer", example="1"),
 *       @OA\Property(property="client_id", type="integer", example="1"),
 *       @OA\Property(property="image", type="string", format="binary" ,example="image"),
 *       @OA\Property(property="video", type="string", format="binary" ,example="video"),
 *       @OA\Property(property="published_date", type="date", example="Y-m-d"),
 *       @OA\Property(property="description", type="string", example="description"),
 *        )
 *     )
 * ),
 **/
    public function index()
    {
        $portfolio = Portfolio::all();

        return PortfolioResource::collection($portfolio);
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
     * path="/api/portfolio",
     * summary="portfolio a new data",
     * description="Portfolio new organization",
     * tags={"Portfolio"},
     * security={{ "api": {} }},
     * 
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="Portfolio",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"title","category_id","client_id","image","video","published_date","description"},
     *    
     *       @OA\Property(property="title", type="string", example="title"),
     *       @OA\Property(property="category_id", type="string", example="category_id"),
     *       @OA\Property(property="client_id", type="string", example="client_id"),
     *       @OA\Property(property="image", type="string", example="image"),
     *       @OA\Property(property="video", type="string", example="video"),
     *       @OA\Property(property="published_date", type="date", example="Y-m-d"),
     *       @OA\Property(property="description", type="string", example="description"),
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

            'title' => ['required'],
            'category_id' => ['required'],
            'client_id' => ['required'],
            'image' => ['required'],
            'video' => ['required'],
            'published_date' => ['required'],
            'description' => ['required'],



        ]);

        $portfolio = new Portfolio();
        $portfolio -> title = $request -> title;
        $portfolio -> category_id = $request -> category_id;
        $portfolio -> client_id = $request -> client_id;
        $portfolio -> image = $request -> image;
        $portfolio -> video = $request -> video;
        $portfolio -> published_date = $request -> published_date;
        $portfolio -> description = $request -> description;
        $portfolio -> save();

        return response()->json(new PortfolioResource($portfolio),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/portfolio/{portfolio}",
     *      tags={"Portfolio"},
     *      summary="portfolio",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="portfolio",
     *          description="portfolio id",
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
        $portfolio = Portfolio::find($id);

        if($portfolio){

            return response()->json(new PortfolioResource($portfolio),200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */

     /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/portfolio/{portfolio}",
     * summary="portfolio a new data",
     * description="update portoflio data",
     * security={{ "api": {} }},
     * tags={"Portfolio"},
     * 
     * * *@OA\Parameter(name="portfolio", in="path", description="Id of user", required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass category   credentials",
     *    @OA\JsonContent(
     *   required={"title","category_id","client_id","image","video","published_date","description"},
     *    @OA\Property(property="title", type="string", example="title"),
     *       @OA\Property(property="category_id", type="string", example="category_id"),
     *       @OA\Property(property="client_id", type="string", example="client_id"),
     *       @OA\Property(property="image", type="string", example="image"),
     *       @OA\Property(property="video", type="string", example="video"),
     *       @OA\Property(property="published_date", type="date", example="Y-m-d"),
     *       @OA\Property(property="description", type="string", example="description"),
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
        $portfolio = Portfolio::find($id);
        if($portfolio){
            $request->validate([

                'title' => ['required'],
                'category_id' => ['required'],
                'client_id' => ['required'],
                'image' => ['required'],
                'video' => ['required'],
                'published_date' => ['required'],
                'description' => ['required'],

            ]);

            $portfolio -> title = $request -> title;
            $portfolio -> category_id = $request -> category_id;
            $portfolio -> client_id = $request -> client_id;
            $portfolio -> image = $request -> image;
            $portfolio -> video = $request -> video;
            $portfolio -> published_date = $request -> published_date;
            $portfolio -> description = $request -> description;
            $portfolio -> save();

            return response()->json(new PortfolioResource($portfolio),200);
        }

        return response()->json("Not portfolio for update",404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Delete(
     *      path="/api/portfolio/{portfolio}",
     *      
     *      tags={"Portfolio"},
     *      summary="Delete existing project",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="portfolio",
     *          description="portfolio id",
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
        $portfolio = Portfolio::find($id);

        if($portfolio){

            $portfolio -> delete();

            $date = [
                "success" => true,
                "message" => "deleted success"
            ];

            return response()->json($date,200);

    
        }
    
    }

}
