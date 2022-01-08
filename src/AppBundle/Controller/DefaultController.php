<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Doctrine\ORM\Query\ResultSetMapping;
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

        try {
            $em = $this->getDoctrine()->getManager();
            $query = $em->getConnection()->prepare("call store_product(:clave, :nombre, :precio)");
            $query->bindValue('clave', $body['clave_producto']);
            $query->bindValue('nombre', $body['nombre']);
            $query->bindValue('precio', $body['precio']);

            $query->execute();
            $em->flush();
        } catch (\Throwable $th) {
            return $this->render('create.html.twig', [
                'error' => 'Clave de producto duplicada',
                'old' => $body
            ]);
        }

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        return $this->render('edit.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/products/{id}", name="update")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request, $id)
    {
        $body = $request->request->all();
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        $product->setNombre($body['nombre']);
        $product->setPrecio($body['precio']);

        $em->flush();

        return $this->redirectToRoute('home');
    }


    /**
     * @Route("/products/{id}", name="delete")
     * @Method({"DELETE"})
     */
    public function destroyAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        $em->remove($product);
        $em->flush();
        return new Response('Product deleted');
    }
}
