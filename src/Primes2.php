<?php

declare(strict_types=1);

namespace drupol\primes;

use CallbackFilterIterator;
use Generator;
use Iterator;

final class Primes2 extends AbstractPrimes
{
    protected static function sieve(Iterator $iterator): ?Generator
    {
        yield $primeNumber = $iterator->current();

        $iterator = new CallbackFilterIterator(
            $iterator,
            static fn (int $a): bool => (($primeNumber ** 2) > $a) || (0 !== ($a % $primeNumber))
        );

        $iterator->next();

        return $iterator->valid() ?
            yield from self::sieve($iterator) :
            null;
    }
}
