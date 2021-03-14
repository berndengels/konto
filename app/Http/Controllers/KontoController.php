<?php
namespace App\Http\Controllers;

use App\Models\Konto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Konto::paginate(100);
        return view('public.konto.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Konto $konto
     * @return Response
     */
    public function show(Konto $konto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Konto $konto
     * @return Response
     */
    public function edit(Konto $konto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Konto $konto
     * @return Response
     */
    public function update(Request $request, Konto $konto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Konto $konto
     * @return Response
     */
    public function destroy(Konto $konto)
    {
        //
    }
}
