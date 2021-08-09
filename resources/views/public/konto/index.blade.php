@extends('layouts.default')

@section('title', 'Giro-Konto')
@section('header', ' Giro-Konto DE40 1005 0000 0014 1083 72')
@section('content')
    @if($data->total() > 0)
        <div>
            <!--pre>
            {{-- print_r(@request()->except(['_token'])) --}}
            </pre>
            <pre>{{-- $sql --}}</pre-->
            <x-form id="frm" :action="route('konto')" method="post">
                <x-form-group class="d-flex p-0" inline>
                    <x-form-select class="m-1 d-inline-block" id="wer" name="wer" label="Wer" :options="$uniq" :default="$wer" />
                    <x-form-input class="m-1 ml-3" type="date" name="start" label="Von" :value="$start" />
                    <x-form-input class="m-1" type="date" name="end" label="Bis" :value="$end" />
                    <x-form-input class="m-1" type="submit" name="filter" label="Suche" value="filter" />
                    <x-form-input class="m-1" type="button" name="reset" label="Reset" value="Reset" />
                </x-form-group>
                <x-form-group class="d-flex p-0 mt-0" inline>
                    <x-form-input class="m-1 col-12" type="submit" name="group" value="group by Wer" />
                </x-form-group>
            </x-form>
        </div>
        {{ $data->appends(request()->except('_token'))->links() }}
        <h5>Treffer: {{ $data->total() }}</h5>
        <table class="table table-sm table-striped tblItems">
            <tr>
                @foreach($columns as $col)
                    <th>@sortablelink($col)</th>
                @endforeach
            </tr>
        @foreach ($data as $item)
            <tr class="trItem" data-id="{{ $item->id }}">
                @foreach($columns as $col)
                    <td>{{ $item->$col }}</td>
                @endforeach

                <!--td>{{-- $item->buchungstag->format('d.m.Y') }}</td>
                <td>{{ $item->wer }}</td>
                <td>{{ $item->buchungstext }}</td>
                <td>{{ $item->betrag --}}</td-->
            </tr>
        @endforeach
        </table>
        {{ $data->appends(request()->except('_token'))->links() }}
    @else
        <h5>Keine Daten vorhanden</h5>
    @endif
@endsection

@section('inline-scripts')
<script>
    const $tooltip = $('#tooltip');
    $("#wer").change(e => {
        $("#frm").submit();
    });
    $("input[name=reset]").click(e => location.href = "{{ route('konto') }}")
    @if(!$group)
    $('.trItem').click(e => {
        let $tr = $(e.target).parent('tr'),
            id = $tr.data('id'),
            url = '/konto/' + id
        ;
        $tooltip.load(url).show().click(function(){$(this).hide()});
    });
    @endif
</script>
@endsection
