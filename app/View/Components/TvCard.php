<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TvCard extends Component
{
    public $tvShow;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tvShow)
    {
        $this->tvShow = $tvShow;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tv-card');
    }
}
