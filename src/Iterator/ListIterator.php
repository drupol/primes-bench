<?php

declare(strict_types=1);

namespace drupol\primes\Iterator;

use Iterator;

final class ListIterator implements Iterator
{
    /**
     * @var mixed
     */
    private $current;

    /**
     * @var mixed
     */
    private $init;

    private int $key;

    /**
     * @var callable
     */
    private $succ;

    public function __construct($init, callable $succ)
    {
        $this->init = $init;
        $this->succ = $succ;
        $this->current = $init;
        $this->key = 0;
    }

    public function current()
    {
        return $this->current;
    }

    public function key(): int
    {
        return $this->key;
    }

    public function next(): void
    {
        $this->current = ($this->succ)($this->current);
        ++$this->key;
    }

    public function rewind(): void
    {
        $this->current = $this->init;
        $this->key = 0;
    }

    public function valid(): bool
    {
        return true;
    }
}
