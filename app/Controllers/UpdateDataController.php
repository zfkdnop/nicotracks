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
                . view('templates/footer');
    }

    /**
     * Display an HTML form populated with the details of a datapoint, for editing
     * @var ?string $datapointID    the database table id of the entry to be edited
     */
    public function updateDataForm(?string $datapointID): string {
        if (is_numeric($datapointID) === false) return $this->listDataPoints();
        $d = [
            'title' => 'Editing entry #'.intval($datapointID),

        ];
        return view('templates/header')
            . view('pages/data/update/updateDataForm', $d)
            . view('templates/footer');
    }

    /** Update datapoint in database
     */
    public function updateData(): string {
        return view('templates/header')
            . view('pages/data/new/success')
            . view('templates/footer');

        $model = model($this->modelName);

        //validate inputs
        if (!$this->validateData($this->request->getPost(['date', 'time', 'mg', 'brand', 'ct']), $model->validationRequirements))
            return $this->newDataForm();
        $post = $this->validator->getValidated();

        // if any inputs were empty strings, unset them for use with the ?? operator below so we can set default values
        foreach ($post as $k => $v)
            if (trim($post[$k]) === '') unset($post[$k]);

        $ts = new Time($post['date'].' '.$post['time']);        
        try {
            $model->save([
                'ts' => $ts->toDateTimeString(),
                'mg' => $post['mg'] ?? 6,
                'brand' => $post['brand'] ?? 'Zyn',
                'ct' => $post['ct'] ?? 1,
                'instance' => implode('+', $post),
                // ^^ since instance was defined as an special datatype in the model it should use our typecaster class to appropriately convert this string
            ]);
        } catch(\Exception $e) {//catch(CodeIgniter\Database\Exceptions\DatabaseException $e) {
            $d = [
                'title' => $e.getCode(),
                'message' => $e.getMessage(),
            ];
            return view('errors/exception', $d);
            // if (e.getCode() == 1062) exit('Duplicate entry: '.e.getMessage());
            // else exit(e.getCode().': '.e.getMessage());
        }

        return view('templates/header')
            . view('pages/data/new/success')
            . view('templates/footer');
    }
}