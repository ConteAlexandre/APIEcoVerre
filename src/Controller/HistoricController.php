<?php

namespace App\Controller;

use App\Repository\HistoricRepository;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 *
 * @Route(path="/historic")
 */
class HistoricController
{
    private $historiqueRepository;

    public function __construct(HistoricRepository $historicRepository)
    {
        $this->historiqueRepository = $historicRepository;
    }

    /**
     * @OA\Post(
     *     path="/historic/create",
     *     tags={"Historic"},
     *     security={"bearer"},
     *     @OA\Response(
     *          response="200",
     *          description="add the new historic",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Historic"))
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     *
     * @Route("/create", name="add_historic", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addHistoric(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['usersId']) || empty($data['glassDumpId']) || empty($data['isFull']) || empty($data['isDamage']) || empty($data['isCheck']))
        {
            return new JsonResponse('Missing parameter - please try again');
        }

        $usersId = $data['usersId'];
        $glassDumpId = $data['glassDumpId'];
        $isFUll = $data['isFull'];
        $isDamage = $data['isDamage'];
        $isCheck = $data['isCheck'];

        $this->historiqueRepository->saveHistoric($usersId, $glassDumpId, $isFUll, $isDamage, $isCheck);
        $reponse= new JsonResponse(['status' => 'new historic created !'], Response::HTTP_CREATED);
        $reponse->headers->set('Access-Control-Allow-Origin', '*');
        return $reponse;

    }

    /**
     * @OA\Get(
     *     path="/historic/show/{id}",
     *     tags={"Historic"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="view a historic with id",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Historic"))
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     * @Route("/show/{id}", name="get_one_historic", methods={"GET"})
     */
    public function getOneHist($id)
    {
        $hist = $this->historiqueRepository->findOneBy(['id' => $id]);
        if(!empty($hist))
        {
            $data = [
                'id' => $hist->getId(),
                'userId' => $hist->getUserId(),
                'glassDumpId' => $hist->getGlassdumpId(),
                'isFull' => $hist->getIsFull(),
                'isDamage' => $hist->getIsDamage(),
                'isCheck' => $hist->getIsCheck(),
                'createdAt' => $hist->getCreatedAt(),
                'updatedAt' => $hist->getUpdatedAt()
            ];
            $reponse= new JsonResponse(['status' => $data], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }else {
            $reponse= new JsonResponse(['erreur' => "Not valid Id"], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }

    /**
     * @OA\Get(
     *     path="/historic/list",
     *     tags={"Historic"},
     *     security={"bearer"},
     *     @OA\Response(
     *          response="200",
     *          description="view a historic with id",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Historic"))
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     * @Route("/list", name="get_all_hist", methods={"GET"})
     */
    public function getAllHist(): JsonResponse
    {
        $hists = $this->historiqueRepository->findAll();
        if (!empty($hists)) {
            foreach ($hists as $hist) {
                $data[] = [
                    'id' => $hist->getId(),
                    'userId' => $hist->getUserId(),
                    'glassDumpId' => $hist->getGlassdumpId(),
                    'isFull' => $hist->getIsFull(),
                    'isDamage' => $hist->getIsDamage(),
                    'isCheck' => $hist->getIsCheck(),
                    'createdAt' => $hist->getCreatedAt(),
                    'updatedAt' => $hist->getUpdatedAt()
                ];
            }
            $reponse = new JsonResponse(['status ' => $data], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse = new JsonResponse(['erreur ' => 'No data'], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }

    /**
     * @OA\Put(
     *     path="/historic/update/{id}",
     *     tags={"Historic"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="update historic",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Historic"))
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     *
     * @Route("/update/{id}", name="update_hist", methods={"PUT"})
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updateHist($id, Request $request)
    {
        $hist = $this->historiqueRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);
        if(!empty($hist) && !empty($data))
        {
            $this->historiqueRepository->updateHist($hist, $data);
            $reponse= new JsonResponse(['status' => 'Historic update !']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }else {
            $reponse= new JsonResponse(['erreur' => 'Not valid data given']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }
    /**
     * @OA\Delete(
     *     path="/historic/delete/{id}",
     *     tags={"Historic"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="update historic",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Historic"))
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     *
     * @Route("/delete/{id}", name="delete_dump", methods={"DELETE"})
     */
    public function deleteHist($id)
    {
        $hist = $this->historiqueRepository->findOneBy(['id' => $id]);
        if (!empty($id))
        {
            $this->historiqueRepository->deleteHist($hist);
            $reponse= new JsonResponse(['status' => 'Historic deleted']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse= new JsonResponse(['erreur' => 'Not valid Id']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }



}