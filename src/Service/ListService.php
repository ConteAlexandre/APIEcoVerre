<?php


namespace App\Service;


class ListService
{
    public function listObject($object)
    {
        foreach ($object as $value){
            print_r($value);
        }

    }

}