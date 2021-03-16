@extends('layouts.default')

@section('title', 'Konto')
@section('header', 'Konto')
@section('content')
    @if($data->count() > 0)
        <div id="app">
            <Konto :items="{{ $jsonData }}" />
        </div>
    @else
        <h5>Keine Vue Daten vorhanden</h5>
    @endif
@endsection
