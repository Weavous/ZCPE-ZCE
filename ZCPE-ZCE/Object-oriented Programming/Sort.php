<?php

final class SortFactory
{
    /**
     * Constructor Method.
     * 
     * @param void
     */
    private function __construct()
    {
    }

    /**
     * Create.
     * 
     * @param string $filename
     * 
     * @return \Sort
     */
    public static function create(string $filename): Sort
    {
        return new Sort($filename);
    }
}

class Sort
{
    private string $filename;

    /**
     * Constructor Method.
     * 
     * @param string $filename
     */
    public function constructor($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Get.
     * 
     * @param void
     * 
     * @return \stdClass
     */
    public function get(): \stdclass
    {
        $data = file_get_contents($this->filename);

        return json_decode($data);
    }
}

$Sort = \SortFactory::create('Brands.JSON');

$data = $Sort->get();

array_multisort(array_column($array, 'name'), SORT_NATURAL | SORT_FLAG_CASE, $array);

file_put_contents($FILENAME, json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
