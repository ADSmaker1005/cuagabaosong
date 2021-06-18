<?php
 namespace App\Http\View\Composers;

use App\Models\Categories;
use App\Models\MainSettings\Themes;
use Illuminate\View\View;
use App\Models\MainSettings\Footer;
use App\Models\MainSettings\Province;

class ThemesComposer
 {
     public function compose(View $view)
     {
         $view->with('themes', Themes::first());
         $view->with('footer',Footer::first());
         $view->with('provice',Province::all());
     }
 }
