<?php

namespace Project\DataTransformer;

use ParseCsv\Csv;

class CsvToArrayTransformer
{
    public static function transformFileToArray(): array
    {
        $csv = new Csv();
        $csv->fields = ['id', 'name', 'quantity', 'price', 'currency'];
        $csv->delimiter = ';';
        $csv->parse('public/files.txt');

        return $csv->data;
    }
}