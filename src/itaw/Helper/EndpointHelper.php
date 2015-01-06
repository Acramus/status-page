<?php

namespace itaw\Helper;

/**
 * @author Florian Weber <fweber@ligneus.de>
 */
class EndpointHelper
{
    /**
     * @param  string $input
     * @return string
     */
    public static function generateSlug($input)
    {
        return sha1($input);
    }
}
