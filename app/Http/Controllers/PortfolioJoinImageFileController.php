<?php

namespace App\Http\Controllers;

use App\Http\Resources\PortfolioJoinImageFileResource;
use App\Models\PortfolioJoinImageFile;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsUnprocessable;

class PortfolioJoinImageFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      /**
 * @OA\Get(
 * path="/api/portfolio_join_image_files",
 * summary="all joinfile",
 * description="portfolio_join_image_files",
 * security={{ "api": {} }},
 * operationId="index_file",
 * tags={"Portfolio_Join_Image_File"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="image_file_id", type="string", example="id"),
 *       @OA\Property(property="portfolio_id", type="string", example="id"),
 *       
 *        )
 *     )
 * ),
 **/
    public function index()
    {
        $join = PortfolioJoinImageFile::all();

        return PortfolioJoinImageFileResource::collection($join);
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
     * path="/api/portfolio_join_image_files",
     * summary="portfolio join image file a new data",
     * description="new join image file",
     * tags={"Portfolio_Join_Image_File"},
     * security={{ "api": {} }},
     * 
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="POrtfolio_Join_Image_File",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"image_file_id","portfolio_id"},
     *   @OA\Property(property="image_file_id", type="string", example="id"),
 *       @OA\Property(property="portfolio_id", type="string", example="id"),
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

            'image_file_id' => ['required'],
            'portfolio_id' => ['required'],

        ]);

        $join = new PortfolioJoinImageFile();
        $join -> image_file_id = $request -> image_file_id;
        $join -> portfolio_id = $request -> portfolio_id;
        $join -> save();

        return response()->json(new PortfolioJoinImageFileResource($join),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PortfolioJoinImageFile  $portfolioJoinImageFile
     * @return \Illuminate\Http\Response
     */

  
     /**
     * @OA\Get(
     *      path="/api/portfolio_join_image_files/{portfolio_join_image_file}",
     *      tags={"Portfolio_Join_Image_File"},
     *      summary="join image file",
     *      description="Returns file data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="portfolio_join_image_file",
     *          description="file id",
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
        $join = PortfolioJoinImageFile::find($id);
        if($join){

            return response()->json(new PortfolioJoinImageFileResource($join),200);

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PortfolioJoinImageFile  $portfolioJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function edit(PortfolioJoinImageFile $portfolioJoinImageFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PortfolioJoinImageFile  $portfolioJoinImageFile
     * @return \Illuminate\Http\Response
     */

     /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/portfolio_join_image_files/{portfolio_join_image_file}",
     * summary="image_file a new data",
     * description="Portfolio_Join_Image_File_crud",
     * security={{ "api": {} }},
     * tags={"Portfolio_Join_Image_File"},
     * 
     * * *@OA\Parameter(name="portfolio_join_image_file_id", in="path", description="Id of file", required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="portfolio join image file",
     *    @OA\JsonContent(
     *   required={"image_file_id","portfolio_id"},
     *   @OA\Property(property="image_file_id", type="string", example="1"),
 *       @OA\Property(property="portfolio_id", type="string", example="1"),
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
        $join = PortfolioJoinImageFile::find($id);
        if($join){

            $request -> validate([
                'image_file_id' => ['required'],
                'portfolio_id' => ['required'],
            ]);

            $join -> image_file_id = $request -> image_file_id;
            $join -> portfolio_id = $request -> portfolio_id;
            $join -> save();

            return response()->json(new PortfolioJoinImageFileResource($join),200);

        }

        return response()->json("not file for update !",404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PortfolioJoinImageFile  $portfolioJoinImageFile
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Delete(
     *      path="/api/portfolio_join_image_files/{portfolio_join_image_file}",
     *      
     *      tags={"Portfolio_Join_Image_File"},
     *      summary="Delete existing project",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="portfolio_join_image_file",
     *          description="File id",
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
        $join = PortfolioJoinImageFile::find($id);
        if($join){
            $join -> delete();

            $data = [
                "success" => true,
                "message" => "deleted success"
            ];

            return response()->json($data,200);
        }
    }
}
