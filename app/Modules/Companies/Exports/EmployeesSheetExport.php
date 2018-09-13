<?php

namespace App\Modules\Companies\Exports;

use App\Modules\Companies\Models\Employee;
use App\Modules\Companies\Models\Company;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class EmployeesSheetExport implements FromCollection, WithTitle, WithHeadings, WithEvents
{
    protected $companyId;
    protected $companyName;

    public function __construct($companyId, $companyName)
    {
        $this->companyId = $companyId;
        $this->companyName = $companyName;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::with('companies')->where('company', $this->companyId)->get();
        //return Employee::all();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->companyName;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
       return Schema::getColumnListing('employees');
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
        AfterSheet::class => function(AfterSheet $event) {


        }
        ];
    }
}
