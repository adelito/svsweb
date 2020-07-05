<?php

namespace module\sgo\helper;

class ImportCSV
{
    private $fileName;
    private $file;
    private $data;
    private $error;

    public function getData()
    {
        return $this->data;
    }

    public function setFile($fileName, $removeHeader = false)
    {
        $this->fileName = $fileName;

        if (!$this->validateFile()) {
            return false;
        }

        $this->process();

        if ($removeHeader) {
            $this->removeHeader();
        }

        return true;
    }

    private function removeHeader()
    {
        unset($this->data[0]);
        sort($this->data);
    }

    private function process()
    {
        $this->file = fopen($this->fileName, 'r');

        $this->data = [];
        while (($line = fgetcsv($this->file, 10000, ";")) !== false) {
            $this->data[] = $line;
        }

        fclose($this->file);
    }

    private function validateFile()
    {
        if (empty($this->fileName) || (!file_exists($this->fileName) && !is_dir($this->fileName))) {
            $this->fileName = null;
            $this->error = "Arquivo Inválido";
            return false;
        }

        return true;
    }
}