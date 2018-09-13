<?php

namespace App\Modules\Companies\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Companies\Models\Company;
use App\Modules\Companies\Models\Employee;
use App\Modules\Companies\Exports\CompaniesExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:admin']);
    }
    public function exportInfo()
    {
        $date = Carbon::now()->format('Y-m-d');

        return Excel::download(new CompaniesExport, 'companies'.$date.'.xlsx');

        return (new CompaniesExport)->download('companies'.$date.'.xlsx');
    }

}
