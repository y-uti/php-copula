<?php
namespace YUti\Copula;

class CsvWriter implements Writer
{
    public function write(array $data, $filename = false)
    {
        $fh = fopen($filename !== false ? $filename : 'php://stdout', 'w');
        $ysize = count($data);
        for ($yi = 0; $yi < $ysize; ++$yi) {
            $line = implode(',', $data[$yi]);
            fwrite($fh, $line . "\n");
        }
        fclose($fh);
    }
}
