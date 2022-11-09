<table class="table table-sm tblInfo">
    <tr>
        <th>ID</th>
        <td>{{ $konto->id }}</td>
    </tr>
    <tr>
        <th>Buchungstag</th>
        <td>{{ $konto->buchungstag->format('d.m.Y') }}</td>
    </tr>
    <tr>
        <th>Buchungstext</th>
        <td>{{ $konto->buchungstext }}</td>
    </tr>
    <tr>
        <th>Verwendungszweck</th>
        <td>{{ $konto->verwendungszweck }}</td>
    </tr>
    <tr>
    @if($konto->betrag > 0)
        <th >Von wem</th>
    @else
        <th>Für wen</th>
    @endif
        <td>{{ $konto->wer }}</td>
    </tr>
    <tr>
        <th>Kontonummer</th>
        <td>{{ $konto->kontonummer }}</td>
    </tr>
    <tr>
        <th>BLZ</th>
        <td>{{ $konto->blz }}</td>
    </tr>
    <tr>
        <th>Betrag</th>
        <td>{{ $konto->betrag }}</td>
    </tr>
    <tr>
        <th>Währung</th>
        <td>{{ $konto->waehrung }}</td>
    </tr>
    <tr>
        <th>Info</th>
        <td>{{ $konto->info }}</td>
    </tr>
</table>
