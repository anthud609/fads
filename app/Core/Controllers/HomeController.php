<?php
namespace BIMS\Core\Controllers;

class HomeController
{
    public function index(): void
    {
        // Prepare data
        $title   = 'Welcome';
        $message = 'Hello, world! This is your new PHP + FastRoute app.';

        // Capture view output
        ob_start();
        include __DIR__ . '/../Views/Dashboard.php';
        $content = ob_get_clean();

        // Render layout
        include __DIR__ . '/../Layouts/GlobalSecureLayout/GlobalSecureLayout.php';
    }
}
