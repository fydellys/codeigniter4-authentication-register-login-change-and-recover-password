<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;

class DashboardController extends BaseController
{

    /**
     * Página inicial - Dashboard
     */

    public function index()
    {

        $authModel = new \App\Models\AuthModel();
        $loggedUserId = session()->get('loggedCustomer');
        $userInfo = $authModel->find($loggedUserId);

        $data['title'] = 'Dashboard';
        $data['userInfo'] = $userInfo;

        return view('/dashboard/index', $data);
    }

    /**
     * Página de alteração de senha
     */

    public function changePassword()
    {

        $data['title'] = 'Alterar senha';

        $authModel = new \App\Models\AuthModel();

        $validation = $this->validate([
            'password' => [
                'label' => 'Senha atual',
                'rules' => 'required|min_length[4]',
            ],
            'newpassword' => [
                'label' => 'Nova senha',
                'rules' => 'required|min_length[4]|differs[password]'
            ],
            'renewpassword' => [
                'label' => 'Confirme a nova senha',
                'rules' => 'required|min_length[4]|matches[newpassword]|differs[password]',
            ],
        ]);


        if ($this->request->getPost()) {

            if (!$validation) {

                return redirect()->to('/dashboard/change-password')->withInput()->with('errors', $this->validator->getErrors());
            } else {

                $password = $this->request->getPost('password');
                $newpassword = $this->request->getPost('newpassword');
                $renewpassword = $this->request->getPost('renewpassword');

                $loggedUserId = session()->get('loggedCustomer');
                $userInfo = $authModel->find($loggedUserId);
                $checkPassword = Hash::checkPassword($password, $userInfo->password);

                if ($checkPassword) {

                    $userInfo->password = $newpassword;

                    if ($authModel->update($userInfo->id, $userInfo)) {
                        session()->setFlashdata('success', 'A senha foi alterada com sucesso');
                    } else {
                        session()->setFlashdata('error', 'Houve um error ao alterar a sua senha');
                    }
                    return redirect()->to('/dashboard/change-password')->withInput();
                } else {
                    session()->setFlashdata('error', 'A senha atual informada foi digitada incorretamente');
                    return redirect()->to('/dashboard/change-password')->withInput();
                }
            }
        }

        return view('/dashboard/changePassword', $data);
    }


    /**
     * Página de alteração de foto
     */

    public function changePhoto()
    {
        $session = session();
        $authModel = new \App\Models\AuthModel();

        $loggedUserId = session()->get('loggedCustomer');
        $userInfo = $authModel->find($loggedUserId);

        $data['title'] = 'Alterar foto';
        $data['photo'] = $userInfo->photo;
        $data['name'] = $userInfo->name;

        if ($this->request->getPost()) {

            $file = $this->request->getFile("photo");

            $validationRules = [
                'photo' => [
                    'label' => 'Arquivo de foto',
                    'rules' => 'uploaded[photo]'
                        . '|is_image[photo]'
                        . '|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[photo,9000]'
                        . '|max_dims[photo,7680,4320]',
                ],
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->to('/dashboard/change-photo')->withInput()->with('errors', $this->validator->getErrors());
            } else {

                $photo = $file->getName();
                $newNamePhoto = $file->getRandomName();

                if ($file->move("uploads", $newNamePhoto)) {

                    $data = [
                        'name' => $this->request->getPost('name'),
                        'photo' => "uploads/" . $newNamePhoto,
                    ];

                    if (!is_null($userInfo->photo)) {
                        $deletePhoto = ltrim($userInfo->photo, '/');
                        unlink($deletePhoto);
                    }

                    if ($authModel->update($userInfo->id, $data)) {
                        $session->setFlashdata("success", "A foto foi atualizada com sucesso");
                    } else {
                        $session->setFlashdata("error", "Houve um erro na alteração dos dados");
                    }
                    return redirect()->to('/dashboard/change-photo');
                }
            }
            return view('/dashboard/changePhoto', $data);
        }
        return view('/dashboard/changePhoto', $data);
    }


    /**
     * Página de alteração de alteração de dados pessoais
     */

    public function changeData()
    {

        $authModel = new \App\Models\AuthModel();

        $getRule = $authModel->getRule('changeData');
        $authModel->setValidationRules($getRule);

        $loggedUserId = session()->get('loggedCustomer');
        $userInfo = $authModel->find($loggedUserId);

        $data['title'] = 'Alterar dados';
        $data['name'] = $userInfo->name;
        $data['email'] = $userInfo->email; // somente consulta

        if ($this->request->getPost()) {

            $values = [
                'name' => $this->request->getPost('name'),
            ];

            if ($authModel->update($userInfo->id, $values)) {
                return redirect()->to('/dashboard/change-data')->with('success', 'Dados atualizado com sucesso.');
            } else {
                return redirect()->to('/dashboard/change-data')->withInput()->with('errors', $authModel->errors());
            }
        }

        return view('/dashboard/changeData', $data);
    }


    /**
     * Página de configurações
     */

    public function changeSettings()
    {

        $settingsModel = new \App\Models\SettingsModel();
        $data['title'] = 'Alterar configurações';

        if ($this->request->getPost()) {

            $settingsModel->updatePost($this->request->getPost());
        }

        return view('dashboard/changeSettings', $data);
    }


}
