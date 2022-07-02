<?php

namespace Alireza\Untitled\controllers;

use Alireza\Untitled\core\Controller;
use Alireza\Untitled\core\Request;

class SiteController extends Controller
{
    public function contact()
    {
        return $this->render('contact');
    }



    public function editProfile()
    {
        return $this->render('editProfile');
    }


    public function home()
    {
        $params= [
            "name" => "Alireza"
        ];
        return $this->render('home', $params);
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();

        return 'Handling submitted data';
    }
}