<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\CustomCss;
use App\Models\CustomJs;
use App\Models\GenaralSetting;
use App\Models\InsertHeaderFooter;
use App\Models\LogoFavicon;
use App\Models\Page;
use App\Models\SeoSetting;
use Facade\Ignition\Solutions\GenerateAppKeySolution;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {



    }
}
