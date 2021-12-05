<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\FilmLocation;
use Carbon\Carbon;
use GuzzleHttp\Client;

class FilmLocationController extends Controller
{
    public function index()
    {
        $url = 'https://coagisweb.cabq.gov/arcgis/rest/services/public/FilmLocations/MapServer/0/query?where=1%3D1&text=&objectIds=&time=&geometry=&geometryType=esriGeometryEnvelope&inSR=&spatialRel=esriSpatialRelIntersects&relationParam=&outFields=*&returnGeometry=true&maxAllowableOffset=&geometryPrecision=&outSR=4326&returnIdsOnly=false&returnCountOnly=false&orderByFields=&groupByFieldsForStatistics=&outStatistics=&returnZ=false&returnM=false&gdbVersion=&f=pjson';
        $client = new Client(); //GuzzleHttp\Client
        $response = $client->request('GET', $url);
        return response()->json([
            'count'    => $response.count(),
            'productions'      => $response->getBody()
        ]);
    }
    /*public function show(Request $request)
    {
        $startDate = Carbon::parse($request->startDate)->toDateTimeString();
        $endDate = Carbon::parse($request->endDate)->toDateTimeString();

        return FilmLocation::findByDate($startDate, $endDate);
    }*/
}
