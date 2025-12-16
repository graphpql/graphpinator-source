<?php

declare(strict_types = 1);

namespace Graphpinator\Source;

use Graphpinator\Common\Location;

/**
 * @extends \Iterator<int, string>
 */
interface Source extends \Iterator
{
    #[\Override]
    public function key() : int;

    public function hasChar() : bool;

    public function getChar() : string;

    public function getLocation() : Location;
}
