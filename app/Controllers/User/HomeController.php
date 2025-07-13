<?php
namespace App\Controllers\User;

use Core\Controller;
use App\Models\Hotel;

class HomeController extends Controller
{
    private Hotel $hotelModel;

    public function __construct(Hotel $hotelModel)
    {
        parent::__construct();
        $this->hotelModel = $hotelModel;
    }

    public function showIndexPage()
    {
        // Получаем все отели из БД
        $hotels = $this->hotelModel->findAll();
        // Передаем в шаблон main.php
        $this->render('User/main', ['hotels' => $hotels]);
    }
}
