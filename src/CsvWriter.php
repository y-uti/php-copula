<?php
namespace YUti\Copula;

class CsvWriter implements Writer
{
    private $delimiter;
    private $eol;

    public function __construct($delimiter = ',', $eol = PHP_EOL)
    {
        $this->delimiter = $delimiter;
        $this->eol = $eol;
    }

    public function write(array $xs, array $ys, array $data, $filename = null)
    {
        $fh = fopen($filename ?: 'php://stdout', 'w');

        fwrite($fh, $this->buildRow('', $xs));
        foreach ($ys as $yi => $y) {
            fwrite($fh, $this->buildRow($y, $data[$yi]));
        }

        fclose($fh);
    }

    private function buildRow($header, $data, $withEOL = true)
    {
        $delimiter = $this->delimiter;
        $eol = $withEOL ? $this->eol : '';

        return $header . $delimiter . implode($delimiter, $data) . $eol;
    }
}
