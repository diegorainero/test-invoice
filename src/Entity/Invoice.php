<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="date")
     */
    public $invoice_date;

    /**
     * @ORM\Column(type="integer")
     */
    public $invoice_number;

    /**
     * @ORM\Column(type="integer")
     */
    public $invoice_client_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InvoiceRow", mappedBy="invoice", cascade={"persist"})
     */
    public $invoiceRow;


    public function __construct()
    {
        $this->invoiceRow = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceDate(): ?\DateTimeInterface
    {
        return $this->invoice_date;
    }

    public function setInvoiceDate(\DateTimeInterface $invoice_date): self
    {
        $this->invoice_date = $invoice_date;

        return $this;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoice_number;
    }

    public function setInvoiceNumber(int $invoice_number): self
    {
        $this->invoice_number = $invoice_number;

        return $this;
    }

    public function getInvoiceClientId(): ?int
    {
        return $this->invoice_client_id;
    }

    public function setInvoiceClientId(int $invoice_client_id): self
    {
        $this->invoice_client_id = $invoice_client_id;

        return $this;
    }

    public function getInvoiceRow(): Collection
    {
        return $this->invoiceRow;
    }

    
    public function setInvoiceRow(Collection $invoiceRow)
    {
        foreach($invoiceRow as $iR){
            $iR->setInvoice($this);
            
        }
        $this->invoiceRow = $invoiceRow;
        
    }

    public function removeInvoiceRows(InvoiceRow $invoicerows)
    {
        // ...
    }
}
