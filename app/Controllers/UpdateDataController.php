<?php
namespace App\Controllers;

use App\Models\DataPointModel;
// use CodeIgniter\I18n\Time;

class UpdateDataController extends BaseController {
    protected $modelName    = 'App\Models\DataPointModel';

    // HTML interface to edit/update an existing datapoint in the DB
    public function updateDataForm(): string {
        // helper('form');
        // // $d = ['title' => 'Edit Datapoint'];
        // return view('templates/header')
        //         . view('pages/data/update/index', ['title' => 'Edit Datapoint'])
        //         . view('templates/footer');
    }

    /** Update datapoint in database
     */
    public function updateData(): string {
        //
    }
}