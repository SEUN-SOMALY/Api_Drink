<?php

namespace App\Http\Controllers;

use App\Models\drink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrinkController extends Controller
{
    //'
    // EXISTING INSERT METHOD
    public function insert(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
            'qty' => 'required|numeric',
            'description' => 'required',
            'category' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'massage' => "Invalid input! try again",
            ]);
        }
        $input = $validate->validated();
        $insert = drink::create($input);
        if ($insert) {
            return response()->json([
                'status' => 201,
                'message' => "insert successfully",
            ]);
        }
    }

    // ⭐ NEW METHOD TO FIX THE ERROR ⭐
    public function getDrink()
    {
        // 1. Fetch all records from the 'drinks' table
        $drinks = drink::all();
        return $drinks;
    }
}
