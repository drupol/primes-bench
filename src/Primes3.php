<?php

declare(strict_types=1);

namespace drupol\primes;

use drupol\primes\Iterator\CustomCallbackFilterIterator;
use Generator;
use Iterator;

final class Primes3 extends AbstractPrimes
{
    protected static function sieve(Iterator $iterator): ?Generator
    {
        yield $primeNumber = $iterator->current();

        $iterator = new CustomCallbackFilterIterator(
            $iterator,
            static fn (int $a): bool => (0 !== ($a % $primeNumber)),
            $primeNumber
        );

        $iterator->next();

        return $iterator->valid() ?
            yield from self::sieve($iterator) :
            null;
    }
}
