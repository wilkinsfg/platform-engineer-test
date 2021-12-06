<?php

use App\Models\FilmLocationModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/show', function (Request $request) {
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ]);
    $tz = 0;
    $startDate = Carbon::parse($request->start_date);
    $endDate = Carbon::parse($request->end_date);
    $tz = $request->tz;

    $data = file_get_contents('https://c2t-cabq-open-data.s3.amazonaws.com/film-locations-json-all-records_03-19-2020.json');
    $jsonData = collect(json_decode($data, true));


    $productions = collect([]);
    foreach ($jsonData['features'] as $film)
    {
        $production = collect([
            'title' => $film['attributes']['Title'],
            'type' => $film['attributes']['Type'],
            'sites' => [
                'name' => $film['attributes']['Site'],
                'shoot_date' => Carbon::createFromTimestampMs($film['attributes']['ShootDate'])->utcOffset($tz)
            ],
            'shootDate' => Carbon::createFromTimestampMs($film['attributes']['ShootDate']),
            'h' => md5(str_replace(' ', '', strtolower(trim($film['attributes']['Title']))))
        ]);

        $productions -> add($production);
    }

    $filterData = $productions->whereBetween('shootDate', [$startDate, $endDate]);

    $productionsGrouped = $filterData->groupBy('h')
        ->map(function($groupedData) {
            return (object) [
                'title' => $groupedData[0]['title'],
                'type' => $groupedData[0]['type'],
                'sites' => $groupedData->map(function($site) {
                    return (object)[
                        'name' => $site['sites']['name'],
                        'shoot_date' => $site['sites']['shoot_date']
                    ];
                })
            ];
        })
        ->all();

    return view('show', ['count'=>  count($productionsGrouped),'productions' => array_values($productionsGrouped)]);
});
