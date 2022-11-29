<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;

class ProfileController extends AbstractController
{
    public function profile():void
    {


        $this->view->renderHtml('users/profile.php',
            [

            ]);
    }
}