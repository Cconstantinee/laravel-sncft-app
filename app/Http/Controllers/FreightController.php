<?php

namespace App\Http\Controllers;
use App\Models\Freight;
use Illuminate\Http\Request;

class FreightController extends Controller
{
    public function index()
    {
        $freight = freight::select('freight_type')->get();
        return response()->json($freight);
    }
    
}
