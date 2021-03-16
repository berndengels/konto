<?php
namespace App\Lib;

use Illuminate\Support\Str;

trait CSVReader {

    public $delimiter = ';';
    public $enclosure = "\"";
    public $escape = '\\';
    public $except = null;
    public $convertToDate = null;
    public $convertToDecimal = null;

    public function csv_to_array($filename = '', $hasHeader = true) {
        ini_set("auto_detect_line_endings", true); // If having issues on iOS

        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }
        $except = ($this->except && is_array($this->except) && count($this->except) > 0) ? $this->except : null;
        $convertToDate = ($this->convertToDate && is_array($this->convertToDate) && count($this->convertToDate) > 0) ? $this->convertToDate : null;
        $convertToDecimal = ($this->convertToDecimal && is_array($this->convertToDecimal) && count($this->convertToDecimal) > 0) ? $this->convertToDecimal : null;

        $data   = [];
        $lines  = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if($hasHeader) {
            $header = str_getcsv(array_shift($lines), $this->delimiter, $this->enclosure, $this->escape);
            array_walk($header, function (&$v) {
                $v = str_replace('beguenstigter/zahlungspflichtiger','wer', strtolower($v));
            });
            foreach($lines as $line) {
                $row = str_getcsv($line, $this->delimiter, $this->enclosure, $this->escape);
                $row = array_combine($header, $row);

                foreach($row as $key => $val) {
                    if($except && in_array($key, $except)) {
                        unset($row[$key]);
                    }
                    if($convertToDate && in_array($key, $convertToDate)) {
                        $row[$key] = preg_replace('/^([0-9]{2})\.([0-9]{2})\.([0-9]{2})$/', "20$3-$2-$1", $val);
                    }
                    if($convertToDecimal && in_array($key, $convertToDecimal)) {
                        $row[$key] = str_replace(',', '.', $val);
                    }
                }

                $data[] = $row;
            }
        }
        return $data;
    }
}
