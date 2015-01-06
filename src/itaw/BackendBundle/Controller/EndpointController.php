<?php

namespace itaw\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use itaw\DataBundle\Entity\Endpoint;
use itaw\Helper\EndpointHelper;

/**
 * @author Florian Weber <fweber@ligneus.de>
 */
class EndpointController extends AbstractBackendController
{
    public function collectionAction()
    {
        $endpoints = $this->getDoctrine()->getRepository('itawDataBundle:Endpoint')->findAll();

        return $this->render('itawBackendBundle:Endpoint:collection.html.twig', array(
                    'endpoints' => $endpoints,
        ));
    }

    public function objectAction($slug)
    {
        $endpoint = $this->getDoctrine()->getRepository('itawDataBundle:Endpoint')->findOneBySlug($slug);

        return $this->render('itawBackendBundle:Endpoint:object.html.twig', array(
                    'endpoint' => $endpoint,
        ));
    }

    public function createAction(Request $request)
    {
        $session = $request->getSession();

        if ($request->get('sent', 0) == 1) {
            $endpoint = new Endpoint();
            $endpoint->setHost($request->get('host'))
                    ->setIp($request->get('ip'))
                    ->setName($request->get('name'))
                    ->setSlug(EndpointHelper::generateSlug($request->get('host').$request->get('name')))
            ;

            //validate
            $validator = $this->get('validator');
            $errors = $validator->validate($endpoint);

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    $session->getFlashBag()->add('error', $error);
                }

                return $this->render('itawBackendBundle:Endpoint:create.html.twig');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($endpoint);
            $em->flush();

            return $this->redirectToRoute('backend_endpoints_collection');
        }

        return $this->render('itawBackendBundle:Endpoint:create.html.twig');
    }

    public function updateAction(Request $request, $slug)
    {
        $session = $request->getSession();
        $endpoint = $this->getDoctrine()->getRepository('itawDataBundle:Endpoint')->findOneBySlug($slug);

        if ($request->get('sent', 0) == 1) {
            $endpoint->setHost($request->get('host'))
                    ->setIp($request->get('ip'))
                    ->setName($request->get('name'))
                    ->setSlug(EndpointHelper::generateSlug($request->get('host').$request->get('name')))
            ;

            //validate
            $validator = $this->get('validator');
            $errors = $validator->validate($endpoint);

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    $session->getFlashBag()->add('error', $error);
                }

                return $this->render('itawBackendBundle:Endpoint:update.html.twig', array(
                            'endpoint' => $endpoint,
                ));
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('backend_endpoints_collection');
        }

        return $this->render('itawBackendBundle:Endpoint:update.html.twig', array(
                    'endpoint' => $endpoint,
        ));
    }

    public function deleteAction(Request $request, $slug)
    {
        $endpoint = $this->getDoctrine()->getRepository('itawDataBundle:Endpoint')->findOneBySlug($slug);

        if ($request->get('sent', 0) == 1) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($endpoint);
            $em->flush();

            return $this->redirectToRoute('backend_endpoints_collection');
        }

        return $this->render('itawBackendBundle:Endpoint:delete.html.twig', array(
                    'endpoint' => $endpoint,
        ));
    }
}
