<?php

namespace App\Http\Controllers;

use App\Log;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Log::with(['log_type', 'client', 'portal'])->get()->toJson(JSON_PRETTY_PRINT);
    }


}
