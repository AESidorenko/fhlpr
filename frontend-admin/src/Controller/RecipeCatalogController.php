<?php

namespace App\Controller;

use App\Entity\RecipeCatalog;
use App\Entity\RecipeCatalog\CategoryTypeEnum;
use App\Repository\RecipeCatalogRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class RecipeCatalogController extends AbstractController
{

    public function __construct(
        private readonly RecipeCatalogRepository $recipeCatalogRepository,
    )
    {
    }

    /**
     * @throws Exception
     */
    #[Route('/recipe/catalog/{categoryId}', name: 'app_recipe_catalog')]
    public function index(int $categoryId = null): Response
    {
        $isRoot = $categoryId === null;

        $category = $isRoot ?
            new RecipeCatalog(CategoryTypeEnum::CONTAINER->value) :
            $this->recipeCatalogRepository->findOneBy(['id' => $categoryId]);
        if (!$category) {
            throw new NotFoundHttpException('Category not found');
        }

        return match ($category->getType()) {
            CategoryTypeEnum::CONTAINER->value => $this->render('recipeCatalog/categories_list.html.twig', [
                'isRoot' => $isRoot,
                'title' => $category->getTitle(),
                'categories' => $isRoot ?
                    $this->recipeCatalogRepository->findAllRootChildren() :
                    $category->getChildren(),
                'parent' => $category->getParent(),
            ]),
            CategoryTypeEnum::RECIPE->value => $this->render('recipeCatalog/category.html.twig', [
                'isRoot' => $isRoot,
                'title' => $category->getTitle(),
                'parent' => $category->getParent(),
            ]),
            default => throw new Exception('Unknown category type'),
        };
    }
}
