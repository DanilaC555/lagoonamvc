<?php
namespace App\Models;

use Core\Model;
use Exception;

class Booking extends Model
{
    protected $table = 'bookings';

    // добавить новую бронь в таблицу
    public function create(int $userId, int $hotelId, string $startDate, string $endDate, int $guests): bool
    {
        return $this->insert([
            'user_id'    => $userId, // iD пользователя, который делает брон
            'hotel_id'   => $hotelId, // ID отеля, который бронируют
            'start_date' => $startDate, //даты
            'end_date'   => $endDate, //даты
            'guests'     => $guests, // гости
            'status'     => 'pending'
        ]);
    }

    // получить все брони конкретного пользователя вместе с данными об отеле
    public function findByUser(int $userId): array
    {
    // Берёт колонки из таблицы bookings (псевдоним b).
    // Через JOIN присоединяет таблицу hotels (псевдоним h), чтобы получить название, город, страну и путь до картинки отеля.
    // Фильтрует по b.user_id = ?.
    // Сортирует по дате создания (created_at DESC), чтобы самые свежие брони шли первыми.
        $sql = "SELECT b.id, b.status, b.start_date, b.end_date, b.guests,
                       h.name, h.city, h.country, h.image_path
                FROM {$this->table} b
                JOIN hotels h ON b.hotel_id = h.id
                WHERE b.user_id = ?
                ORDER BY b.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $res;
    }

    public function cancel(int $id): bool
    {
        return $this->delete($id);
    }
}
