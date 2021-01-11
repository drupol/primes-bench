<?php

declare(strict_types=1);

namespace drupol\primes;

use CallbackFilterIterator;
use Generator;
use Iterator;

abstract class AbstractPrimes
{
    public static function generator(Iterator $init): Generator
    {
        return yield from static::sieve($init);
    }

    protected static function sieve(Iterator $iterator): ?Generator
    {
        yield $primeNumber = $iterator->current();

        $iterator = new CallbackFilterIterator(
            $iterator,
            static fn (int $a): bool => (0 !== ($a % $primeNumber)),
        );

        $iterator->next();

        return $iterator->valid() ?
            yield from self::sieve($iterator) :
            null;
    }
}
