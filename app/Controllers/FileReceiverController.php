<?php

namespace App\Controllers;

use CodeIgniter\Database\BaseConnection;
use Config\Paths;
use Config\Database;
use App\Helpers\Utils;

class FileReceiverController extends BaseController
{
    private BaseConnection $db;
    private Paths $paths;

    /**
     * FileReceiverController constructor.
     */
    public function __construct()
    {
        $this->paths = new Paths();
        $this->db = Database::connect();
    }

    /**
     * @return string
     */
    public function index(): string
    {
        try {
            $fileInfo = new \finfo(FILEINFO_MIME_TYPE);

            if ($_SERVER['CI_ENVIRONMENT'] === 'development') {
                Utils::logInfo($_FILES);
            }

            if (empty($_FILES['file']['tmp_name'])) {
                return 'file do not posted';
            }

            $ext = array_search(
                $fileInfo->file($_FILES['file']['tmp_name']),
                [
                    'jpeg' => 'image/jpeg',
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ],
                true
            );

            if (!$ext) {
                throw new \RuntimeException('Invalid file format.');
            }

            $fileName = sprintf('%s.%s', sha1_file($_FILES['file']['tmp_name']), $ext);

            $filePath = sprintf($this->paths->writableDirectory . '/uploads/%s', $fileName);

            if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                throw new \RuntimeException('Failed to move uploaded file.');
            }

            $this->saveImage($_FILES['file']['name'], '/uploads/' . $fileName, $filePath);
        } catch (\RuntimeException $e) {
            log_message('error', 'upload image failed', [
                'code' => $e->getCode(),
                'mess' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);

            return 'error file posted';
        }

        $this->db->close();

        return 'file posted success';
    }

    /**
     * @param string $url
     * @param string $path
     */
    private function saveImage(string $name, string $url, string $path): void
    {
        $prepareQuery = $this->db->prepare(static function ($db) {
            return $db->table('images')->insert([
                'name' => '',
                'url' => '',
                'path' => '',
            ]);
        });

        $this->db->transStart();

        $res = $prepareQuery->execute($name, $url, $path);

        if ($res) {
            $this->db->transCommit();
        } else {
            $this->db->transRollback();
            log_message('error', 'can\'t commit transaction');
        }
    }
}
