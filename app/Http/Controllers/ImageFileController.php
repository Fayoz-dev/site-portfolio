<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageFileResource;
use App\Models\ImageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
 * @OA\Get(
 * path="/api/image_file",
 * summary="all image_file",
 * description="image_file",
 * security={{ "api": {} }},
 * operationId="index_5",
 * tags={"Image_file"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="name"),
 *       @OA\Property(property="file_url", type="string", example="url"),
 *
 *      )
 *     )
 * ),
 **/
    public function index()
    {
        $file = ImageFile::all();

        return ImageFileResource::collection($file);

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
     * path="/api/image_file",
     * summary="image_file a new data",
     * description="new image_file",
     * tags={"Image_file"},
     * security={{ "api": {} }},
     *
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="new image_file",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"name","file_url"},
     *   @OA\Property(property="name", type="string", example="name"),
     *   @OA\Property(property="file_url", type="string", format="binary"),
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
        $rules = [

            'name' => ['required'],
            'file_url' => ['required'],

        ];
        $validate = Validator::make($request->all(),$rules);
        if($validate->fails()){
            return response()->json($validate->messages(),400);
        }

        unlink('link');
        $image = $request->file('file_url');
        $new_name = time() . "_" . str_replace([" ", " "," "], ["", '', ''], $image->getClientOriginalName());
        $image->move(public_path("uploads/image/"), $new_name);
        $image = asset("uploads/image/$new_name");

        $file = new ImageFile();
        $file -> name = $request->name;
        $file -> file_url = $image;
        $file->save();


        // $data = [
        //     "success" => true,
        //     "message" => "created successfully"
        // ];
            // return 11;
        return response()->json(new ImageFileResource($file),200);

     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImageFile  $imageFile
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     *      path="/api/image_file/{image_file}",
     *      tags={"Image_file"},
     *      summary="image_file",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="image_file",
     *          description="image_file id",
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
        $file = ImageFile::find($id);


        if($file){

            return response()->json(new ImageFileResource($file),200);
        }

        return response()->json("Not image_file ",404);


    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImageFile  $imageFile
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageFile $imageFile)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImageFile  $imageFile
     * @return \Illuminate\Http\Response
     */

     /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/image_file/{image_file}",
     * summary="image_file a new data",
     * description="update image_file data",
     * security={{ "api": {} }},
     * tags={"Image_file"},
     *
     * * *@OA\Parameter(name="image_file",
     *        in="path",
     *        description="Id of image_file",
     *        required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass image_file credentials",
     *    @OA\JsonContent(
     *   required={"name","file_url"},
     *   @OA\Property(property="name", type="string", example="name"),
     *   @OA\Property(property="file_url", type="string", example="url"),
     *
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
        $file = ImageFile::find($id);
        if($file){
            $request->validate([

                'name' => ['required'],
                'file_url' => ['required'],


            ]);


            $file->name = $request->name;
            $file->file_url = $request->file_url;
            $file->save();

            return response()->json(new ImageFileResource($file),200);
        }

        return response()->json("Not imagefile for updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageFile  $imageFile
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Delete(
     *      path="/api/image_file/{image_file}",
     *
     *      tags={"Image_file"},
     *      summary="Delete existing feedback",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="image_file1",
     *          description="image_file id",
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
        $file = ImageFile::find($id);
        if($file){
            $file->delete();

            $data = [
                "success" => true,
                "message" => "Deleted Succefully"
            ];

            return response()->json($data);

        }
    }
}
