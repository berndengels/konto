<?php

namespace Database\Seeders;

use App\Lib\CSVReader;
use App\Models\Konto;
use Illuminate\Database\Seeder;

class KontoSeeder extends Seeder
{
    use CSVReader;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Konto::truncate();
        $file = database_path('data').'/20180314-20210314-umsatz.csv';
        $this->except = ['auftragskonto'];
        $this->convertToDate = ['buchungstag','valutadatum'];
        $this->convertToDecimal = ['betrag'];

        $data = $this->csv_to_array($file, true, ';', ['auftragskonto'], );
        Konto::insertOrIgnore($data);
    }
}
