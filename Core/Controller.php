<?php
namespace Core;

abstract class Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    // инициализирует объекты для работы с запросом и ответом
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    protected function render(string $view, array $params = [])
    {
        // если сессия ещё не стартовала, запускаем
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // параметры вьюшки в переменные
        extract($params);

        // путь к файлу App/Views/{view}.php
        $viewPath = __DIR__ . '/../App/Views/' . $view . '.php';
        if (!file_exists($viewPath)) {
            // если нет — JSON-ошибка
            $this->response->json(['error' => 'Представление не найдено'], 404);
            return;
        }

        // забираем вывод вьюшки в $content
        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        require __DIR__ . '/../App/Views/layout.php';
    }


    // Требует, чтобы пользователь был авторизован
    protected function requireAuth(): void
    {
        if (!isset($_SESSION['user_id'])) {
    // Если нет — отдаёт JSON-ошибку 401 и завершает скрипт
            $this->response->json(
                ['error' => 'Требуется авторизация'],
                401
            );
            exit;
        }
    }
}
