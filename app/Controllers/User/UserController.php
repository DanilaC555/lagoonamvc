<?php
namespace App\Controllers\User;

use Core\Controller;
use App\Models\User;
use Core\Logger;

class UserController extends Controller
{
  private $userModel;
  private Logger $logger;

  public function __construct(User $userModel)
  {
      parent::__construct();
      $this->userModel = $userModel;
      $this->logger = new Logger();
  }

  // рендеринг:
  public function showLoginPage()
  {
      $this->render('User/loginAuth');
  }

    public function showRegisterUserPage()
    {
        $this->render('User/registerUser');
    }

   // регистрирует нового пользователя
  public function register()
  {
    try {
        $data = $this->request->getBody();
        if (empty($data['email']) || empty($data['password'])) {
            $this->logger->warning("Регистрация — не все поля заполнены");
            $this->response->json(['error' => 'Заполните все поля'], 400);
        }

        $result = $this->userModel->create($data['name'], $data['email'], $data['password']);
        if ($result) {
            // получаем данные только что созданного пользователя
            $user = $this->userModel->getUserByEmail($data['email']);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role']    = $user['role'];
                setcookie("session_id", session_id(), time() + 3600, "/", "", false, true);

                $this->logger->info("Пользователь зарегистрирован: {$data['email']}");
                $this->response->json(['success' => 'Пользователь зарегистрирован и вошел в систему']);
            } else {
                $this->logger->error("Не удалось получить данные пользователя после регистрации");
                $this->response->json(['error' => 'Ошибка получения данных пользователя'], 500);
            }
        } else {
            $this->logger->error("Ошибка при создании пользователя: {$data['email']}");
            $this->response->json(['error' => 'Ошибка регистрации пользователя'], 500);
        }
    } catch (\Throwable $e) {
      $this->logger->error("Ошибка при регистрации: " . $e->getMessage());
        return $this->response->json(['error' => 'Внутренняя ошибка сервера'], 500);
    }
  }

      // авторизует пользователя
      public function login()
      {
        try {
          $data = $this->request->getBody();
          if (empty($data['name'] || $data['email']) || empty($data['password'])) {
            $this->logger->warning("Авторизация — не все поля заполнены");
            $this->response->json(['error' => 'Заполните все поля'], 400);
          }
          // получаем данные пользователя
          $user = $this->userModel->getUserByEmail($data['email']);
          if (!$user || !password_verify($data['password'], $user['password'])) {
            $this->logger->error("Ошибка получения данных пользователя");
            $this->response->json(['error' => 'Неверный email или пароль'], 401);
          }
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['role']    = $user['role'];
          setcookie("session_id", session_id(), time() + 3600, "/", "", false, true);

          $this->logger->info("Вход выполнен");
          $this->response->json(['success' => 'Вход выполнен']);
        } catch (\Throwable $e) {
          $this->logger->error("Ошибка при авторизации: " . $e->getMessage());
          return $this->response->json(['error' => 'Внутренняя ошибка сервера'], 500);
        }
      }

    // возвращает данные текущего авторизованного пользователя
    public function getCurrentUser()
    {
        try {
            if (!isset($_SESSION['user_id'])) {
                $this->logger->warning("Необходима авторизация");
                $this->response->json(['error' => 'Необходима авторизация'], 401);
            }
            $user = $this->userModel->findById($_SESSION['user_id']);

            if (!$user) {
                $this->logger->warning("Пользователь не найден");
                $this->response->json(['error' => 'Пользователь не найден'], 404);
            }

            $this->logger->info("Текущий пользователь получен: ID {$user['id']}, email {$user['email']}");
            $this->response->json([
                'id'    => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role'  => $user['role']
            ]);
        } catch (\Throwable $e) {
            $this->logger->error("Ошибка при получении текущего пользователя: " . $e->getMessage());
            return $this->response->json(['error' => 'Внутренняя ошибка сервера'], 500);
        }
    }

  // завершает сессию пользователя
  public function logout()
  {
    try {
      session_destroy();
      setcookie("session_id", "", time() - 3600, "/");
      $this->logger->info("Выход выполнен");
      $this->response->json(['success' => 'Выход выполнен']);
    } catch (\Throwable $e) {
      $this->logger->error("Ошибка при выходе: " . $e->getMessage());
      return $this->response->json(['error' => 'Внутренняя ошибка сервера'], 500);
    }
  }
}
