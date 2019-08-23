<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

use App\Models\Order\Order;
use App\Models\Settings\Repos\TextblocksRepository;

use Barryvdh\DomPDF\PDF;

class TextblocksController extends Controller
{
    protected $textblocks;

    public function __construct(TextblocksRepository $textblocks)
    {
        $this->textblocks = $textblocks;
    }

    /**
     * Edit textblocks.
     *
     * @param
     * @return \Illuminate\View\View
     */
    public function edit($type)
    {
        $data['textblocks'] = $this->textblocks->byType($type);

        return view('admin.settings.textblocks.elements.' . $type, $data);
    }


    /**
     * Show sample attendance list as PDf.
     *
     * @return PDF
     */
    public function sampleAttendanceList()
    {
        $data['textblocks'] = $this->textblocks->byType('attendance_list');
        $data['employees'] = [];
        $data['diff_in_days'] = 2;

        $data['orders'] = Order::limit(1)->get();

        return \PDF::loadView('pdf.attendance_list', $data)
            ->stream('Anwesenheitsliste: Beispiel-Firma.pdf');
    }

}
