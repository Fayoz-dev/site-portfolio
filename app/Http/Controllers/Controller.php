<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/** @OA\Info(
 *    title="Portfolio",
 *    version="1.0.0",
 * )
 * 
 * * @OA\SecurityScheme(
     *     type="http",
     *     description="Login with email and password to get the authentication token",
     *     name="Token based Based",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="api",
     * ),
     * 
     * *  @OA\Tag(
     * name="Authorization",
     *  description="auth",)
     * 
     * *  @OA\Tag(
     * name="User",
     *  description="user_crud",)
     * 
     **@OA\Tag(
     * name="Client",
     *  description="client_crud",)
     * 
     * *@OA\Tag(
     * name="Portfolio_Category",
     *  description="portfolio_category_crud",)
     * 
     * *@OA\Tag(
     * name="Portfolio",
     *  description="portfolio_edit",)
     * 
     * *@OA\Tag(
     * name="Lead_Category",
     *  description="lead_category_crud",)
     * 
     * *@OA\Tag(
     * name="Faq",
     *  description="faq_crud",)
     * 
     **@OA\Tag(
     * name="Feedback",
     *  description="feedback_crud",)
     * 
     * *@OA\Tag(
     * name="Image_file",
     *  description="image_file_crud",)
     * 
     * *@OA\Tag(
     * name="Portfolio_Join_Image_File",
     *  description="Portfolio_Join_Image_File_crud",)
     * 
     * *@OA\Tag(
     * name="Team member",
     *  description="team_member_crud",)
     * 
     * *@OA\Tag(
     * name="Lead",
     *  description="lead_crud",)
     */



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
