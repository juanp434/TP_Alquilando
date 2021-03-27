<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\GetUserByIdRequest;
use App\Managers\UserManager;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['register', 'list', 'getById', 'edit', 'remove']]);
  }

  /**
   * Register an user
   * @OA\POST(
   *     path="/users/",
   *     tags={"Users"},
   *     summary="Register User",
   *     @OA\RequestBody(
   *         @OA\MediaType(
   *             mediaType="application/json",
   *             @OA\Schema(
   *                 @OA\Property(
   *                     property="name",
   *                     type="string",
   *                     description="the name"
   *                 ),
   *                 @OA\Property(
   *                     property="surname",
   *                     type="string",
   *                     description="the surname"
   *                 ),
   *                 @OA\Property(
   *                     property="user",
   *                     type="string",
   *                     description="the username"
   *                 ),
   *                 @OA\Property(
   *                     property="email",
   *                     type="string",
   *                     description="the email"
   *                 ),
   *                 @OA\Property(
   *                     property="password",
   *                     type="string",
   *                     description="the password"
   *                 ),
   *                 @OA\Property(
   *                     property="password_confirmation",
   *                     type="string",
   *                     description="the password confirmation"
   *                 ),
   *                example={"name": "", "surname":"", "user": "", "email": "", "password":"", "password_confirmation":""}
   *             )
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Register OK.",
   *         @OA\JsonContent()
   *     ),
   *     @OA\Response(
   *         response="default",
   *         description="Ha ocurrido un error.",
   *         @OA\JsonContent()
   *     )
   * )
   * @return \Illuminate\Http\JsonResponse
   */
  public function register(CreateUserRequest $request)
  {
    $user = (new UserManager($request))->createFromRequest();

    if (!$user) {
      return response()->json([
        'message' => 'Hubo un error en la solicitud',
      ], 400);
    } else
      return response()->json([
        'message' => 'Registro exitoso',
        'user' => $user
      ], 201);
  }

   /**
   * Get users list
   * @OA\GET(
   *     path="/users",
   *     tags={"Users"},
   *     summary="Get users list",
   *     @OA\Response(
   *         response=200,
   *         description="ok.",
   *         @OA\JsonContent()
   *     ),
   *     @OA\Response(
   *         response="default",
   *         description="default",
   *         @OA\JsonContent()
   *     ),
   *     security={
   *         {"bearer": {}}
   *     }
   * )
   * @return \Illuminate\Http\JsonResponse
   */
  public function list()
  {
    $users = User::all();

    return response()->json([
      'message' => 'Consulta exitosa',
      'users' => $users
    ], 201);
  }

   /**
   * Get user
   * @OA\GET(
   *     path="/users/{user_id}",
   *     tags={"Users"},
   *     summary="Get user",
   *     @OA\Parameter(
   *        name="user_id", in="path",required=true, @OA\Schema(type="integer")
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="ok.",
   *         @OA\JsonContent()
   *     ),
   *     @OA\Response(
   *         response="default",
   *         description="default",
   *         @OA\JsonContent()
   *     ),
   *     security={
   *         {"bearer": {}}
   *     }
   * )
   * @return \Illuminate\Http\JsonResponse
   */
  public function getById(GetUserByIdRequest $request)
  {
    $user = (new UserManager($request))->getByIdRequest();

    return response()->json([
      'message' => 'Consulta exitosa',
      'user' => $user
    ], 201);
  }

   /**
   * Edit user
   * @OA\PUT(
   *     path="/users/{user_id}",
   *     tags={"Users"},
   *     summary="Edit user",
   *     @OA\Parameter(
   *        name="user_id", in="path",required=true, @OA\Schema(type="integer")
   *     ),
   *     @OA\RequestBody(
   *         @OA\MediaType(
   *             mediaType="application/json",
   *             @OA\Schema(
   *                 @OA\Property(
   *                     property="name",
   *                     type="string",
   *                     description="the name"
   *                 ),
   *                 @OA\Property(
   *                     property="surname",
   *                     type="string",
   *                     description="the surname"
   *                 ),
   *                 @OA\Property(
   *                     property="user",
   *                     type="string",
   *                     description="the username"
   *                 ),
   *                 @OA\Property(
   *                     property="email",
   *                     type="string",
   *                     description="the email"
   *                 ),
   *                 @OA\Property(
   *                     property="password",
   *                     type="string",
   *                     description="the password"
   *                 ),
   *                 @OA\Property(
   *                     property="password_confirmation",
   *                     type="string",
   *                     description="the password confirmation"
   *                 ),
   *                example={"name": "", "surname":"", "user": "", "email": "", "password":"", "password_confirmation":""}
   *             )
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="ok.",
   *         @OA\JsonContent()
   *     ),
   *     @OA\Response(
   *         response="default",
   *         description="default",
   *         @OA\JsonContent()
   *     ),
   *     security={
   *         {"bearer": {}}
   *     }
   * )
   * @return \Illuminate\Http\JsonResponse
   */
  public function edit(EditUserRequest $request)
  {
    $user = (new UserManager($request))->editRequest();

    return response()->json([
      'message' => 'Consulta exitosa',
      'user' => $user
    ], 201);
  }

   /**
   * Remove user
   * @OA\DELETE(
   *     path="/users/{user_id}",
   *     tags={"Users"},
   *     summary="Remove user",
   *     @OA\Parameter(
   *        name="user_id", in="path",required=true, @OA\Schema(type="integer")
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="ok.",
   *         @OA\JsonContent()
   *     ),
   *     @OA\Response(
   *         response="default",
   *         description="default",
   *         @OA\JsonContent()
   *     ),
   *     security={
   *         {"bearer": {}}
   *     }
   * )
   * @return \Illuminate\Http\JsonResponse
   */
  public function remove(GetUserByIdRequest $request)
  {
    (new UserManager($request))->removeRequest();

    return response()->json([
      'message' => 'Usuario eliminado',
    ], 201);
  }

}
