<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    //
    public function index()
    {
        $faqs = Faq::all();
        return view('pages.user.faq',compact('faqs'));
    }
}
