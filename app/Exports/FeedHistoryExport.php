<?php

namespace App\Exports;

use App\Models\Feedhistory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FeedHistoryExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('historyfeed.excel',$this->data);
    }
}
