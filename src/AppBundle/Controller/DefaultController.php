<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/products", name="products")
     */
    public function productsAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);

        $products = $repository->findAll();
        $products = $this->get('serializer')->serialize($products, 'json');

        return new JsonResponse($products, 200, [], true);
    }


    /**
     * @Route("/create", name="create")
     */
    public function createAction(Request $request)
    {
        return $this->render('create.html.twig');
    }

    /**
     * @Route("/store", name="store")
     * @Method({"POST"})
     */
    public function storeAction(Request $request)
    {

        $body = $request->request->all();

        $product = new Product();
        $product->setClaveProducto($body['clave_producto']);
        $product->setNombre($body['nombre']);
        $product->setPrecio($body['precio']);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($product);
        $manager->flush();

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editAction(Request $request, $id)
    {
        return $this->render('edit.html.twig');
    }

    // TODO update method

    /**
     * @Route("/products/{id}", name="delete")
     * @Method({"DELETE"})
     */
    public function destroyAction(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $product = $manager->getRepository(Product::class)->find($id);
        $manager->remove($product);
        $manager->flush();
        return new Response('Product deleted');
    }
}
