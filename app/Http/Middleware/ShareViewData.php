<?php
/**
 * ShareViewData.php
 *
 * @copyright  2022 opencart.cn - All Rights Reserved
 * @link       http://www.guangdawangluo.com
 * @author     Edward Yang <yangjin@opencart.cn>
 * @created    2022-08-03 15:46:13
 * @modified   2022-08-03 15:46:13
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Beike\Repositories\CategoryRepo;
use Beike\Repositories\LanguageRepo;

class ShareViewData
{
    public function handle(Request $request, Closure $next)
    {
        $this->loadShopShareViewData();
        return $next($request);
    }

    protected function loadShopShareViewData()
    {
        View::share('design', request('design') == 1);
        View::share('languages', LanguageRepo::enabled());
        View::share('shop_base_url', shop_route('home.index'));
        View::share('categories', hook_filter('header.categories', CategoryRepo::getTwoLevelCategories()));
    }
}