<?php
namespace App\Managers;
use Illuminate\Http\Request;

interface ManagerInterface{
    public function createFromRequest();
}