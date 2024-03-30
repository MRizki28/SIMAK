<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface  YearInterfaces
{
    public function getAllData();
    public function getPersonalYear();
    public function getEntireYear(Request $request);
}
