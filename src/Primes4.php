<?php

declare(strict_types=1);

namespace drupol\primes;

use drupol\primes\Iterator\PrimeIterator;
use Generator;
use Iterator;

final class Primes4 extends AbstractPrimes
{
    public static function generator(Iterator $init): Generator
    {
        return yield from new PrimeIterator($init);
    }
}
