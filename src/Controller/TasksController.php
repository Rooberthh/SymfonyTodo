<?php

namespace App\Controller;

use App\Entity\Tasks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    /* @Route('/tasks', methods={GET})*/
    public function indexAction()
    {
        $tasks = $this->getDoctrine()->getRepository(Tasks::class)->findAll();

        return $this->render('tasks/index.html.twig', [
            'tasks' => $tasks
        ]);
    }

    /* @Route('/tasks', methods={POST})
     * @param Request $request
     * @return Response
     */
    public function storeAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $task = new Tasks();
        $task->setTitle($data['title']);
        $task->setDescription($data['description']);
        $task->setCreatedAt(new \DateTime());
        $task->setUpdatedAt(new \DateTime());

        $entityManager->persist($task);
        $entityManager->flush();

        return new JsonResponse(
            array(
            'title' => $task->getTitle(),
            'description' => $task->getDescription())
            , '200');
    }

    /* @Route('/tasks/{id}', methods={PATCH})
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function updateAction($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $repository = $this->getDoctrine()->getRepository(Tasks::class);
        $task = $repository->find($id);

        $task->setTitle($data['title']);
        $task->setDescription($data['description']);

        $entityManager->persist($task);
        $entityManager->flush();

        return new response('Task have been updated', 200);
    }

    /* @Route('/tasks/{id}', methods={DELETE})
     * @param $id
     * @return Response
     */
    public function destroyAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $task = $this->getDoctrine()->getRepository(Tasks::class)->find($id);

        $entityManager->remove($task);
        $entityManager->flush();

        return new response('Deleted', 200);


    }
}
