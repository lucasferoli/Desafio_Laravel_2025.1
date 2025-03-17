UserController:
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    const ITEMS_PER_PAGE = 6;
    public function MostrarUser()
    {
        $page = $_GET['page'];
        $skip = ($page - 1) * UserController::ITEMS_PER_PAGE;
        $total_pages = ceil(    User::count() / UserController::ITEMS_PER_PAGE);
        
        $users = UserResource::collection(User::get()->skip($skip)->take(UserController::ITEMS_PER_PAGE));

        if($users){

            return response()->json([
                'users' => $users,
                'total_pages' => $total_pages,
                'status' => 200
            ]);
        }
    }
}