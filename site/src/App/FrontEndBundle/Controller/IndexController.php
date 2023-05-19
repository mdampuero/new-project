<?php

//
//  Created by Mauricio Ampuero <mdampuero@gmail.com> on 2021.
//  Copyright © 2021.
//

namespace App\FrontEndBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\BackEndBundle\Entity\Countries;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppFrontEndBundle:Index:index.html.twig');
    }

}