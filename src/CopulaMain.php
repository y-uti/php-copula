<?php
namespace YUti\Copula;

class CopulaMain
{
    public function __invoke(array $argv)
    {
        $commandLineParser = new CommandLineParser();
        $parseResult = $commandLineParser->parse();
        $options = $parseResult->options;

        $copulaKind = $options['copula'];
        $theta = $options['theta'];

        $writerKind = $options['writer'];

        $copulaRepository = array(
            'amh' => function () use ($theta) { return new AliMikhallHaqCopula($theta); },
            'clayton' => function () use ($theta) { return new ClaytonCopula($theta); },
            'frank' => function () use ($theta) { return new FrankCopula($theta); },
            'gumbel' => function () use ($theta) { return new GumbelCopula($theta); },
            'joe' => function () use ($theta) { return new JoeCopula($theta); },
            'plackett' => function () use ($theta) { return new Plackettopula($theta);},
            'product' => function () use ($theta) { return new Plackettopula($theta);},
        );

        $writerRepository = array(
            'contour' => function () { return new ContourPlotWriter(); },
            'csv' => function () { return new CsvWriter(); },
        );

        $xs = range(-3.0, 3.0, 0.02);
        $ys = range(-3.0, 3.0, 0.02);
        $delta = 0.001;

        $dist = new NormalDistribution();
        // $dist = new UniformDistribution(-2, 2);

        $copula = $copulaRepository[$copulaKind]($theta);

        $cdf = new JointDistributionByCopula($copula, $dist, $dist);
        $pdf = new JointDensity($cdf, $delta);

        $z = array_fill(0, count($xs), array_fill(0, count($xs), 0));
        foreach ($xs as $xi => $x) {
            foreach ($ys as $yi => $y) {
                $z[$xi][$yi] = $pdf($x, $y);
            }
        }

        $writer = $writerRepository[$writerKind]();
        $writer->write($z);
    }
}
