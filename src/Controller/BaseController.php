<?php


namespace App\Controller;


use App\Services\GetData;
use App\Services\Loader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/***
 * Class BaseController
 * @package App\Controller
 */
class BaseController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param GetData $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(GetData $data)
    {
        $calendar = $data->getAllData();

        return $this->render('calendar/index.html.twig', ['data' => $calendar]);
    }

}
