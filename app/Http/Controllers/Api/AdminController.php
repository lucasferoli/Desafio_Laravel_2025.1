AdminController
<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    const ITEMS_PER_PAGE = 6;
    public function mostrarAdmin()
    {
        $page = $_GET['page'];
        $skip = ($page - 1) *  AdminController::ITEMS_PER_PAGE;
        $total_pages = ceil(    Admin::count() / AdminController::ITEMS_PER_PAGE);
        $admins = UserResource::collection(Admin::get()->skip($skip)->take(AdminController::ITEMS_PER_PAGE));
        if($admins){
            return response()->json([
                'users' => $admins,
                'total_pages' => $total_pages,
                'status' => 200
            ]);
        }
    }
}