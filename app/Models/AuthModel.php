<?php

namespace App\Models;

use CodeIgniter\BaseModel;
use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'email', 'password', 'repassword', 
                                'active','recovery_hash','recovery_expires','photo'];
    protected $dynamicRules = [
        'register' => [
            'name' => [
                'label' => 'Nome',
                'rules' => 'required|alpha_numeric_space|min_length[5]'
            ],
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required|valid_email|is_unique[customer.email]'
            ],
            'password' => [
                'label' => 'Senha',
                'rules' => 'required|min_length[4]'
            ],
            'repassword' => [
                'label' => 'Confirme a senha',
                'rules' => 'required|matches[password]',
            ],
        ],
        'changeData' => [
            'name' => [
                'label' => 'Nome',
                'rules' => 'required|alpha_numeric_space|min_length[5]'
            ],
        ],
    ];

    protected $useTimestamps    = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    public function getRule(string $rule)
    {
        return $this->dynamicRules[$rule];
    }

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        unset($data['data']['repassword']);
        return $data;
    }
}
