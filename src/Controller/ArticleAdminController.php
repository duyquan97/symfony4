<?php
namespace App\Controller;
use App\Entity\Category;
use App\Form\ArticleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/article/new", name="article_new")
     *
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $article = new Category();
            $article->setName($data['name']);
            $article->setDescription($data['description']);
            $article->setSlug(str_replace('','-',$data['name']));
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('category_index');
        }
        return $this->render('form/new.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

}