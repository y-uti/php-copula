<?php
namespace YUti\Copula;

class CopulaMain
{
    public function __invoke(array $argv)
    {
        $commandLineParser = new CommandLineParser();
        $parseResult = $commandLineParser->parse();
        $options = $parseResult->options;

        $writerKind = $options['writer'];

        $writerRepository = array(
            'contour' => function () { return new ContourPlotWriter(); },
            'csv' => function () { return new CsvWriter(); },
        );

        $xs = range(-3.0, 3.0, 0.02);
        $ys = range(-3.0, 3.0, 0.02);
        $delta = 0.001;

        $dist = new NormalDistribution();
        // $dist = new UniformDistribution(-2, 2);

        $copula = (new CopulaBuilder())->build($options['copula'], $options);

        $cdf = new JointDistributionByCopula($copula, $dist, $dist);
        $pdf = new JointDensity($cdf, $delta);

        $z = array_fill(0, count($xs), array_fill(0, count($xs), 0));
        foreach ($ys as $yi => $y) {
            foreach ($xs as $xi => $x) {
                $z[$yi][$xi] = $pdf($x, $y);
            }
        }

        $writer = $writerRepository[$writerKind]();
        $writer->write($z);
    }
}
