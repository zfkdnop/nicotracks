<?php
namespace App\Controllers;

use App\Models\DataPointModel;
use CodeIgniter\I18n\Time;

class NewDataController extends BaseController {
    protected $modelName    = 'App\Models\DataPointModel';
    protected $helpers      =['form'];

    private function _saveData($data) {
        try {
            $model = model($this->modelName);
            $model->save($data);
        } catch(\Exception $e) {//catch(CodeIgniter\Database\Exceptions\DatabaseException $e) {
            $d = [
                'title' => $e.getCode(),
                'message' => $e.getMessage(),
            ];
            return view('errors/exception', $d);
            // if (e.getCode() == 1062) exit('Duplicate entry: '.e.getMessage());
            // else exit(e.getCode().': '.e.getMessage());
        }
    }

    /** HTML interface to insert new datapoint into database
     */
    public function newDataForm(): string {
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
        $this->_saveData([
                'ts' => $ts->toDateTimeString(),
                'mg' => $post['mg'] ?? 6,
                'brand' => $post['brand'] ?? 'Zyn',
                'ct' => $post['ct'] ?? 1,
                'instance' => implode('+', $post),
                // ^^ since instance was defined as an special datatype in the model it should use our typecaster class to appropriately convert this string
            ]);

        return view('templates/success_header')
            . view('pages/data/new/success')
            . view('templates/success_footer');
    }
    
    /************************************************************************
     * QUICK-ADD BUTTONS
    */
    public function quickAddZyn3(): string {
        $this->_saveData([
            'ts' => (new Time())->toDateTimeString(),
            'mg' => 3,
            'brand' => 'Zyn',
            'ct' => 1,
            'instance' => bin2hex(random_bytes(64)),
            // ^^ since instance was defined as an special datatype in the model it should use our typecaster class to appropriately convert this string
        ]);

        return view('templates/success_header')
            . view('pages/data/new/success')
            . view('templates/success_footer');
    }
    public function quickAddZyn6(): string {
        $this->_saveData([
            'ts' => (new Time())->toDateTimeString(),
            'mg' => 6,
            'brand' => 'Zyn',
            'ct' => 1,
            'instance' => bin2hex(random_bytes(64)),
            // ^^ since instance was defined as an special datatype in the model it should use our typecaster class to appropriately convert this string
        ]);

        return view('templates/success_header')
            . view('pages/data/new/success')
            . view('templates/success_footer');
    }
    public function quickAddOn8(): string {
        $this->_saveData([
            'ts' => (new Time())->toDateTimeString(),
            'mg' => 8,
            'brand' => 'On',
            'ct' => 1,
            'instance' => bin2hex(random_bytes(64)),
            // ^^ since instance was defined as an special datatype in the model it should use our typecaster class to appropriately convert this string
        ]);

        return view('templates/success_header')
            . view('pages/data/new/success')
            . view('templates/success_footer');
    }
    public function quickAddGum2(): string {
        $this->_saveData([
            'ts' => (new Time())->toDateTimeString(),
            'mg' => 2,
            'brand' => 'Gum',
            'ct' => 1,
            'instance' => bin2hex(random_bytes(64)),
            // ^^ since instance was defined as an special datatype in the model it should use our typecaster class to appropriately convert this string
        ]);

        return view('templates/success_header')
            . view('pages/data/new/success')
            . view('templates/success_footer');
    }
    public function quickAddGum4(): string {
        $this->_saveData([
            'ts' => (new Time())->toDateTimeString(),
            'mg' => 4,
            'brand' => 'Gum',
            'ct' => 1,
            'instance' => bin2hex(random_bytes(64)),
            // ^^ since instance was defined as an special datatype in the model it should use our typecaster class to appropriately convert this string
        ]);

        return view('templates/success_header')
            . view('pages/data/new/success')
            . view('templates/success_footer');
    }
}