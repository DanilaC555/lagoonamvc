<?php
namespace App\Controllers\User;

use Core\Controller;
use App\Models\Request;
use Core\Logger;

class RequestController extends Controller
{
    private Request $requestModel;
    private Logger $logger;

    public function __construct(Request $requestModel)
    {
        parent::__construct();
        $this->requestModel = $requestModel;
        $this->logger       = new Logger();
    }

    // Рендерит страницу "Мои заявки"
    public function showRequestsPage()
    {
        $this->requireAuth();
        $requests = $this->requestModel->findByUser((int)$_SESSION['user_id']);
        $this->render('User/requests', [
            'requests' => $requests
        ]);
    }

    // Принимает POST-запрос на создание новой заявки
    public function create()
    {
        $data = $this->request->getBody();
        $userId = $_SESSION['user_id'] ?? null;

        try {
            $ok = $this->requestModel->create(
                $userId,
                $data['name'],
                $data['email'],
                $data['tel'],
                $data['message']
            );
            return $this->response->json(
                $ok ? ['success' => 'Заявка оставлена'] : ['error' => 'Ошибка при сохранении'],
                $ok ? 200 : 500
            );
        } catch (\Throwable $e) {
            $this->logger->error("Request create: {$e->getMessage()}");
            return $this->response->json(['error' => 'Внутренняя ошибка'], 500);
        }
    }
}
