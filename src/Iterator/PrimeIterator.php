<?php

declare(strict_types=1);

namespace drupol\primes\Iterator;

use CallbackFilterIterator;
use Closure;
use Iterator;

final class PrimeIterator implements Iterator
{
    private int $current;

    public function __construct(Iterator $iterator, int $first = 2)
    {
        $this->current = $first;
        $this->iterator = $iterator;
        $this->sieve = $this->buildInnerIterator($iterator, $this->filter($first));
    }

    public function current(): int
    {
        return $this->current;
    }

    public function key(): int
    {
        return 0;
    }

    public function next(): void
    {
        $this->sieve->next();

        if (null !== $current = $this->sieve->current()) {
            $this->current = $current;
            $this->sieve = $this->buildInnerIterator($this->sieve, $this->filter($this->current));
        }
    }

    public function rewind(): void
    {
    }

    public function valid(): bool
    {
        return $this->iterator->valid();
    }

    private function buildInnerIterator(Iterator $iterator, callable $callback): Iterator
    {
        return new CallbackFilterIterator($iterator, $callback);
    }

    private function filter(int $primeNumber): Closure
    {
        return static fn (int $a): bool => (0 !== ($a % $primeNumber));
    }
}
