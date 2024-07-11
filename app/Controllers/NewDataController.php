<?php
namespace App\Controllers;

use App\Models\DataPointModel;
use CodeIgniter\I18n\Time;

class NewDataController extends BaseController {
    protected $modelName    = 'App\Models\DataPointModel';

    /** HTML interface to insert new datapoint into database
     */
    public function newDataForm(): string {
        helper('form');
        $model = model($this->modelName);

        $d = $model->getDataSinceTimestamp('30 days ago');

        return view('templates/header')
                . view('pages/data/new/newDataForm', ['title' => 'New Datapoint'])
                . view('templates/footer', $d);
    }
    /** Insert new datapoint into database
     */
    public function newData(): string {
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