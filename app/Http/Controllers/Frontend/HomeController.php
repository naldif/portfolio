<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hero;
use App\Models\About;
use App\Models\Service;
use App\Models\Category;
use App\Models\TyperTitle;
use Illuminate\Http\Request;
use App\Models\PortfolioItem;
use App\Http\Controllers\Controller;
use App\Models\PortfolioSectionSetting;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        $typerTitles = TyperTitle::all();
        $services = Service::all();
        $about = About::first();
        $portfolioSetting = PortfolioSectionSetting::first();
        $portfolioCategory = Category::all();
        $portfolioItem = PortfolioItem::all();

        return view('frontend.home', [
            'hero' => $hero,
            'typerTitles' =>  $typerTitles,
            'services' => $services,
            'about' => $about,
            'portfolioSetting' => $portfolioSetting,
            'portfolioCategory' => $portfolioCategory,
            'portfolioItem' => $portfolioItem,
        ] );
    }
}
