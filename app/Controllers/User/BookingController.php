<?php
namespace App\Controllers\User;

use Core\Controller;
use App\Models\Booking;
use Core\Logger;

class BookingController extends Controller
{
    private Booking $bookingModel;
    private Logger  $logger;

    public function __construct(Booking $model)
    {
        parent::__construct();
        $this->bookingModel  = $model;
        $this->logger = new Logger();
    }

  // рендеринг:
  public function showLoginPage()
  {
      $this->render('User/loginAuth');
  }

  public function showDashboardPage()
  {
      $this->requireAuth();

      // используем инжектированную модель
      $bookings = $this->bookingModel->findByUser($_SESSION['user_id']);

      $this->render('User/dashboard', [
          'bookings' => $bookings
      ]);
  }

  // создание
    public function create($hotelId)
    {
        if (!isset($_SESSION['user_id'])) {
            return $this->response->json(['error'=>'Авторизация'], 401);
        }
        $u = $_SESSION['user_id'];
        $s = $_POST['start_date'];
        $e = $_POST['end_date'];
        $g = (int)$_POST['guests'];
        try {
            $ok = $this->bookingModel->create($u, (int)$hotelId, $s, $e, $g);
            return $this->response->json($ok
               ? ['success'=>'Забронировано']
               : ['error'=>'Ошибка'],
               $ok?200:500
            );
        } catch(\Throwable $ex) {
            $this->logger->error("Booking create: " . $ex->getMessage());
            return $this->response->json(['error'=>'Внутренняя ошибка'],500);
        }
    }

    // удаление
    public function cancel($id)
    {
        if (!isset($_SESSION['user_id'])) {
            return $this->response->json(['error'=>'Авторизация'], 401);
        }
        $ok = $this->bookingModel->cancel((int)$id);
        return $this->response->json($ok
           ? ['success'=>'Отменено']
           : ['error'=>'Ошибка'],
           $ok?200:500
        );
    }
}
