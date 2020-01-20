<?php

namespace App\Controller;

use App\Repository\GlassDumpRepository;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;


/**
 * @package App\Controller
 *
 * @Route(path="/glassdump")
 */
class GlassDumpController
{
    private $glassDumpRepository;

    public function __construct(GlassDumpRepository $glassDumpRepository)
    {
        $this->glassDumpRepository = $glassDumpRepository;
    }

    /**
     * @OA\Post(
     *     path="/glassdump/create",
     *     tags={"GlassDump"},
     *     @OA\Response(
     *          response="200",
     *          description="Add the new glassdump",
     *          @OA\JsonContent(type="array",  @OA\Items(ref="#/components/schemas/GlassDumpSingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     )
     * )
     *
     * @Route("/create", name="add_glassDump", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addGlassDump(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['numBorn']) || empty($data['volume']) || empty($data['landMark']) || empty($data['collectDay']) || empty($data['coordinates']) || empty($data['nameCity']) || empty($data['countryCode'])) {
            return new JsonResponse('Missing parameter - please try again');
        }

        $numBorn = $data['numBorn'];
        $volume = $data['volume'];
        $landMark = $data['landMark'];
        $collectDay = $data['collectDay'];
        $coordonate = $data['coordinates'];
        $nameCity = $data['nameCity'];
        $countryCode = $data['countryCode'];

        $dump = $this->glassDumpRepository->findBy(['coordonate' => "POINT($coordonate)"]);

        if (empty($dump)) {
            $this->glassDumpRepository->saveDump($numBorn, $volume, $landMark, $collectDay, $coordonate, $nameCity, $countryCode);
            $reponse = new JsonResponse(['status' => 'new glass dump created !'], Response::HTTP_CREATED);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse = new JsonResponse('glass dump already exist');
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }

    /**
     * @OA\Get(
     *     path="/glassdump/show/{id}",
     *     tags={"GlassDump"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="GlassDump",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GlassDumpSingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     * @Route("/show/{id}", name="get_one_dump", methods={"GET"})
     */
    public function getOneDump($id)
    {
        if (!is_string($id) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $id) !== 1)) {
            $reponse = new JsonResponse(['status' => "not the good format of id"], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }

        $dump = $this->glassDumpRepository->findOneBy(['id' => $id]);
        if (!empty($dump)) {
            $data = [
                'id' => $dump->getId(),
                'numBorn' => $dump->getNumberBorne(),
                'volume' => $dump->getVolume(),
                'landMark' => $dump->getLandmark(),
                'collectDay' => $dump->getCollectDay(),
                'coordinate' => $dump->getCoordonate(),
                'damage' => $dump->getDammage(),
                'isFull' => $dump->getIsFull(),
                'isEnable' => $dump->getIsEnable(),
                'nameCity' => $dump->getCityName(),
                'countryCode' => $dump->getCountryCode(),
                'createdAt' => $dump->getCreatedAt(),
                'updatedAt' => $dump->getUpdatedAt(),
            ];
            $bens = "";
            foreach ($data as $ben) {
                $bens .= $GeoJsonLine = '
                    { "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [' . $ben['coordonate'] . ']
                        },
                        "properties": {
                            "commune": "' . $ben['commune'] . '",
                            "adresse": "' . $ben['landMark'] . '",
                            "code_com": "' . $ben['code_com'] . '"
                        }
                    },';
            }

            $bens = substr($bens, 0, -1);


            $reponse = JsonResponse::fromJsonString('{ "type": "FeatureCollection",
                "features": ['.$bens.']}');
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse = new JsonResponse(['erreur' => "Not valid Id"], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }

    /**
     * @OA\Get(
     *     path="/glassdump/list",
     *     tags={"GlassDump"},
     *     @OA\Response(
     *          response="200",
     *          description="This GlassDump",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GlassDumpList"))
     *     )
     * )
     * @Route("/list", name="get_all_dump", methods={"GET"})
     */
    public function getAllDump(): JsonResponse
    {
        $dumps = $this->glassDumpRepository->findAll();
        if (!empty($dumps)) {
            foreach ($dumps as $dump) {
                $data[] = [
                    'id' => $dump->getId(),
                    'numBorn' => $dump->getNumberBorne(),
                    'volume' => $dump->getVolume(),
                    'landMark' => $dump->getLandmark(),
                    'collectDay' => $dump->getCollectDay(),
                    'coordonate' => $dump->getCoordonate(),
                    'commune' => $dump->getCityName(),
                    'code_com' => $dump->getCountryCode(),
                    'damage' => $dump->getDammage(),
                    'isFull' => $dump->getIsFull(),
                    'isEnable' => $dump->getIsEnable(),
                    'city_name' => $dump->getCityName(),
                    'country_code' => $dump->getCountryCode(),
                    'createdAt' => $dump->getCreatedAt(),
                    'updatedAt' => $dump->getUpdatedAt(),
                ];

            }
            $bens = "";
            foreach ($data as $ben) {
               $bens .= $GeoJsonLine = '
                    { "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [' . $ben['coordonate'] . ']
                        },
                        "properties": {
                            "commune": "' . $ben['commune'] . '",
                            "adresse": "' . $ben['landMark'] . '",
                            "code_com": "' . $ben['code_com'] . '"
                        }
                    },';
            }

            $bens = substr($bens, 0, -1);


            $reponse = JsonResponse::fromJsonString('{ "type": "FeatureCollection",
                "features": ['.$bens.']}');
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
     *     path="/glassdump/update/{id}",
     *     tags={"GlassDump"},
     *     security={"bearer"},
     *     @OA\RequestBody(ref="#/components/requestBodies/CreateUpdateGlassDump"),
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="Update Reussi",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GlassDumpSingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     )
     * )
     * @Route("/update/{id}", name="update_dump", methods={"PUT"})
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updateDump($id, Request $request)
    {
        if (!is_string($id) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $id) !== 1)) {
            $reponse = new JsonResponse(['status' => "not the good format of id"], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
        $dump = $this->glassDumpRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);
        if (!empty($dump) && !empty($data)) {
            $this->glassDumpRepository->updateDump($dump, $data);
            $reponse = new JsonResponse(['status' => 'GlassDump update !']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse = new JsonResponse(['erreur' => 'Not valid data given']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }

    /**
     * @OA\Delete(
     *     path="/glassdump/delete/{id}",
     *     tags={"GlassDump"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="Delete Reussi",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GlassDumpSingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     )
     * )
     * @Route("/delete/{id}", name="delete_dump", methods={"DELETE"})
     */
    public function deleteDump($id) //faire sécurité admin
    {
        if (!is_string($id) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $id) !== 1)) {
            $reponse = new JsonResponse(['status' => "not the good format of id"], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
        $dump = $this->glassDumpRepository->findOneBy(['id' => $id]);
        if (!empty($dump)) {
            $this->glassDumpRepository->deleteDump($dump);
            $reponse = new JsonResponse(['status' => 'GlassDump deleted']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse = new JsonResponse(['erreur' => 'Not valid Id']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }

    /**
     * @OA\Post(
     *     path="/glassdump/createFromFile",
     *     tags={"GlassDump"},
     *     security={"bearer"},
     *     @OA\RequestBody(ref="#/components/requestBodies/CreateUpdateGlassDump"),
     *     @OA\Response(
     *          response="200",
     *          description="File update",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GlassDumpSingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     )
     * )
     * @Route("/createFromFile", name="add_glassDumps", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addGlassDumpFromFile(Request $request)
    {
        $parsed_json = json_decode($request->getContent(), true);
        $info = $parsed_json{"features"};
        $dumps = $this->glassDumpRepository->savedumpfile($info);


        $reponse = new JsonResponse(['status' => $dumps], Response::HTTP_CREATED);
        $reponse->headers->set('Access-Control-Allow-Origin', '*');
        return $reponse;
    }

    /**
     * @Route("/dumpNextTo/{gps}", name="get_glassDumps_next", methods={"GET"})
     */
    public function getByGPS($gps)
    {
        $rayon = 2000;
        $dumps = $this->glassDumpRepository->nextToCoord($gps, $rayon);
        if ($dumps === false) {
            $reponse = new JsonResponse(['erreur' => $dumps], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse = new JsonResponse(['status' => $dumps], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }

    /**
     * @Route("/dumpIn/{city}", name="get_glassDumps_city", methods={"GET"})
     */
    public function getByCity($city)
    {
        if (!empty(is_string($city))) {
            $city = ucfirst(strtolower($city));
            $dumps = $this->glassDumpRepository->inCity($city);

            if ($dumps === false) {
                $reponse = new JsonResponse(['erreur' => "Wrong city name"], Response::HTTP_OK);
                $reponse->headers->set('Access-Control-Allow-Origin', '*');
                return $reponse;
            } else {
                $reponse = new JsonResponse(['status' => $dumps], Response::HTTP_OK);
                $reponse->headers->set('Access-Control-Allow-Origin', '*');
                return $reponse;
            }
        } else {
            $reponse = new JsonResponse(['erreur' => "Wrong city name"], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }
}