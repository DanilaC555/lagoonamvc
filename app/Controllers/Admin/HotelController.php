<?php
namespace App\Controllers\Admin;

use Core\Controller;
use App\Models\Hotel;
use Core\Logger;

class HotelController extends Controller
{
  private Hotel $hotelModel;
  private Logger $logger;

  public function __construct(Hotel $hotelModel)
  {
      parent::__construct();
      $this->hotelModel = $hotelModel;
      $this->logger = new Logger();
  }

  // рендеринг:
  public function showHotelsPage()
  {
      $this->checkAdmin();
      $this->render('Admin/adminHotels');
  }

  // проверка является ли текущий пользователь администратором
  protected function checkAdmin()
  {
      if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
          $this->response->json(['error' => 'Доступ запрещён'], 403);
      }
  }

  // список отелей
  public function listHotels()
  {
      $this->checkAdmin();
      $hotels = $this->hotelModel->findAll();
      $this->response->json($hotels);
  }

  // создание отеля
  public function create()
  {
      $this->checkAdmin();

      // обработка загруженного файла
      $imagePath = '';
      if (!empty($_FILES['image']['tmp_name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
          $uploadDir = __DIR__ . '/../../public/uploads/hotels/';
          if (!is_dir($uploadDir)) {
              mkdir($uploadDir, 0755, true);
          }
          $ext      = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
          $filename = uniqid('hotel_') . '.' . $ext;
          move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
          $imagePath = '/uploads/hotels/' . $filename;
      }

      $ok = $this->hotelModel->create(
          $_POST['name'],
          $_POST['city'],
          $_POST['country'],
          (float)$_POST['price_per_night'],
          (int)$_POST['rating'],
          $imagePath
      );
      $this->response->json($ok
          ? ['success' => 'Отель добавлен']
          : ['error'   => 'Ошибка сохранения'],
          $ok ? 200 : 500
      );
  }

  // обновление отеля
  public function update($id)
  {
      $this->checkAdmin();

    // обработка нового файла (если загружен)
    $imagePath = null;
    if (!empty($_FILES['image']['tmp_name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../public/uploads/hotels/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $ext      = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('hotel_') . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
        $imagePath = '/uploads/hotels/' . $filename;
    }

      $ok = $this->hotelModel->updateHotel(
          (int)$id,
          $_POST['name'],
          $_POST['city'],
          $_POST['country'],
          (float)$_POST['price_per_night'],
          (int)$_POST['rating'],
          $imagePath // или null, если не загружали
      );
      $this->response->json($ok ? ['success' => 'Отель обновлён'] : ['error'   => 'Ошибка обновления'], $ok ? 200 : 500
      );
  }

  // удалить отель
  public function delete($id)
  {
      $this->checkAdmin();

      // сначала забираем данные по отелю, чтобы узнать, какой файл хранится
      $hotel = $this->hotelModel->findById((int)$id);
      if (!$hotel) {
          return $this->response->json(['error' => 'Отель не найден'], 404);
      }

      // если у отеля есть путь к картинке — удаляем файл
      if (!empty($hotel['image_path'])) {
          // путь на диске: public/uploads/hotels/...
          $fullPath = __DIR__ . '/../../public' . $hotel['image_path'];
          if (file_exists($fullPath)) {
              @unlink($fullPath);
          }
      }

      // теперь удаляем саму запись
      $ok = $this->hotelModel->deleteHotel((int)$id);
      $this->response->json($ok ? ['success' => 'Отель удалён'] : ['error'   => 'Ошибка удаления'], $ok ? 200 : 500
      );
  }
}
