<?php declare (strict_types = 1);

namespace App\Controllers;

use PDO;
use App\Models\User;
use Zend\Diactoros\Response;
use App\Controllers\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends Controller
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $response = new Response;
        $response->getBody()
            ->write(file_get_contents(base_path('public/dist/index.html'), true));

        return $response;
    }

    public function json(ServerRequestInterface $request): array
    {
        $users = $this->db->query("SELECT * FROM users")->fetchAll(\PDO::FETCH_CLASS, User::class);

        return [
            'success' => true,
            'data' =>  $users,
        ];
    }
}
