<?php
namespace App\Http\Controllers\Api;

use App\Models\Konto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\KontoResource;
use App\Http\Resources\KontoShortResource;

class ApiKontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = QueryBuilder::for(Konto::class)
            ->allowedFilters(['buchungstag', 'buchungstext', 'wer', 'betrag'])
            ->get();
        $data = KontoShortResource::collection($data);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Konto  $konto
     * @return \Illuminate\Http\Response
     */
    public function show(Konto $konto)
    {
        $data = new KontoResource($konto);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Konto  $konto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konto $konto)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Konto  $konto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konto $konto)
    {
    }
}
