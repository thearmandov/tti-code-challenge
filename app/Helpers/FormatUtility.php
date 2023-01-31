<?php

namespace App\Helpers;

class FormatUtility
{
    public function formatJsonResponse($object, $data)
    {
        return [ $object => $data ];
    }

}