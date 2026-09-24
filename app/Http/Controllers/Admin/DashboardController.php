<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;

class DashboardController extends \App\Http\Controllers\Staff\DashboardController
{
    public function __invoke(): View
    {
        return parent::__invoke();
    }
}
