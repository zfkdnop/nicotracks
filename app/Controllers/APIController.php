<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\I18n\Time;

class APIController extends ResourceController {
    protected $modelName    = 'App\Models\DataPointModel';
    protected $format       = 'json';

    public function newDataEndpoint(): string|Response {
        $model = model($this->modelName);
        
        //validate inputs
        if (!$this->validateData(
                $this->request->getPost(['date', 'time', 'mg', 'brand', 'ct']),
                $model->validationRequirements))
            $r = [
                'result' => 'error',
                'data' => ['invalid inputs', $this->validator->getErrors()],
            ];
        else {
            $post = $this->validator->getValidated();

            // if any inputs were empty strings, unset them for use with the ?? operator below so we can set default values
            foreach ($post as $k => $v)
                if (trim($post[$k]) == '') unset($post[$k]);
            
            try {
                $model->save([
                    'ts' => (new Time($post['date'].' '.$post['time']))->toDateTimeString(),
                    'mg' => $post['mg'] ?? 6,
                    'brand' => $post['brand'] ?? 'Zyn',
                    'ct' => $post['ct'] ?? 1,
                    'instance' => implode('+', $post),
                    // ^^ since instance was defined as an `md5` datatype, it should use CastMD5 to convert this string to an MD5 hash
                ]);
                $r = [
                    'result' => 'success',
                    'data' => '',
                ];
            } catch(CodeIgniter\Database\Exceptions\DatabaseException $e) {
                $r = [
                    'result' => 'error',
                    'data' => e.getCode() == 1062 ? 'duplicate entry' : ''.$e.getMessage(),
                ];
                // if (e.getCode() == 1062) exit('Duplicate entry: '.e.getMessage());
                // else exit(e.getCode().': '.e.getMessage());
            } catch(\Exception $e) {
                $r = [
                    'result' => 'error',
                    'data' => ''.$e.getMessage(),
                ];
            }
        }

        return $this->setResponseFormat('json')->respond($r);
    }

    public function updateDataEndpoint(): string {
        //
    }

    public function deleteDataEndpoint(): string {
        //
    }
}