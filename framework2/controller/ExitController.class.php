<?php


class ExitController extends Controller
{
    function index($data)
    {
        $_SESSION['login'] = null;
        $this->redirection = new IndexController();
    }
}