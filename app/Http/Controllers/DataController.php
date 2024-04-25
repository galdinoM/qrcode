<?php

namespace App\Http\Controllers;

use App\Models\FederalReport;

class DataController extends Controller
{
    public function index()
    {
        $tableData = FederalReport::all();

        if ($tableData->isEmpty()) {
            return response()->json([]);
        }

        return response()->json($tableData);
    }
}
