<?php


namespace App\Controller;


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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Loader $loader)
    {
        $data = $loader->load();

        return $this->render('calendar/index.html.twig', ['data' => $data]);
    }

}
