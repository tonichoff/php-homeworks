<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 04.09.18
 * Time: 15:20
 */

class ProfileController
{
    public function __construct()
    {

    }

    public function actionProfile($params)
    {
        echo "<p>Action profile was run</p>";
        echo "<p>User id: $params[0]</p>";
    }
}