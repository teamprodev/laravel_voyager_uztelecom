<?php

namespace App\View\Components;

use Illuminate\Http\Client\Request;
use Illuminate\View\Component;

class laravelYajra extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tableTitle;
    public $getData;
    public $startDate;
    public $endDate;
    public $exportId;

    public function __construct($getData,$tableTitle, $startDate, $endDate, $exportId)
    {
        $this->tableTitle = $tableTitle;
        $this->getData = $getData;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->exportId = $exportId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.laravelYajraLoc');
    }
}
