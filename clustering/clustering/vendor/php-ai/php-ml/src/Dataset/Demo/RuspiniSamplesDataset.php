<?php

declare(strict_types=1);

namespace Phpml\Dataset\Demo;

use Phpml\Dataset\CsvDataset;

/**
 * Classes: 3
 * Samples per class: 50
 * Samples total: 150
 * Features per sample: 4.
 */
class RuspiniSamplesDataset extends CsvDataset
{
    public function __construct()
    {
        $filepath = __DIR__.'/../../../data/Ruspini.csv';
        parent::__construct($filepath, 2, false);
    }
}
