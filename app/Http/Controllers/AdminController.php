<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use JavaScript;

class AdminController extends Controller
{
    public function index ()
    {
        $events =  Event::all();
        JavaScript::put([
            'events' => $events
        ]);

        return view('admin.home');
    }
}
