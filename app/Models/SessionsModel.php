<?php
namespace App\Models;

use CodeIgniter\Model;

 /**
  * id          - unsigned int, primary key
  * userid      - unsigned int
  * token       - text, unique key
  * ip          - tinytext
  * created_at  - unsigned int
  * updated_at  - unsigned int
  * deleted_at  - unsigned int
  */

class SessionsModel extends Model {
    protected $table            = 'sessions';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    //protected $returnType = 'array';  // default: 'array'
    protected array $casts  = [          // default: []
                                'id'        => 'int',
                                'userid'    => 'int',
                                // 'token'     => 'string', // default datatype is string, so caster 'string' is not defined/needed
                                // 'ip'        => 'string',
                            ];
    protected array $castHandlers = [   // default []
                                        // 'sha256' => \App\Models\TypeCasters\CastSHA256::class,
                                    ];

    protected $allowedFields    = ['id', 'userid', 'token', 'ip'];

    // Dates
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = false;         // set `$deletedField` to timestamp instead of deleting row from database; hard deletes are processed in batches at a later date
    protected $dateFormat       = 'int';        // Allowed: 'datetime', 'date', 'int'
    protected $createdField     = 'created_at'; // default: 'created_at'
    protected $updatedField     = 'updated_at'; // default: 'updated_at'
    protected $deletedField     = 'deleted_at'; // default: 'deleted_at'

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

    protected $autoExpireHours      = 48; // hours
    protected $autoExpireMinutes    = 0; // minutes

    /** 
     * Validation requirements for use when inserting a new session (`sessions` table)
     */
    protected array $sessionCreationValidation = [
        'userid'    => 'required|int',
        'token'     => 'required|min_length[2]',
        'ip'        => 'required|min_length[7]|max_length[15]'
    ];
}