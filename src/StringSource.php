<?php

declare(strict_types = 1);

namespace Graphpinator\Source;

use Graphpinator\Common\Location;
use Graphpinator\Source\Exception\UnexpectedEnd;

final class StringSource implements Source
{
    /** @var list<string> */
    private array $characters;
    private int $numberOfChars;
    private int $currentIndex;
    private int $currentLine;
    private int $currentColumn;

    public function __construct(
        string $source,
    )
    {
        $this->characters = \preg_split('//u', $source, -1, \PREG_SPLIT_NO_EMPTY) ?: []; // @phpstan-ignore theCodingMachineSafe.function,ternary.shortNotAllowed
        $this->numberOfChars = \count($this->characters);
        $this->rewind();
    }

    #[\Override]
    public function hasChar() : bool
    {
        return \array_key_exists($this->currentIndex, $this->characters);
    }

    #[\Override]
    public function getChar() : string
    {
        if ($this->hasChar()) {
            return $this->characters[$this->currentIndex];
        }

        throw new UnexpectedEnd($this->getLocation());
    }

    #[\Override]
    public function getLocation() : Location
    {
        return new Location($this->currentLine, $this->currentColumn);
    }

    public function getNumberOfChars() : int
    {
        return $this->numberOfChars;
    }

    #[\Override]
    public function current() : string
    {
        return $this->getChar();
    }

    #[\Override]
    public function key() : int
    {
        return $this->currentIndex;
    }

    #[\Override]
    public function next() : void
    {
        if ($this->getChar() === \PHP_EOL) {
            ++$this->currentLine;
            $this->currentColumn = 1;
        } else {
            ++$this->currentColumn;
        }

        ++$this->currentIndex;
    }

    #[\Override]
    public function valid() : bool
    {
        return $this->hasChar();
    }

    #[\Override]
    public function rewind() : void
    {
        $this->currentIndex = 0;
        $this->currentLine = 1;
        $this->currentColumn = 1;
    }
}
