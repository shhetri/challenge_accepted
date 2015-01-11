<?php namespace App;
/**
 * @file   File.php
 * @brief  Provides methods for filesystem operations
 * @author Sumit Chhetri
 * @date   1/11/15
 * @bug    No known bugs
 */

class File {

    /**
     * @var string
     */
    protected $filename;

    /**
     * @param $filename
     */
    function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @brief    Reads the content of file and return as array
     * @return array
     */
    public function read()
    {
        try {
            $file = $this->open($this->filename, 'r');
            while (!feof($file)) {
                $content[] = fgetcsv($file);
            }

            return $content;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @brief Writes the content in a file
     * @param $lists
     * @throws \Exception
     */
    public function write($lists)
    {
        $file = $this->open($this->filename, 'w');
        foreach ($lists as $list) {
            fputcsv($file, $list);
        }
        $this->close($file);
    }

    /**
     * @brief Opens a file
     * @param $filename
     * @param $mode
     * @return resource
     * @throws \Exception
     */
    private function open($filename, $mode)
    {
        if ( $mode == 'r' && !file_exists($filename) ) {
            throw new \Exception('File not found.');
        }

        return fopen($filename, $mode);
    }

    /**
     * @brief Closes a file
     * @param $file
     */
    public function close($file)
    {
        fclose($file);
    }
}