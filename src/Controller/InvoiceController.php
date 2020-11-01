<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\InvoiceRow;
use App\Form\Type\InvoiceType;
use App\Controller\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class InvoiceController extends Controller
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $allInvoices;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->allInvoices = $entityManager->getRepository('App:Invoice');
        $this->logger = $logger;
    }

    /**
     * @Route("/", name="home")
     * @Route("/invoice", name="invoice")
     */
    public function index()
    {
        $invoices = $this->allInvoices->findAll();
        //$this->logger->debug(sprintf('Invoices was set to %s', var_dump($invoices)));
        return $this->render('invoice/index.html.twig', [
            'Invoices' => $invoices,
        ]);
    }


    /**
     * @Route("/invoice/add", name="add")
     */
    public function add(Request $request)
    {
        $defaultData = ['message' => 'Type your message here'];
        
        $today = new \DateTime();
        $invoice = new Invoice();

        // dummy code - add some example tags to the task
        // (otherwise, the template will render an empty list of tags)
        // $art1 = new InvoiceRow();
        // $art1->setDescription('Article1');
        // $invoice->getInvoiceRow()->add($art1);
        // end dummy code


        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

            try {
                // We take the submitted datas
                $invoice = $form->getData();

                $invoiceRows = new ArrayCollection();

                
                // Save the invoice on database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($invoice);

                $entityManager->flush();
                

                $this->addFlash('success','Great - Invoice number ' . $invoice->getId() . ' created!!');
           
            } catch (\Exception $e) {
                $this->addFlash('error','Error - Invoice not created created!!' . $e->getMessage());
            }

            
            return $this->redirectToRoute('invoice');
        }

        return $this->render('invoice/new.html.twig', [
            'form' => $form->createView(),
        ]);
        // ...
    }

    /**
     * @Route("/invoice/{id}/edit", name="edit" , methods={"GET", "POST"})
     */
    public function edit($id, Request $request, EntityManagerInterface $entityManager)
    {
        if (null === $invoice = $entityManager->getRepository(Invoice::class)->find($id)) {
            throw $this->createNotFoundException('No task found for id '.$id);
        }
        

        // dummy code - add some example tags to the task
        // (otherwise, the template will render an empty list of tags)
        // $art1 = new InvoiceRow();
        // $art1->setDescription('Article1');
        // $invoice->getInvoiceRow()->add($art1);
        // end dummy code

        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // We take the submitted datas
                $invoice = $form->getData();

                $invoiceRows = new ArrayCollection();

                
                // Save the invoice on database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($invoice);

                $entityManager->flush();
                

                $this->addFlash('success','Great - Invoice number ' . $invoice->getId() . ' changed!!');
           
            } catch (\Exception $e) {
                $this->addFlash('error','Error - Invoice not created created!!' . $e->getMessage());
            }

            
            return $this->redirectToRoute('invoice');
        }

        return $this->render('invoice/edit.html.twig', [
            'form' => $form->createView(),
            'id'=> $invoice->getId()
        ]);
        // ...
    }

    /**
     * @Route("/invoice/delete/{id}", name="delete", methods={"GET", "POST"})
     */
    public function delete($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (null === $invoice = $entityManager->getRepository(Invoice::class)->find($id)) {
            throw $this->createNotFoundException('No task found for id '.$id);
        }
        $entityManager->remove($invoice);
        $entityManager->flush();
        
        $this->addFlash('success','Great - Invoice number ' . $invoice->getId() . ' deleted!!');

        return $this->redirectToRoute('invoice');
    }
}
