<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/users")
 */
class UsersController
{
    private $userRepository;

    public function __construct(UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route(path="/create", name="add_users", methods="POST")
     */
    public function addUsers(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if(empty($data['username']) || empty($data['mail']) || empty($data['password']) || empty($data['token']) || empty($data['addr']) || empty($data['role']))
        {
            return new JsonResponse('Missing parameter - please try again');
        }

        $username = $data['username'];
        $mail = $data['mail'];
        $password = $data['password'];
        $token = $data['token'];
        $addr = $data['addr'];
        $role = $data['role'];

        $this->userRepository->saveUser($username, $mail , $password, $token, $addr, $role);

        $reponse= new JsonResponse(['status' => 'new users created !'], Response::HTTP_CREATED);
        $reponse->headers->set('Access-Control-Allow-Origin', '*');
        return $reponse;
    }

    /**
     * @Route("/show/{id}", name="get_one_users", methods={"GET"})
     */
    public function getOneUsers($id)
    {
        $users = $this->userRepository->findOneBy(['id'=>$id]);
        if (!empty($users))
        {
            $data = [
                'id' => $users->getId(),
                'username'=> $users->getUsername(),
                'mail' => $users->getMail(),
                'password' => $users->getPassword(),
                'token' => $users->getToken(),
                'addr' => $users->getAdress(),
                'role' => $users->getRole(),
                'isEnable' => $users->getIsEnable(),
                'createdAt' => $users->getCreatedAt(),
                'updatedAt' => $users->getUpdatedAt()
            ];

            $reponse= new JsonResponse(['status' => $data], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse= new JsonResponse(['erreur' => "Not valid Id"], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }

    }

    /**
     * @Route("/list", name="get_all_users", methods={"GET"})
     */
    public function getAllUsers(): JsonResponse
    {
        $users = $this->userRepository->findAll();
        if (!empty($users)) {
            foreach ($users as $user) {
                $data [] = [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'mail' => $user->getMail(),
                    'password' => $user->getPassword(),
                    'token' => $user->getToken(),
                    'addr' => $user->getAdress(),
                    'role' => $user->getRole(),
                    'isEnable' => $user->getIsEnable(),
                    'createdAt' => $user->getCreatedAt(),
                    'updatedAt' => $user->getUpdatedAt()
                ];
            }

            $reponse= new JsonResponse(['status ' => $data], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse= new JsonResponse(['erreur ' => 'No data'], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }

    /**
     * @Route("/update/{id}", name="update_users", methods={"PUT"})
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updateUsers($id, Request $request)
    {
        $users = $this->userRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        if (!empty($users) && !empty($data)) {
            $this->userRepository->updateUser($users, $data);
            $reponse= new JsonResponse(['status' => 'Users update !']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse= new JsonResponse(['erreur' => 'Not valid data given']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }
    /**
     * @Route("/delete/{id}", name="delete_users", methods={"DELETE"})
     */
    public function deleteUsers($id)
    {
        if (!is_string($id) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $id) !== 1)) {
            $reponse= new JsonResponse(['status' => "not the good format of id"], Response::HTTP_OK);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
        $users = $this->userRepository->findOneBy(['id' => $id]);
        if (!empty($users)) {
            $this->userRepository->deleteUser($users);
            $reponse= new JsonResponse(['status' => 'Users deleted']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        } else {
            $reponse= new JsonResponse(['erreur' => 'Not valid Id']);
            $reponse->headers->set('Access-Control-Allow-Origin', '*');
            return $reponse;
        }
    }



}