<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GeneralLayout extends Component
{
    public $title;

    public function __construct($title = 'BLOGX')
    {
        $this->title = $title;
    }
    public function render(): View
    {
        return view('layouts.general');
    }
}
