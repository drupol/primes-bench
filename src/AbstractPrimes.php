<?php

declare(strict_types=1);

namespace drupol\primes;

use CallbackFilterIterator;
use drupol\primes\Iterator\ListIterator;
use Generator;
use Iterator;

abstract class AbstractPrimes
{
    public static function generator(?Iterator $init = null): Generator
    {
        return yield from static::sieve(
            $init ?? new ListIterator(
                2,
                static fn (int $n): int => $n + 1
            )
        );
    }

    protected static function sieve(Iterator $iterator): ?Generator
    {
        yield $primeNumber = $iterator->current();

        $iterator = new CallbackFilterIterator(
            $iterator,
            static fn (int $a): bool => (0 !== ($a % $primeNumber)),
        );

        $iterator->next();
        $iterator->valid();

        return yield from self::sieve($iterator);
    }
}
