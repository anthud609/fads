<?php

namespace BIMS\Core\Controllers;

use BIMS\Core\Views\View;

class BaseController
{
    /**
     * Render a view with optional data and layout.
     *
     * @param string $viewPath Path to view (e.g. "Core/Views/Dashboard")
     * @param array  $data     Data to extract in view
     * @param string $layout   Layout to wrap around view (e.g. "Core/Layouts/GlobalSecureLayout/GlobalSecureLayout")
     */
    protected function render(string $viewPath, array $data = [], string $layout = ''): void
    {
        View::make($viewPath, $data)
            ->layout($layout)
            ->render();
    }

    /**
     * Default index action: renders the dashboard with flash support.
     */
    public function index(): void
    {
        $this->render(
            'Core/Views/Dashboard',
            [
                'title'   => 'Welcome',
                'message' => 'Hello, world! This is your new PHP + FastRoute app.',
            ],
            'Core/Layouts/GlobalSecureLayout/GlobalSecureLayout'
        );
    }
}
