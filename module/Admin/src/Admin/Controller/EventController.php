<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EventController extends AbstractActionController
{
    public function refreshAllAction()
    {
        $this->plugin('Meetup')->validateMeetupGroupPermission($this->params()->fromRoute('id'), 'any', true);
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $meetupGroup = $objectManager->getRepository('Db\Entity\MeetupGroup')->find($this->params()->fromRoute('id'));

        $meetup = $this->getServiceLocator()->get('MeetupClient');
#        $apiMeetupGroup = $meetup->getGroups(['group_id' => $meetupGroup->getId()])->toArray();

        $events = $meetup->getEvents(['group_id' => $meetupGroup->getId()])->toArray();

        foreach ($events as $event) {
            print_r($event);die();
        }

        return $this->plugin('redirect')->toRoute('admin/meetup-group', ['id' => $meetupGroup->getId()]);
    }
}
