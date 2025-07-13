<?php
namespace App\Models;

use Core\Model;
use Exception;

class Request extends Model
{
    protected $table = 'requests';

    /**
     * Создать новую заявку
     *
     * @param int|null $userId
     * @param string $name
     * @param string $email
     * @param string $tel
     * @param string $message
     * @return bool
     */
    public function create(?int $userId, string $name, string $email, string $tel, string $message): bool
    {
        return $this->insert([
            'user_id'   => $userId,
            'name'      => $name,
            'email'     => $email,
            'tel'       => $tel,
            'message'   => $message,
            'status'    => 'pending'
        ]);
    }

    /**
     * Получить все заявки текущего пользователя
     *
     * @param int $userId
     * @return array
     */
    public function findByUser(int $userId): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $res;
    }

    /**
     * Получить все заявки (для администратора)
     *
     * @return array
     */
    public function findAllRequests(): array
    {
        $sql = "
          SELECT
            r.*,
            u.name  AS user_name,
            u.email AS user_email
          FROM {$this->table} r
          LEFT JOIN users u ON r.user_id = u.id
          ORDER BY r.created_at DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $res;
    }

    public function updateStatus(int $id, string $status): bool
    {
        return $this->update($id, ['status' => $status]);
    }
}
