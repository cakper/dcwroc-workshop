<?php

namespace Dcwroc\TaskBundle\Controller;

use DateTime;
use DateTimeImmutable;
use Dcwroc\TaskBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="task_list")
     * @Template()
     */
    public function indexAction()
    {
        return ['tasks' => $this->get('dcwroc_task.repository')->findAll()];
    }

    /**
     * @Route("/create", name="task_create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $task = new Task('', new DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
                     ->add('name', 'text')
                     ->add('dueDate', 'date')
                     ->add('submit', 'submit')
                     ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->get('dcwroc_task.repository')->save($task);
            $this->get('session')->getFlashBag()->add('info', 'New task was added');

            return $this->redirect($this->generateUrl('task_list'));
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/{id}/complete/", name="task_complete")
     */
    public function completeAction($id)
    {
        $task = $this->get('dcwroc_task.repository')->findById($id);

        if ($task instanceof Task) {
            $task->setCompleted(true);
            $this->get('dcwroc_task.repository')->save($task);
        }

        return $this->redirect($this->generateUrl('task_list'));
    }

    /**
     * @Route("/{id}/remove/", name="task_remove")
     */
    public function removeAction($id)
    {
        $task = $this->get('dcwroc_task.repository')->findById($id);

        if ($task instanceof Task) {
            $this->get('dcwroc_task.repository')->remove($task);
        }

        return $this->redirect($this->generateUrl('task_list'));
    }
}
