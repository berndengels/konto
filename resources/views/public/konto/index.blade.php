@extends('layouts.default')

@section('title', 'Konto')
@section('header', 'Konto')
@section('content')
    @if($data->count() > 0)
        {{ $data->links() }}
        <table class="table table-sm table-striped">
            <tr>
                <th>Buchung</th>
                <th>Wer</th>
                <th>Buchungstext</th>
                <th>Betrag</th>
            </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->buchungstag }}</td>
                <td>{{ $item->wer }}</td>
                <td>{{ $item->buchungstext }}</td>
                <td>{{ $item->betrag }}</td>
            </tr>
        @endforeach
        </table>
        {{ $data->links() }}
    @else
        <h5>Keine Daten vorhanden</h5>
    @endif
@endsection
