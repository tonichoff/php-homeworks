<?php

namespace App\Controllers;

class ProfileController extends Controller
{
    public function actionProfile($params)
    {
        echo "<p>Action profile was run</p>";
        echo "<p>User id: $params[0]</p>";
    }
}