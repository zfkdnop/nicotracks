<?php
namespace App\Controllers;

use App\Models\DataPointModel;
// use CodeIgniter\I18n\Time;

class UpdateDataController extends BaseController {
    protected $modelName    = 'App\Models\DataPointModel';
    protected $helpers      = ['form'];
    protected $pageTitle    = 'Edit Datapoint';

    // HTML interface to edit/update an existing datapoint in the DB
    public function listDataPoints(): string {
        $model = model($this->modelName);
        $d = [
            'title'         => $this->pageTitle,
            'dataPoints'    => $model->paginateDataSinceTimestamp(15, 'DESC', '30 days ago'),
            'pager'         => $model->pager,
        ];

        return view('templates/header')
                . view('pages/data/update/listDataPoints', $d)
                . view('templates/footer', $d['dataPoints']);
    }

    public function updateDataForm(): string {
        //
    }

    /** Update datapoint in database
     */
    public function updateData(): string {
        //
    }
}