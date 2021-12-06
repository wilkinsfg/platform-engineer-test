<?php

use App\Models\FilmLocationModel;
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
    $data = file_get_contents('https://c2t-cabq-open-data.s3.amazonaws.com/film-locations-json-all-records_03-19-2020.json');


    /**
     * Assignment: filter data in php
     * docs on data: http://data.cabq.gov/business/filmlocations/MetaData.pdf/view
     *
     * Filter data based on start and end date inputs (shoot date must fall between the start and end dates)
     * Adjust for your timezone
     * Filter out duplicate productions
     * Data should be returned as a json in this format:
     * {
     *      count: 1,
     *      productions: [
     *          {
     *              title: "production name",
     *              type: "movie, tv or other",
     *              sites: [
     *                  {
     *                      name: "site name",
     *                      shoot_date: "Month Date, Year"
     *                  }
     *              ]
     *          }
     *      ]
     * }
     *
     * On the front end (show.blade.php):
     * Display all data to user (just a bulleted list is fine)
     * Display date in a human readable format in your timezone
     */

    $jsonData = json_decode($data, true);

    $productions = collect([]);//collect(new FilmLocationModel());
    foreach ($jsonData['features'] as $film)
    {
//        $production = new FilmLocationModel();
        $production = collect([
            'title' => $film['attributes']['Title'],
            'type' => $film['attributes']['Type'],
            'sites' => [
                'name' => $film['attributes']['Site'],
                'shoot_date' => $film['attributes']['ShootDate']
            ],
            'h' => md5(str_replace(' ', '', strtolower(trim($film['attributes']['Title']))))
        ]);
//        dd($production);
        $productions -> add($production);
    }
//    dd($productions[5]);
//    dd(count($productions));
    $productionsGrouped = array_values($productions->groupBy('h')->all());
    dd(count($productionsGrouped));
    return view('show', ['count'=>  count($productionsGrouped),'productions' => $productionsGrouped]);
});
