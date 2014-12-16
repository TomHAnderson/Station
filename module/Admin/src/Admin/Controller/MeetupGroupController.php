<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MeetupGroupController extends AbstractActionController
{
    public function detailAction()
    {
        $this->plugin('Meetup')->validateMeetupGroupPermission($this->params()->fromRoute('id'), 'any', true);
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $meetupGroup = $objectManager->getRepository('Db\Entity\MeetupGroup')->find($this->params()->fromRoute('id'));

        $meetup = $this->getServiceLocator()->get('MeetupClient');
        $apiMeetupGroup = $meetup->getGroups(['group_id' => $meetupGroup->getId()])->toArray();

        return new ViewModel([
            'apiMeetupGroup' => $apiMeetupGroup[0],
            'meetupGroup' => $meetupGroup,
        ]);
    }

    public function sponsorContributionAction()
    {
        $this->plugin('Meetup')->validateMeetupGroupPermission($this->params()->fromRoute('id'), 'any', true);
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $meetupGroup = $objectManager->getRepository('Db\Entity\MeetupGroup')->find($this->params()->fromRoute('id'));

        return new ViewModel([
            'meetupGroup' => $meetupGroup,
        ]);
    }
}
