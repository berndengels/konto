@extends('layouts.default')

@section('title', 'Upload')
@section('header', 'Bitte CSV-MT940 Format für Import wählen')
@section('content')
    <div>
        @if(isset($error))
            <h3 class="text-danger">{{ $error }}</h3>
        @endif
        <x-form id="frm" :action="route('konto.store')" method="post" enctype="multipart/form-data">
            <x-form-input class="m-1" type="file" name="file" label="Upload " required/>
            <x-form-input class="m-1" type="submit" name="senden" value="senden" />
        </x-form>
    </div>
@endsection
