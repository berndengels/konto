@extends('layouts.default')

@section('title', 'Upload')
@section('header', '')
@section('content')
    <div>
        <x-form id="frm" :action="route('konto.store')" method="post" enctype="multipart/form-data">
            <x-form-input class="m-1" type="file" name="file" label="Upload " required/>
            <x-form-input class="m-1" type="submit" name="senden" value="senden" />
        </x-form>
    </div>
@endsection
