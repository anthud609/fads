<?php
namespace BIMS\Core\Views;

class View
{
    protected string $viewPath;
    protected array  $data           = [];
    protected string $layout         = '';
    protected array  $sections       = [];
    protected string $currentSection = '';
    protected array  $flashes        = [];

    public function __construct(string $viewPath, array $data = [])
    {
        $this->viewPath = $viewPath;
        $this->data     = $data;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->flashes  = $_SESSION['flashes'] ?? [];
        unset($_SESSION['flashes']);
    }

    public static function make(string $viewPath, array $data = []): self
    {
        return new self($viewPath, $data);
    }

    public function layout(string $layout): self
    {
        $this->layout = $layout;
        return $this;
    }

    public function start(string $name): void
    {
        $this->currentSection = $name;
        ob_start();
    }

    public function end(): void
    {
        $this->sections[$this->currentSection] = ob_get_clean();
    }

    public function yield(string $name): string
    {
        return $this->sections[$name] ?? '';
    }

    public function render(): void
    {
        extract($this->data, EXTR_SKIP);

        // render the view into 'content'
        ob_start();
        include $this->resolveFile($this->viewPath);
        $this->sections['content'] = ob_get_clean();

        // wrap in layout if set
        if ($this->layout) {
            include $this->resolveFile($this->layout);
        } else {
            echo $this->sections['content'];
        }
    }

    public static function flash(string $type, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flashes'][$type][] = $message;
    }

    public function getFlashes(): array
    {
        return $this->flashes;
    }

    protected function resolveFile(string $path): string
    {
        // __DIR__ is .../app/Core/Views, so dirname(__DIR__,3) = project root
        $basePath = dirname(__DIR__, 3) . '/app/';
        $file     = $basePath . $path . '.php';

        if (! file_exists($file)) {
            throw new \RuntimeException("View file not found: {$file}");
        }

        return $file;
    }
}
