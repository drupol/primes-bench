<?php

declare(strict_types=1);

namespace drupol\primes;

use CallbackFilterIterator;
use Generator;
use Iterator;
use LimitIterator;

final class Primes4 extends AbstractPrimes
{
    protected static function sieve(Iterator $iterator): ?Generator
    {
        yield $primeNumber = $iterator->current();

        $iterator = new LimitIterator(
            new CallbackFilterIterator(
                $iterator,
                static fn (int $a): bool => (0 !== ($a % $primeNumber)),
            ),
            0,
            1
        );

        $iterator->next();

        return $iterator->valid() ?
            yield from self::sieve($iterator) :
            null;
    }
}
