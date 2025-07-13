<?php
namespace App\Controllers\Admin;

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

  // проверка является ли текущий пользователь администратором
  protected function checkAdmin()
  {
      if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
          $this->response->json(['error' => 'Доступ запрещён'], 403);
      }
  }

    // Рендерит админскую страницу со списком заявок
    public function showRequestsPage()
    {
        $this->checkAdmin();
        $this->render('Admin/requests');
    }

    // Возвращает JSON со всеми заявками
    public function listRequests()
    {
        $this->checkAdmin();
        try {
            $all = $this->requestModel->findAllRequests();
            $this->response->json($all);
        } catch (\Throwable $e) {
            $this->logger->error("Ошибка listRequests: {$e->getMessage()}");
            $this->response->json(['error' => 'Внутренняя ошибка'], 500);
        }
    }

    // Одобрить заявку
    public function approve($id)
    {
        $this->checkAdmin();
        try {
            $ok = $this->requestModel->updateStatus((int)$id, 'approved');
            $this->response->json(
                $ok ? ['success' => 'Заявка одобрена'] : ['error' => 'Ошибка при обновлении'],
                $ok ? 200 : 500
            );
        } catch (\Throwable $e) {
            $this->logger->error("Ошибка approve({$id}): {$e->getMessage()}");
            $this->response->json(['error' => 'Внутренняя ошибка'], 500);
        }
    }

    // Удалить (отклонить) заявку
    public function delete($id)
    {
        $this->checkAdmin();
        try {
            $ok = $this->requestModel->delete((int)$id);
            $this->response->json(
                $ok ? ['success' => 'Заявка удалена'] : ['error' => 'Ошибка при удалении'],
                $ok ? 200 : 500
            );
        } catch (\Throwable $e) {
            $this->logger->error("Ошибка delete({$id}): {$e->getMessage()}");
            $this->response->json(['error' => 'Внутренняя ошибка'], 500);
        }
    }
}
