<?php

namespace App\Modules\Companies\Exports;

use App\Modules\Companies\Models\Company;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CompaniesExport implements FromCollection, WithMultipleSheets
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::all();
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets =[];

        foreach ($this->collection() as $company) {

           $sheets[] = new EmployeesSheet($company['id'], $company['Name']);
        }

        return $sheets;
    }
}
