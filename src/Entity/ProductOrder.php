<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductOrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductOrderRepository::class)]
#[ApiResource(
    normalizationContext:['groups'=>['product_orders']]
)]
class ProductOrder
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column]
    // #[Groups(['product','order','product_orders'])]
    // private ?int $id = null;

    #[ORM\Column]
    #[Groups(['product','order','product_orders'])]
    private ?int $qte = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'productOrders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order','product_orders'])]
    private ?Product $product = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'productOrders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['product','product_orders'])]
    private ?Order $order = null;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }
}
