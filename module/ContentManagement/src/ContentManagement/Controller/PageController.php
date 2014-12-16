<?php

namespace ContentManagement\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity\Page as PageEntity;
use ContentManagement\Form\Page as PageForm;
use Exception;
use UnexpectedValueException;

class PageController extends AbstractActionController
{
    public function detailAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $urlIdentifier = $this->params()->fromRoute('url-identifier');

        // Handle id for audit linkback
        if (is_numeric($urlIdentifier)) {
            $page = $objectManager->getRepository('Db\Entity\Page')->find((int) $urlIdentifier);

            return $this->plugin('redirect')->toRoute('page', ['url-identifier' => $page->getUrlIdentifier()]);
        }

        $page = $objectManager->getRepository('Db\Entity\Page')->findOneBy([
            'urlIdentifier' => $urlIdentifier,
        ]);

        return new ViewModel(['page' => $page]);
    }

    public function createAction()
    {
        $urlIdentifier = $this->params()->fromPost('urlIdentifier');
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $page = new PageEntity();
        $inputFilter = $page->getInputFilter();

        if ($urlIdentifier == 'create' or $urlIdentifier == 'edit' or $urlIdentifier == 'delete') {
            throw new UnexpectedValueException("$urlIdentifier is a reserved word and cannot be a page name");
        }

        $data = [
            'urlIdentifier' => $urlIdentifier,
            'title' => $urlIdentifier,
            'isPublished' => false,
            'sort' => -1,
        ];

        $inputFilter->setData($data);
        if (!$inputFilter->isValid()) {
            throw new Exception('Invalid URL Identifier');
        }

        if ($objectManager->getRepository('Db\Entity\Page')->findOneBy([
            'urlIdentifier' => $inputFilter->getValue('urlIdentifier'),
        ])) {
            throw new Exception('URL Identifier '.$inputFilter->getValue('urlIdentifier').' is already in use');
        }

        $page->exchangeArray($inputFilter->getValues());
        $objectManager->persist($page);
        $objectManager->flush();

        return $this->plugin('redirect')->toRoute('page/edit', ['url-identifier' => $page->getUrlIdentifier()]);
    }

    public function editAction()
    {
        $urlIdentifier = $this->params()->fromRoute('url-identifier');
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $objectManager->getRepository('Db\Entity\Page')->findOneBy([
            'urlIdentifier' => $urlIdentifier,
        ]);

        if (!$page) {
            throw new Exception('Page not found by url identifier '.$urlIdentifier);
        }

        $form = new PageForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter($page->getInputFilter());

            $form->setData($request->getPost());

            if ($form->isValid()) {
                $page->exchangeArray($form->getData());
                $objectManager->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('page/detail', ['url-identifier' => $form->getData()['urlIdentifier']]);
            }
        } else {
            $form->setData($page->getArrayCopy());
        }

        return new ViewModel([
            'form' => $form,
            'page' => $page,
        ]);
    }

    public function deleteAction()
    {
        $urlIdentifier = $this->params()->fromRoute('url-identifier');
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $objectManager->getRepository('Db\Entity\Page')->findOneBy([
            'urlIdentifier' => $urlIdentifier,
        ]);

        $objectManager->remove($page);
        $objectManager->flush();

        $this->plugin('redirect')->toRoute('admin');
    }
}
