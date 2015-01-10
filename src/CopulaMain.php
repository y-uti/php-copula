<?php
namespace YUti\Copula;

class CopulaMain
{
    public function __invoke(array $argv)
    {
        $commandLineParser = new CommandLineParser();
        $parseResult = $commandLineParser->parse();
        $options = $parseResult->options;

        $copulaBuilder = new CopulaBuilder();
        $copula = $copulaBuilder->build($options['copula'], $options);

        $distributionBuilder = new DistributionBuilder();
        $xdist = $distributionBuilder->build($options['xdist'], $options);
        $ydist = $distributionBuilder->build($options['ydist'], $options);

        $cdf = new JointDistributionByCopula($copula, $xdist, $ydist);
        $pdf = new JointDensity($cdf, $options['delta']);

        $xs = range($options['xmin'], $options['xmax'], $options['xstep']);
        $ys = range($options['ymin'], $options['ymax'], $options['ystep']);

        $z = array_fill(0, count($xs), array_fill(0, count($xs), 0));
        foreach ($ys as $yi => $y) {
            foreach ($xs as $xi => $x) {
                $z[$yi][$xi] = $pdf($x, $y);
            }
        }

        $writerBuilder = new WriterBuilder();
        $writer = $writerBuilder->build($options['writer'], $options);
        $writer->write($z);
    }
}
