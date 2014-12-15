<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;
use Admin\Form;

class SponsorController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $sponsors = $objectManager->getRepository('Db\Entity\Sponsor')->findBy([], ['name' => 'ASC']);

        return new ViewModel([
            'sponsors' => $sponsors
        ]);
    }

    public function editAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $sponsor = $objectManager->getRepository('Db\Entity\Sponsor')->find($this->params()->fromRoute('id'));

        $form = new Form\Sponsor();

        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($sponsor->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $sponsor->exchangeArray($form->getData());
                $objectManager->flush();

                return $this->plugin('redirect')->toRoute('admin/sponsor/detail', ['id' => $sponsor->getId()]);
            }
        } else {
            $form->setData($sponsor->getArrayCopy());
        }

        return new ViewModel([
            'sponsor' => $sponsor,
            'form' => $form
        ]);
    }

    public function createAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $form = new Form\Sponsor();

        if ($this->getRequest()->isPost()) {
            $sponsor = new Entity\Sponsor();

            $form->setInputFilter($sponsor->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $sponsor->exchangeArray($form->getData());

                $objectManager->persist($sponsor);
                $objectManager->flush();

                return $this->plugin('redirect')->toRoute('admin/sponsor/detail', ['id' => $sponsor->getId()]);
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function detailAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $sponsor = $objectManager->getRepository('Db\Entity\Sponsor')->find($this->params()->fromRoute('id'));

        if (!$sponsor) {
            return $this->plugin('Meetup')->unAuthorized();
        }

        return new ViewModel([
            'sponsor' => $sponsor
        ]);
    }

    public function deleteAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $sponsor = $objectManager->getRepository('Db\Entity\Sponsor')->find($this->params()->fromRoute('id'));

        if ($sponsor and $sponsor->canDelete()) {
            $objectManager->remove($sponsor);
            $objectManager->flush();
        }

        return $this->plugin('redirect')->toRoute('admin/sponsor');
    }
}
