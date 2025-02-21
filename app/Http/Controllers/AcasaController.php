<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Proiect;
use Illuminate\Support\Facades\DB;

class AcasaController extends Controller
{
    public function acasa()
    {
        return view('acasa');
    }
}
