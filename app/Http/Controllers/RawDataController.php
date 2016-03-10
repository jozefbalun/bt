<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\RawData;

class RawDataController extends Controller
{

    public function store(Request $request)
    {
        RawData::create($request->all());

        return response()->json("ok");
    }

    public function index() {
        return response()->json("index ok");
    }

}
