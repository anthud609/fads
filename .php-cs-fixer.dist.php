<?php
declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        __DIR__ . '/app',      // <-- your PSR-4 code lives here
        __DIR__ . '/tests',    // <-- remove or adjust if you don’t have a tests/ folder
    ])
    ->name('*.php')
    ->ignoreVCS(true);

return (new Config())
    ->setRules([
        '@PSR12'            => true,
        'array_syntax'      => ['syntax' => 'short'],
        'ordered_imports'   => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true);
