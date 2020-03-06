<?php
class ExitController extends Controller
{
    function index($data)
    {
        UserModel::exit_account();
        header("Location: index.php");
    }
}