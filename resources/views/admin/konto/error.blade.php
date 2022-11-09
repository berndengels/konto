@extends('layouts.default')

@section('title', 'Upload')
@section('header', 'Bitte CSV-MT940 Format für Import wählen')
@section('content')
    <div>
        @if(isset($error))
            <span class="alert-danger">{{ $error }}</span>
        @else
            <span class="alert-danger">Es ist ein Fehler aufgetreten</span>
        @endif
    </div>
@endsection
