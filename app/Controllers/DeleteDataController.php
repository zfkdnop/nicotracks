<?php
namespace App\Controllers;

use App\Models\DataPointModel;
// use CodeIgniter\I18n\Time;

class DeleteDataController extends BaseController {
    protected $modelName    = 'App\Models\DataPointModel';

    // HTML interface to delete an existing datapoint in the DB
    public function deleteDataForm(): string {
        // return view('templates/header')
        //         . view('pages/data/delete/index', ['title' => 'Delete Datapoint'])
        //         . view('templates/footer');
    }

    /** Delete datapoint from database
     */
    public function deleteData(): string {
        //
    }
}