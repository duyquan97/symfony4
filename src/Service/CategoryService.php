<?php
namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CategoryService extends AbstractController
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;

    }

    public function getAllCategory(string $name): ?array
    {
        $data = $this->categoryRepository->createQueryBuilder('c');
        if (!empty($name)) {
            $data = $data->andWhere('c.name like :name')
                    ->setParameter('name','%'.$name.'%');
        }
        $data = $data->getQuery()
                ->getResult();
        return $data;
    }

    public function getCategory(int $id): ?Category
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            throw new EntityNotFoundException('Article with id '.$id.' does not exist!');
        }
        return $category;
    }

    public function addCategory(string $name, string $description): Category
    {
        $slugify = new Slugify();
        $category = new Category();
        $category->setName($name);
        $category->setSlug($slugify->slugify($name));
        $category->setDescription($description);;
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->flush();
        return $category;
    }

    public function updateCategory(int $id, string $name, string $description): ?Category
    {
        $slugify = new Slugify();
        $category = $this->categoryRepository->find($id);
        $category->setName($name);
        $category->setSlug($slugify->slugify($name));
        $category->setDescription($description);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $category;
    }

    public function deleteCategory(int $id): void
    {
        $category = $this->categoryRepository->find($id);
        if ($category) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }
        return;
    }

}
