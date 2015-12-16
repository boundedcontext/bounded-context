<?php namespace BoundedContext\Contracts\Generator;

use BoundedContext\Contracts\ValueObject\ValueObject as VO;

interface ValueObject
{
    /**
     * Generates a new VO.
     *
     * @return VO
     */

    public function generate();

}
