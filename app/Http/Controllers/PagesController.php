<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller {

    /**
     * Direct http request to view
     */
    public function index()
    {
        return view('categories.index');
    }

    public function showItems() {
        return view('partials.items');
    }

}
