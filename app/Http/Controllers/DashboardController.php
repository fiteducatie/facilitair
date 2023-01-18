<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard', [
            'pins' => \App\Models\Pin::with('user', 'categories', 'likes', 'saves')->latest()->paginate(10),
        ]);
    }

    public function categories() {

        return view('dashboard.categories', [
            'categories' => \App\Models\Category::whereNull('parent_category_id')->with('subcategories')->get(),
        ]);
    }

    public function users() {
        return view('dashboard.users', [
            'users' => \App\Models\User::all(),
        ]);
    }

    public function pins() {
        return view('dashboard.pins', [
            'pins' => \App\Models\Pin::with('user', 'categories', 'likes', 'saves')->latest()->paginate(10),
        ]);
    }
}
