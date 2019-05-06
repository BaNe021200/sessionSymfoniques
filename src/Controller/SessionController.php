<?php

namespace App\Controller;

use App\Services\Cookies\Cookie_UserKey;
use App\Services\CookiesActions;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SessionController
 * @package App\Controller
 * @Route("/session")
 */
class SessionController extends AbstractController
{

    /**
     * @var RequestStack
     */
    private $requestStack;


    /**
     * SessionController constructor.
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {


        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/index", name="session.index")
     * @return Response
     */
    public function index()
    {


        return $this->render('session/index.html.twig');

    }

    /**
     * @Route("/defineCookie",name="session.define")
     * @param CookiesActions $cookiesActions
     * @return RedirectResponse
     */
    public function defineCookie(CookiesActions $cookiesActions)
    {
        $cookiesActions->createCookie('cookieTest','cookieTest');

        return $this->redirectToRoute('session.test');

    }


    /**
     * @Route("/test1",name="session.test")
     * @param CookiesActions $cookiesActions
     * @return Response
     */
    public function test1(CookiesActions $cookiesActions)
    {
        $cookie = $cookiesActions->getCookie('cookieTest');
        dump($cookie);

        return $this->render('session/test1.html.twig', [

            'cookie' => $cookie,

        ]);
    }

    /**
     * @param CookiesActions $cookiesActions
     * @return Response
     * @Route("/test1/remove",name="remove.cookie")
     */
    public function removeCookie(CookiesActions $cookiesActions)
    {
       $cookiesActions->destroyCookie('cookieTest');



        return $this->redirectToRoute('session.test');
    }

}
