<?php
namespace BIMS\Core\Views;

class View
{
    protected string $viewPath;
    protected array  $data      = [];
    protected string $layout    = '';
    protected array  $sections  = [];
    protected string $currentSection = '';
    protected array  $flashes   = [];

    public function __construct(string $viewPath, array $data = [])
    {
        $this->viewPath = $viewPath;
        $this->data     = $data;
        session_start();
        $this->flashes  = $_SESSION['flashes'] ?? [];
        unset($_SESSION['flashes']);
    }

    public static function make(string $viewPath, array $data = []): self
    {
        return new self($viewPath, $data);
    }

    /** Choose layout: e.g. "Core/Layouts/GlobalSecureLayout/GlobalSecureLayout" */
    public function layout(string $layout): self
    {
        $this->layout = $layout;
        return $this;
    }

    /** Capture a named section */
    public function start(string $name): void
    {
        $this->currentSection = $name;
        ob_start();
    }

    public function end(): void
    {
        $this->sections[$this->currentSection] = ob_get_clean();
    }

    /** Yield a section in a layout */
    public function yield(string $name): string
    {
        return $this->sections[$name] ?? '';
    }

    /** Render the view (and wrap in layout if set) */
    public function render(): void
    {
        extract($this->data, EXTR_SKIP);
        // --- Render main view into "content" ---
        ob_start();
        include $this->resolveFile($this->viewPath);
        $this->sections['content'] = ob_get_clean();

        // --- If nested layout: wrap content in that layout ---
        if ($this->layout) {
            include $this->resolveFile($this->layout);
        } else {
            echo $this->sections['content'];
        }
    }

    /** Flash helper */
    public static function flash(string $type, string $message): void
    {
        session_start();
        $_SESSION['flashes'][$type][] = $message;
    }

    /** Access flashes inside layouts */
    public function getFlashes(): array
    {
        return $this->flashes;
    }

    protected function resolveFile(string $path): string
    {
        // path is relative to /app/, e.g. "Core/Views/Dashboard"
        $file = dirname(__DIR__, 2) . '/app/' . $path . '.php';
        if (! file_exists($file)) {
            throw new \RuntimeException("View file not found: {$file}");
        }
        return $file;
    }
}
