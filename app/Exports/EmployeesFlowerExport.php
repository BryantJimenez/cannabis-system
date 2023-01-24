<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmployeesFlowerExport implements FromView, ShouldAutoSize
{
    public $strain;
	public $dates;
	public $employees;

    public function __construct($strain, $dates, $employees)
    {
        $this->strain=$strain;
    	$this->dates=$dates;
    	$this->employees=$employees;
    }

    public function view(): View
    {
        return view('exports.flower', [
            'strain' => $this->strain,
            'dates' => $this->dates,
            'employees' => $this->employees
        ]);
    }
}
