<?php

namespace App\Controller;

use App\Entity\Tasks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    /**
     * @Route("/tasks", name="tasks")
     */
    public function index()
    {
        $tasks = $this->getDoctrine()->getRepository(Tasks::class)->findAll();

        return $this->render('tasks/index.html.twig', [
            'tasks' => $tasks
        ]);
    }

    public function edit($id)
    {
        $repository = $this->getDoctrine()->getRepository(Tasks::class);

        $task = $repository->find($id);

        return $this->render('tasks/edit.html.twig', compact($task));
    }
}
