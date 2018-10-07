<?php

namespace App\Controller;

use App\Entity\Tasks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    public function update($id, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $repository = $this->getDoctrine()->getRepository(Tasks::class);
        $task = $repository->find($id);

        $task->setTitle($data['title']);
        dd($data['title']);
        $task->setDescription($data['description']);

        return new response('Task have been updated', 200);
    }

    public function edit($id)
    {
        $repository = $this->getDoctrine()->getRepository(Tasks::class);

        $task = $repository->find($id);

        return $this->render('tasks/edit.html.twig', compact($task));
    }
}
