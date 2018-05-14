<?php

namespace App\Widgets;

use App\Annonce;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class AnnonceDimmer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Annonce::count();
        $string = "Annonces";

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-diamond',
            'title'  => "{$count} {$string}",
            'text'   => __('voyager.dimmer.page_text', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => __('voyager.dimmer.page_link_text'),
                'link' => route('voyager.pages.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }
}
