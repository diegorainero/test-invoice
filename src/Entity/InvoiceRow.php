<?php

namespace App\Entity;

use App\Repository\InvoiceRowRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=InvoiceRowRepository::class)
 */
class InvoiceRow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="text")
     */
    public $description;

    /**
     * @ORM\Column(type="integer")
     */
    public $quantity;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     */
    public $price;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     */
    public $vat_price;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     */
    public $total_price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Invoice", inversedBy="invoiceRow")
     */
    public $invoice;

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function getInvoiceRow(): Collection
    {
        return $this->invoiceRow;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceId(): ?int
    {
        return $this->invoice_id;
    }

    public function setInvoiceId(int $invoice_id): self
    {
        $this->invoice_id = $invoice_id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getVatPrice(): ?string
    {
        return $this->vat_price;
    }

    public function setVatPrice(string $vat_price): self
    {
        $this->vat_price = $vat_price;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->total_price;
    }

    public function setTotalPrice(string $total_price): self
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function setInvoice(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
}
