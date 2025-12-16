<?php

declare(strict_types = 1);

namespace Graphpinator\Source\Exception;

use Graphpinator\Common\Location;
use Graphpinator\Exception\GraphpinatorBase;

final class UnexpectedEnd extends GraphpinatorBase
{
    public const MESSAGE = 'Unexpected end of input. Probably missing closing brace?';

    public function __construct(
        Location $location,
    )
    {
        parent::__construct();

        $this->setLocation($location);
    }

    #[\Override]
    public function isOutputable() : bool
    {
        return true;
    }
}
