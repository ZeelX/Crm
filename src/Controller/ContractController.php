<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Contrat;
use App\Form\ContratType;
use App\Repository\ContratRepository;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contract')]
class ContractController extends AbstractController
{

    private ClientRepository $cr;
    private EntityManagerInterface $em;
    private ContratRepository $cor;

    /**
     * @param ClientRepository $cr
     * @param ContratRepository $cor
     * @param EntityManagerInterface $em
     */
    public function __construct(ClientRepository $cr,ContratRepository $cor, EntityManagerInterface $em)
    {
        $this->cr = $cr;
        $this->cor = $cor;
        $this->em = $em;

    }
    #[Route('/', name: 'app_contract_index', methods: ['GET'])]
    public function index(ContratRepository $contratRepository): Response
    {
        return $this->render('contract/index.html.twig', [
            'contrats' => $contratRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_contract_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContratRepository $contratRepository): Response
    {
        $contrat = new Contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contratRepository->add($contrat);
            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contract/new.html.twig', [
            'contrat' => $contrat,
            'form' => $form,
        ]);
    }

    #[Route('/new/{id}', name: 'app_contract_newWithClient', methods: ['GET', 'POST'])]
    public function newWithClient(Request $request, $id, ContratRepository $contratRepository): Response
    {
        $contrat = new Contrat();
        $client = $this->cr->findOneBy(array('id' => $id));
        $contrat->setClient($client);
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $contratRepository->add($contrat);
            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contract/new.html.twig', [
            'contrat' => $contrat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contract_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contrat $contrat, ContratRepository $contratRepository): Response
    {
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contratRepository->add($contrat);
            return $this->redirectToRoute('app_contract_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contract/edit.html.twig', [
            'contrat' => $contrat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contract_delete', methods: ['POST'])]
    public function delete(Request $request, Contrat $contrat, ContratRepository $contratRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contrat->getId(), $request->request->get('_token'))) {
            $contratRepository->remove($contrat);
        }

        return $this->redirectToRoute('app_contract_index', [], Response::HTTP_SEE_OTHER);
    }
}
