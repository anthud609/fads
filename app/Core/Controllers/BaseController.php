<?php
namespace BIMS\Core\Controllers;

use BIMS\Core\Views\View;

class BaseController
{
    /** 
     * $viewPath: e.g. "Core/Views/Dashboard" or "Modules/IAM/Views/LoginView" 
     * $layout:  e.g. "Core/Layouts/GlobalSecureLayout/GlobalSecureLayout"
     */
    protected function render(string $viewPath, array $data = [], string $layout = ''): void
    {
        View::make($viewPath, $data)
            ->layout($layout)
            ->render();
    }
}
