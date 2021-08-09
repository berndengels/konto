<?php
namespace App\Http\Controllers;

use App\Models\Angebote;
use App\Models\Kurs;
use App\Models\KursStart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }
}
