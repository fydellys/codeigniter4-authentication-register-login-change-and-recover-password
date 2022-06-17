<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name_key', 'key', 'value', 'group', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;


    public function updatePost(array $data)
    {

        $session = session();

        $table_data = array();
        foreach ($data as $key => $val) {

            $table_data['name_key'] = $key;
            $table_data['key'] = $key;
            $table_data['value'] = $val;

            $findKey = $this->where('key', $table_data['key'])->first();
            $this->delete(['id' => $findKey->id]);

            $values = [
                'name_key' => $table_data['name_key'],
                'key' => $table_data['key'],
                'value' => $table_data['value'],
                'group' => 'mail',
            ];

            $this->insert($values);
            $session->setFlashdata('success', 'Os dados foram atualizados com sucesso');
        }
    }
}
