<?php

namespace itaw\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Florian Weber <fweber@ligneus.de>
 */
abstract class AbstractBackendController extends Controller
{
    /**
     * Adds a Error Message to the Flash
     *
     * @param  string                                                   $message
     * @return \itaw\BackendBundle\Controller\AbstractBackendController
     */
    protected function addError($message)
    {
        $this->addFlash('error', $message);

        return $this;
    }

    /**
     * Adds a Info Message to the Flash
     *
     * @param  string                                                   $message
     * @return \itaw\BackendBundle\Controller\AbstractBackendController
     */
    protected function addInfo($message)
    {
        $this->addFlash('info', $message);

        return $this;
    }
}
