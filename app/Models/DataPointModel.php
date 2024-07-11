<?php
namespace App\Models;

use App\Models\TypeCasters\CastMD5;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

 /**
  * id          - unsigned int; PHP doesn't support unsigned ints - ints that overflow will be converted to floats: https://www.php.net/manual/en/language.types.integer.php
  * ts          - timestamp
  * mg          - tinyint
  * brand       - tinytext
  * ct          - unsigned int
  * instance    - tinytext
  */

class DataPointModel extends Model {
    protected $table            = 'nic';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    //protected $returnType = 'array';  // default: 'array'
    protected array $casts  = [          // default: []
                                'id'        => 'int',
                                // 'ts'        => 'timestamp',
                                'mg'        => 'int',
                                // 'brand'     => 'string',
                                'ct'        => 'int',
                                'instance'  => 'md5',
                            ];
    protected array $castHandlers = [   // default []
                                        'md5' => CastMD5::class,
                                    ];
    //protected $useSoftDeletes = true;     // default: false; see $deletedField

    protected $allowedFields    = ['id', 'ts', 'mg', 'brand', 'ct', 'instance'];

    // Dates
    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';   // Allowed: 'datetime', 'date', 'int'
    protected $createdField     = 'ts';         // default: 'created_at'
    protected $updatedField     = '';           // default: 'updated_at'
    protected $deletedField     = '';           // default: 'deleted_at'

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks   = true;
    // protected $beforeInsert     = [];
    // protected $afterInsert      = [];
    // protected $beforeUpdate     = [];
    // protected $afterUpdate      = [];
    // protected $beforeFind       = [];
    // protected $afterFind        = [];
    // protected $beforeDelete     = [];
    // protected $afterDelete      = [];

    /**
     * 
     */
    protected array $validationRequirements = [
        'date' => 'required|regex_match[/[\\d]{1,2}.[\\d]{1,2}.[\\d]{2,4}/]',
        'time' => 'required|regex_match[/[\\d]{1,2}\\S[\\d]{1,2}/]',
        'mg' => 'permit_empty|numeric',
        'brand' => 'permit_empty|string|min_length[2]|max_length[254]',
        'ct' => 'permit_empty|numeric',
    ];

    /**
     * Return nicotine data from database which was inserted after $startDate (default '30 days ago')
     * A Time-parsable string should be used
     * @var ?string
     */
    public function getDataSinceTimestamp(?string $startDate = null): array {
        // if no startDate is defined, default to a startDate of "the date 30 days before today"
        if (!$startDate) $tsStart = Time::parse('30 days ago')->getTimestamp();
        else $tsStart = Time::parse($startDate)->getTimestamp();

        return ['chartData' => $this->where('UNIX_TIMESTAMP(ts) >', $tsStart)->orderBy('UNIX_TIMESTAMP(ts)', 'ASC')->findAll(),
                'showCharts' => 1,
                ];
    }

}