<?php
namespace App\Models;

use Core\Model;
use Exception;

class Hotel extends Model
{
  protected $table = 'hotels';

  // создать отель
  public function create(string $name, string $city, string $country, float $price_per_night, int $rating, string $image_path = '')
  {
    return $this->insert([
      'name'            => $name,
      'city'            => $city,
      'country'         => $country,
      'price_per_night' => $price_per_night,
      'rating'          => $rating,
      'image_path'      => $image_path,
    ]);
  }

  // редактировать отель
  public function updateHotel(
    int    $id,
    string $name,
    string $city,
    string $country,
    float  $price_per_night,
    int    $rating,
    ?string $image_path = null
  ) {
    $data = [
      'name'            => $name,
      'city'            => $city,
      'country'         => $country,
      'price_per_night' => $price_per_night,
      'rating'          => $rating,
    ];
    if ($image_path !== null) {
        $data['image_path'] = $image_path;
    }
    return $this->update($id, $data);
  }

  // удаление отеля
  public function deleteHotel(int $id)
  {
      return $this->delete($id);
  }
}
