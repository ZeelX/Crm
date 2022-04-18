<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Form\SearchNameEntrepriseType;
use App\Form\SearchType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ClientController extends AbstractController
{
    private ClientRepository $cr;
    private EntityManagerInterface $em;

    /**
     * @param ClientRepository $cr
     * @param EntityManagerInterface $em
     */
    public function __construct(ClientRepository $cr, EntityManagerInterface $em)
    {
        $this->cr = $cr;
        $this->em = $em;
    }

    #[Route('/', name: 'app_client_index', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {

        $clients = $this->cr->findAll();

        $findForm = $this->createForm(SearchNameEntrepriseType::class);
        $findForm->handleRequest($request);
        if ($findForm->isSubmitted() && $findForm->isValid()) {
            $value = $findForm->get('nom')->getData();
            $clients = $this->cr->findBySearchedField($value);
        }

        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $secteurs = $form->get('secteur')->getData();
            $clients = $this->cr->findWithSector($secteurs);
        }

        return $this->render('client/index.html.twig', [
            'clients' => $clients,
            'form' => $form->createView(),
            'formSearch' => $findForm->createView(),
        ]);
    }

    #[Route('/new', name: 'app_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ClientRepository $clientRepository): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientRepository->add($client);
            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/new.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_show', methods: ['GET', 'POST'])]
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            'client' => $client,
        ]);
    }

    #[Route('/{id}/data', name: 'app_client_data', methods: ['GET'])]
    public function clientData(Client $client): Response
    {
        return $this->render('client/data.html.twig', [
            'client' => $client,
        ]);
    }
    #[Route('/{id}/data/download', name: 'app_client_data_download', methods: ['GET'])]
    public function clientDataDownload(Client $client): Response
    {
        return $this->render('client/data.html.twig', [
            'client' => $client,
        ]);
    }

        #[Route('/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, ClientRepository $clientRepository): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientRepository->add($client);
            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/edit.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_client_delete', methods: ['POST'])]
    public function delete(Request $request, Client $client, ClientRepository $clientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $clientRepository->remove($client);
        }

        return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
