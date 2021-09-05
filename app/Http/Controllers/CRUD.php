<?php
namespace App\Http\Controllers;

interface CRUD
{
    public function create();
    public function retrieve();
    public function update();
    public function delete();
}
