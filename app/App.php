<?php
namespace App;

use Dotenv\Dotenv;
use Core\Database;
use Core\Router;
use App\Controllers\User\HomeController;
use App\Controllers\User\UserController;
use App\Controllers\User\BookingController;
use App\Controllers\User\RequestController as UserRequestController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\HotelController;
use App\Controllers\Admin\RequestController as AdminRequestController;
use App\Models\User;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Request as RequestModel;

class App
{
  public static function run()
  {
    // загрузка переменных из файла .env
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();

    session_start(); // Запускаем сессию

    // подключение к бд
    $db = new Database(
      $_ENV['DB_HOST'],
      $_ENV['DB_USER'],
      $_ENV['DB_PASSWORD'],
      $_ENV['DB_NAME']
    );

    // инициализируем роутер
    $router = new Router();

    // создаем объекты моделей
    $userModel = new User($db);
    $hotelModel = new Hotel($db);
    $bookingModel = new Booking($db);
    $requestModel = new RequestModel($db);

    // создаем контроллеры и передаем им зависимости (модели)
    $homeController = new HomeController($hotelModel);
    $userController  = new UserController($userModel);
    $adminController = new AdminController($userModel);
    $hotelController = new HotelController($hotelModel);
    $bookingController = new BookingController($bookingModel);
    $requestController  = new UserRequestController($requestModel);
    $adminRequestController = new AdminRequestController($requestModel);

    // регистрация маршрутов:

    // пользовательские
    $router->addRoute('POST', '/register', [$userController, 'register']);
    $router->addRoute('POST', '/login', [$userController, 'login']);
    $router->addRoute('GET', '/user/me', [$userController, 'getCurrentUser']);
    $router->addRoute('GET', '/logout', [$userController, 'logout']);

    // бронирование
    $router->addRoute('POST', '/bookings/create/{hotelId}', [$bookingController,'create']);
    $router->addRoute('DELETE', '/bookings/cancel/{id}', [$bookingController,'cancel']);

    // заявки
    $router->addRoute('POST', '/requests/create', [$requestController, 'create']);

    // страницы ренедеринг
    $router->addRoute('GET', '/', [$homeController, 'showIndexPage']);
    $router->addRoute('GET', '/login', [$userController, 'showLoginPage']);
    $router->addRoute('GET', '/register', [$userController, 'showRegisterUserPage']);
    $router->addRoute('GET', '/dashboard', [$bookingController, 'showDashboardPage']);
    $router->addRoute('GET', '/adminPanel', [$adminController, 'showAdminPanelPage']);
    $router->addRoute('GET', '/admin/hotels', [$hotelController, 'showHotelsPage']);
    $router->addRoute('GET',  '/requests', [$requestController, 'showRequestsPage']);
    $router->addRoute('GET',    '/admin/requests', [$adminRequestController, 'showRequestsPage']);
    // для администратора
    $router->addRoute('GET', '/admin/users/list', [$adminController, 'listUsers']);
    $router->addRoute('GET', '/admin/users/get/{id}', function($id) use ($adminController) {
        $adminController->getUser($id);
    });
    $router->addRoute('PUT', '/admin/users/update/{id}', function($id) use ($adminController) {
        $adminController->updateUser($id);
    });
    $router->addRoute('DELETE', '/admin/users/delete/{id}', function($id) use ($adminController) {
        $adminController->deleteUser($id);
    });

    // для администратора страница упраление отелями
    $router->addRoute('GET',  '/admin/hotels/list', [$hotelController, 'listHotels']);
    $router->addRoute('POST', '/admin/hotels/create', [$hotelController, 'create']);
    $router->addRoute('POST', '/admin/hotels/update/{id}', [$hotelController, 'update']);
    $router->addRoute('DELETE','/admin/hotels/delete/{id}', [$hotelController, 'delete']);

    // для администратора страница упраление заявками
    $router->addRoute('GET',    '/admin/requests/list', [$adminRequestController, 'listRequests']);
    $router->addRoute('PUT',    '/admin/requests/approve/{id}', [$adminRequestController, 'approve']);
    $router->addRoute('DELETE', '/admin/requests/delete/{id}', [$adminRequestController, 'delete']);

    // запуск обработки маршрутов
    $router->processRequest();
  }
}
