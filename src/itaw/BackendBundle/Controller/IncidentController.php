<?php

namespace itaw\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use itaw\DataBundle\Entity\Incident;

/**
 * @author Florian Weber <fweber@ligneus.de>
 */
class IncidentController extends AbstractBackendController
{
    public function collectionAction()
    {
        $incidents = $this->getDoctrine()->getRepository('itawDataBundle:Incident')->findAll();

        return $this->render('itawBackendBundle:Incident:collection.html.twig', array(
                    'incidents' => $incidents,
        ));
    }

    public function objectAction($incidentId)
    {
        $incident = $this->getDoctrine()->getRepository('itawDataBundle:Incident')->findOneById($incidentId);

        return $this->render('itawBackendBundle:Incident:object.html.twig', array(
                    'incident' => $incident,
        ));
    }

    public function createAction(Request $request)
    {
        $endpoints = $this->getDoctrine()->getRepository('itawDataBundle:Endpoint')->findAll();

        if ($request->get('sent', 0) == 1) {
            $endpoint = $this->getDoctrine()->getRepository('itawDataBundle:Endpoint')->findOneBySlug($request->get('endpoint'));

            if (!$endpoint) {
                $this->addError(sprintf('An Endpoint with the Slug %s is not defined!', $request->get('endpoint')));

                return $this->render('itawBackendBundle:Incident:create.html.twig', array(
                            'endpoints' => $endpoints,
                ));
            }

            $incident = new Incident();
            $incident->setTitle($request->get('title'))
                    ->setDescription($request->get('description'))
                    ->setOccurrence(new \DateTime('now'))
                    ->setEndpoint($endpoint)
            ;

            //validate
            $validator = $this->get('validator');
            $errors = $validator->validate($incident);

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    $this->addError($error);
                }

                return $this->render('itawBackendBundle:Incident:create.html.twig', array(
                            'endpoints' => $endpoints,
                ));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($incident);
            $em->flush();

            return $this->redirectToRoute('backend_incidents_collection');
        }

        return $this->render('itawBackendBundle:Incident:create.html.twig', array(
                    'endpoints' => $endpoints,
        ));
    }

    public function updateAction(Request $request, $incidentId)
    {
        $incident = $this->getDoctrine()->getRepository('itawDataBundle:Incident')->findOneById($incidentId);

        if ($request->get('sent', 0) == 1) {
            $incident->setTitle($request->get('title'))
                    ->setDescription($request->get('description'))
            ;

            //validate
            $validator = $this->get('validator');
            $errors = $validator->validate($incident);

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    $this->addError($error);
                }

                return $this->render('itawBackendBundle:Incident:update.html.twig', array(
                            'incident' => $incident,
                ));
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('backend_incidents_collection');
        }

        return $this->render('itawBackendBundle:Incident:update.html.twig', array(
                    'incident' => $incident,
        ));
    }

    public function deleteAction(Request $request, $incidentId)
    {
        $incident = $this->getDoctrine()->getRepository('itawDataBundle:Incident')->findOneById($incidentId);

        if ($request->get('sent', 0) == 1) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($incident);
            $em->flush();

            return $this->redirectToRoute('backend_incidents_collection');
        }

        return $this->render('itawBackendBundle:Incident:delete.html.twig', array(
                    'incident' => $incident,
        ));
    }
}
