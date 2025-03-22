<?php

namespace App\Http\Controllers\API;

use App\helper\Apihelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TableRequest;
use App\Http\Resources\TableResource;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index(){
        $tables = Table::orderby('number','asc')->get();
        return Apihelper::sendrespone('200','Tables Success',TableResource::collection($tables));
    }
}
