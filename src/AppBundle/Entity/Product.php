<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Product
 *
 * @ORM\Table(name="Producto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_producto", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idProducto;

    /**
     * @var string
     *
     * @ORM\Column(name="clave_producto", type="string", length=255, unique=true)
     * @Assert\NotBlank
     */
    private $claveProducto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal", precision=19, scale=2)
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $precio;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->idProducto;
    }

    /**
     * Set claveProducto
     *
     * @param string $claveProducto
     *
     * @return Product
     */
    public function setClaveProducto($claveProducto)
    {
        $this->claveProducto = $claveProducto;

        return $this;
    }

    /**
     * Get claveProducto
     *
     * @return string
     */
    public function getClaveProducto()
    {
        return $this->claveProducto;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Product
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Product
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }
}
