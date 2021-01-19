<?php

namespace SitesIP\Services;

use ParseCsv\Csv;
use RuntimeException;
use Cocur\Slugify\Slugify;

class Download implements ServiceInterface
{
    /**
     * @var string
     */
    private $target_file;

    /**
     * @var Slugify
     */
    private $slugify;

    /**
     * Download constructor.
     *
     */
    public function __construct()
    {
        $this->slugify = new Slugify();;
    }


    /**
     * @inheritDoc
     */
    public function register()
    {
        try {
            // Handle file upload
            if (!isset($_FILES['the-file']['error']) || is_array($_FILES['the-file']['error'])) {
                throw new RuntimeException('');
            }
            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['the-file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
            // You should also check filesize here.
            if ($_FILES['the-file']['size'] > 1000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['the-file']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            $this->target_file = dirname(dirname(__DIR__)) . '/uploads/' . $this->slugify->slugify($_FILES['the-file']['name']) . '.csv';

            if (!move_uploaded_file( $_FILES['the-file']['tmp_name'], $this->target_file)) {
                throw new RuntimeException('Failed to move uploaded file.');
            }
            echo 'File is uploaded successfully.';

            $this->export();
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }

    private function export(){
        $csv = new Csv($this->target_file);
        foreach($csv->data as $key => $item){
            $item['IP ADDRESS'] = gethostbyname($item['SITES']);
            $csv->data[$key] = $item;
        }
        $header = array('ID', 'SITES', 'IP ADDRESS');
        $csv->output('sites.csv', $csv->data, $header, ',');
        die();
    }

}