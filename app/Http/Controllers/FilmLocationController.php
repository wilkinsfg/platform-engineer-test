<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\FilmLocation;
use App\Services\FilmLocationService;
use Carbon\Carbon;
use GuzzleHttp\Client;

class FilmLocationController extends Controller
{
    public function show(Request $request)
    {
        //second validation, now at backend
        $this->validate($request, [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $filmLocationService = resolve(FilmLocationService::class);
        $filmLocations = $filmLocationService->getFilmLocationByDateRange($startDate, $endDate);
        return response()->json([
            'count' => count($filmLocations),
            'productions' => $filmLocations
        ]);
    }
}
