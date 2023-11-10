<?php

declare(strict_types = 1);

namespace Graphpinator\Source\Exception;

final class UnexpectedEnd extends \Graphpinator\Exception\GraphpinatorBase
{
    public const MESSAGE = 'Unexpected end of input. Probably missing closing brace?';

    public function __construct(\Graphpinator\Common\Location $location)
    {
        parent::__construct();

        $this->setLocation($location);
    }

    public function isOutputable() : bool
    {
        return true;
    }
}
