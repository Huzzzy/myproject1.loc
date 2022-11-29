<?php

namespace MyProject\Controllers;

class ProfileController extends AbstractController
{
    public function profile()
    {
        $this->view->renderHtml('users/profile.php', []);
    }
}