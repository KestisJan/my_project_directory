<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class BlogApiController extends AbstractController
{
    private array $posts = [
        1 => ['id' => 1, 'title' => 'First Post', 'content' => 'Content of the first post'],
        2 => ['id' => 2, 'title' => 'Second Post', 'content' => 'Content of the second post'],
    ];

    #[Route('/api/posts/{id}', methods: ['GET', 'HEAD'])]
    public function show(int $id): Response
    {
        if (!isset($this->posts[$id])) {
            return new JsonResponse(['error' => 'Post not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($this->posts[$id]);
    }

    #[Route('/api/posts/{id}', methods: ['PUT'])]
    public function edit(int $id, Request $request): Response
    {
        $post = $this->posts[$id] ?? null;

        if ($post === null) {
            return new JsonResponse(['error' => 'Post not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        $this->posts[$id]['title'] = $data['title'] ?? $this->posts[$id]['title'];
        $this->posts[$id]['content'] = $data['content'] ?? $this->posts[$id]['content'];

        return new JsonResponse($this->posts[$id]);
    }
}