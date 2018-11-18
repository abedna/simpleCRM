<?php
/**
 * Created by PhpStorm.
 * User: mod
 * Date: 14.09.18
 * Time: 13:04
 */

namespace App\Modules\Companies\Exports\Events;

use App\Modules\Companies\Models\Employee;
use Maatwebsite\Excel\Events\AfterSheet;
use \PhpOffice\PhpSpreadsheet\Style\Color;
use \PhpOffice\PhpSpreadsheet\Style\Conditional;


class StyleHighestSalary
{
    protected $companyId;

    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    public function __invoke(AfterSheet $event)
    {
        $highestSalary = Employee::where('company', $this->companyId)->max('salary');
        if ($highestSalary != null) {
        $conditional1 = (new Conditional())
            ->setConditionType(Conditional::CONDITION_CELLIS)
            ->setOperatorType(Conditional::OPERATOR_EQUAL)
            ->addCondition($highestSalary);

        $conditional1->getStyle()->getFont()->getColor()->setARGB(Color::COLOR_RED);
        $conditional1->getStyle()->getFont()->setBold(true);

        $col = $event->sheet->getDelegate()->getHighestDataColumn();
        $row = $event->sheet->getDelegate()->getHighestDataRow();
        $cellCoordinate = $col.'2:'.$col.$row;

        $conditionalStyles[] = $conditional1;
        $event->sheet->getDelegate()->getStyle($cellCoordinate)->setConditionalStyles($conditionalStyles);
        };

    }

}