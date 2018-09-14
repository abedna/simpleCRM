<?php
/**
 * Created by PhpStorm.
 * User: mod
 * Date: 14.09.18
 * Time: 14:24
 */

namespace App\Modules\Companies\Exports\Events;


use Maatwebsite\Excel\Events\AfterSheet;


class StyleFontSize
{

    public function __invoke(AfterSheet $event)
    {
        $event->sheet->getDelegate()->getStyle('A1:I1')->getFont()->setSize(15);
    }

}