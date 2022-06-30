<?php

namespace App\View\Components;

use Illuminate\View\Component;

class laravelUppy extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $url;
    public $target;
    public function __construct($url,$target)
    {
        $this->url = $url;
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.laravelUppy');
    }
}
