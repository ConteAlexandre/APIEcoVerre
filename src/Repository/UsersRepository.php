<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Users::class);
        $this->manager = $manager;
    }

    public function saveUser($username, $mail , $password, $token, $addr, $role)
    {
        $newUsers = new Users();

        empty($username) ? true : $newUsers->setUsername($username);
        empty($mail) ? true : $newUsers->setMail($mail);
        empty($password) ? true : $newUsers->setPassword($password);
        empty($token) ? true : $newUsers->setToken($token);
        empty($addr) ? true : $newUsers->setAdress($addr);
        empty($role) ? true : $newUsers->setRole($role);
        $newUsers->setIsEnable(true);

        $this->manager->persist($newUsers);
        $this->manager->flush();
    }

    public function updateUser(Users $users, $data)
    {
        empty($data['username']) ? true : $users->setUsername($data['username']);
        empty($data['mail']) ? true : $users->setMail($data['mail']);
        empty($data['password']) ? true : $users->setPassword($data['password']);
        empty($data['token']) ? true : $users->setToken($data['token']);
        empty($data['addr']) ? true : $users->setAdress($data['addr']);
        empty($data['role']) ? true : $users->setRole($data['role']);
        $users->setUpdatedAt(new \DateTime("now"));
        $this->manager->flush();
    }

    public function deleteUser(Users $users)
    {
        $this->manager->remove($users);
        $this->manager->flush();
    }


    // /**
    //  * @return Users[] Returns an array of Users objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Users
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
