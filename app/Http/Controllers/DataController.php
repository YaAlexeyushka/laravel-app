<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function index()
    {
        $files = Storage::files('data');
        $data = [];

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $content = Storage::get($file);
                $jsonData = json_decode($content, true);
                if ($jsonData) {
                    $data[] = $jsonData;
                }
            }
        }

        return view('data', ['data' => $data]);
    }
}
