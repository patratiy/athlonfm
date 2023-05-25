<?php

namespace App\Controllers;

use App\Helpers\Utils;
use Config\Database;
use CodeIgniter\View\Parser;
use Config\View;
use CodeIgniter\Database\BaseConnection;

class Home extends BaseController
{
    private Parser $parser;
    private BaseConnection $db;

    public function __construct()
    {
        $configView = new View();
        $this->parser = new Parser($configView);
        $this->db = Database::connect();
    }

    public function index()
    {
        $sql = <<<SQL
        SELECT name, url FROM images; 
SQL;

        $result = $this->db->query($sql);

        $i = 0;

        $images = array_map(static function($row) use (&$i) {
            $i++;
            return [
                'name' => $row->name,
                'url' => $row->url,
                'active' => $i === 1 ? 'active' : ''
            ];
        }, $result->getResult());

        if ($_SERVER['CI_ENVIRONMENT'] === 'development') {
            Utils::logInfo($images);
        }

        $data = [
            'slides_entries' => $images
        ];

        return $this->parser->setData($data)->render('main');
    }
}
