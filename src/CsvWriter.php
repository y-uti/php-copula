<?php
namespace YUti\Copula;

class CsvWriter implements Writer
{
    public function write(array $data, $filename = false)
    {
        $xsize = count($data);
        $ysize = count($data[0]);

        $fh = fopen($filename !== false ? $filename : 'php://stdout', 'w');
        for ($yi = 0; $yi < $ysize; ++$yi) {
            $line = '';
            for ($xi = 0; $xi < $xsize; ++$xi) {
                $line .= ($xi == 0 ? '' : ',') . $data[$xi][$yi];
            }
            fwrite($fh, $line . "\n");
        }
        fclose($fh);
    }
}
