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

        if ($category->getType() === CategoryTypeEnum::CONTAINER->value) {
            return $this->render('recipeCatalog/categories_list.html.twig', [
                'catalog' => [
                    'isRoot' => $isRoot,
                    'title' => $category->getTitle(),
                    'categories' => $isRoot ?
                        $this->recipeCatalogRepository->findAllRootChildren() :
                        $category->getChildren(),
                    'parent' => $category->getParent(),
                ],
                'workspace' => [],
            ]);
        }

        if ($category->getType() === CategoryTypeEnum::RECIPE->value) {
            return $this->render('recipeCatalog/category.html.twig', [
                'catalog' => [
                    'isRoot' => $category->getParent()?->getParent() === null ?? true,
                    'title' => $category->getParent()?->getTitle(),
                    'categories' => ($category->getParent()?->getParent() === null ?? true) ?
                        $this->recipeCatalogRepository->findAllRootChildren() :
                        $category->getParent()->getChildren(),
                    'parent' => $category->getParent()?->getParent(),
                ],
                'workspace' => [
                    'category' => $category,
                ],
            ]);
        }

        throw new Exception('Unknown category type');
    }
}
