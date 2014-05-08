<?php

class ViewfilesController extends Controller
{
    public function actionIndex()
    {
        header("Location: ./data/".$_GET['path']);
    }
}
?>
