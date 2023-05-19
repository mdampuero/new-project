<?php

namespace App\BackEndBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\BackEndBundle\Entity\Demo;
use App\BackEndBundle\Form\Demo\DemoType;

class DemosController extends FOSRestController
{
    public function indexAction(Request $request)
    {
        $search = $request->query->get('search', array());
        $query = (!isset($search['value'])) ? '' : $search['value'];
        $offset = $request->query->get('start', 0);
        $limit = $request->query->get('length', 30);
        return $this->handleView($this->view(array(
            'data' => $this->getDoctrine()->getRepository(Demo::class)->search($query, $limit, $offset, $request->query->get('sort', null), $request->query->get('direction', null))->getQuery()->getResult(),
            'recordsTotal' => $this->getDoctrine()->getRepository(Demo::class)->total(),
            'recordsFiltered' => $this->getDoctrine()->getRepository(Demo::class)->searchTotal($query, $limit, $offset),
            'offset' => $offset,
            'limit' => $limit,
        )));
    }

    public function getAction($id)
    {
        if (!$entity = $this->getDoctrine()->getRepository(Demo::class)->find($id))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));
        return $this->handleView($this->view($entity));
    }

    public function postAction(Request $request)
    {
        $entity = new Demo();
        $form = $this->createForm(DemoType::class, $entity);
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->handleView($this->view($entity, Response::HTTP_OK));
        }
        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }

    public function putAction(Request $request, $id)
    {
        if (!$entity = $this->getDoctrine()->getRepository(Demo::class)->find($id))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));
        $form = $this->createForm(DemoType::class, $entity);
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->handleView($this->view($entity, Response::HTTP_OK));
        }
        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }

    public function deleteAction(Request $request, $id)
    {
        if (!$entity = $this->getDoctrine()->getRepository(Demo::class)->find($id))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));
        $form = $this->createFormBuilder(null, array('csrf_protection' => false))->setMethod('DELETE')->getForm();
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setIsDelete(true);
            $this->getDoctrine()->getManager()->flush();
            return $this->handleView($this->view($entity, Response::HTTP_OK));
        }
        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }
}