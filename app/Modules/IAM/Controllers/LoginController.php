<?php

namespace BIMS\Modules\IAM\Controllers;

use BIMS\Core\Controllers\BaseController;

class LoginController extends BaseController
{
    public function showForm(): void
    {
        $this->render(
            'Modules/IAM/Views/LoginView',
            [],
            'Core/Layouts/AuthLayout/AuthLayout'
        );
    }

}
