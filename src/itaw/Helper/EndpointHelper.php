<?php

namespace itaw\Helper;

/**
 * @author Florian Weber <florian.weber.dd@icloud.com>
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
