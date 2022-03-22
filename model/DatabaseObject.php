<?php

require_once 'Database.php';

interface DatabaseObject
{

    public function create();

    public function update();

    public static function get($id);

    public static function getAll();

    public static function delete($id);
}