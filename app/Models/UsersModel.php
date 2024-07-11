<?php
namespace App\Models;

use CodeIgniter\Model;

 /**
  * id              - unsigned int primary key
  * username        - tinytext
  * displayname     - tinytext
  * passwd          - char()
  * usergroup       - SET (users, admins)
  */

class UsersModel extends Model {
    protected $table            = 'users';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    //protected $returnType = 'array';  // default: 'array'
    protected array $casts  = [          // default: []
                                'id'            => 'int',
                                // 'username'      => 'string', // handler 'string' isnt defined because its the default datatype
                                // 'displayname'   => 'string',
                                // 'passwd'        => 'string',
                                // 'usergroup'     => 'string',
                            ];
    protected array $castHandlers = [   // default []
                                        // 'blowfish' => \App\Models\TypeCasters\CastBlowfish::class,
                                    ];

    protected $allowedFields    = ['id', 'username', 'displayname', 'passwd', 'usergroup'];

    // Dates
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;         // set `$deletedField` to timestamp instead of deleting row from database; hard deletes are processed in batches at a later date
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

    /**
     * username     - alpha-numeric, max 16 chars, may contain _ and -, cannot start or end with _ or -
     * displayname  - same as above except: max 24 chars
     * passwd       - password hash
     * usergroup    - can be either 'users' or 'admins'
     */
    /**
     * Validation requirements for creating a new user (`users` table)
     */
    protected array $userCreationValidation = [
        'username'  => 'required|string|min_length[2]|max_length[16]|regex_match[/^[a-zA-Z0-9][a-zA-Z0-9_-]{0,14}[a-zA-Z0-9]$/]',
        'displayname' => 'permit_empty|string|min_length[2]|max_length[24]|regex_match[/^[a-zA-Z0-9][a-zA-Z0-9_-]{0,22}[a-zA-Z0-9]$/]',
        'passwd'    => 'required|string',
        'usergroup' => 'permit_empty|string|regex_match[/^(users|admins)$/]',
    ];

    /** 
     * Validation requirements for use when validating the login form (`users` table)
     */
    protected array $userLoginValidation = [
        'username'  => 'required|min_length[2]|max_length[16]|regex_match[/^[a-zA-Z0-9][a-zA-Z0-9_-]{0,14}[a-zA-Z0-9]$/]',
        'passwd'    => 'required|min_length[2]',
    ];

    /**
     * Query database for the record pertaining to specific user, by username
     * @var string
     */
    public function getUser(string $un): array {
        return $this->where($un, 'username')->first();
    }
    public function getUserByUsername(string $un): array {
        return $this->getUser($un);
    }
    
    /**
     * Query database for the record pertaining to specific user, by ID
     * @var string|int
     */
    public function getUserById(int|string $id): array {
        return $this->where($id, 'id')->first();
    }

}