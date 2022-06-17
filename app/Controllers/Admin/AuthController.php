<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;

class AuthController extends BaseController
{

    /**
     * Página inicial - Login
     */

    public function index()
    {

        $data['title'] = 'Login';

        $authModel = new \App\Models\AuthModel();

        $validation = $this->validate([
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required|valid_email|is_not_unique[customer.email]',
            ],
            'password' => [
                'label' => 'Senha',
                'rules' => 'required|min_length[4]'
            ],
        ]);

        if ($this->request->getPost()) {

            if (!$validation) {

                return redirect()->to('auth/login')->withInput()->with('errors', $this->validator->getErrors());
                return view('/auth/login', $data);
            } else {

                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $userInfo = $authModel->where('email', $email)->first();
                $checkPassword = Hash::checkPassword($password, $userInfo->password);

                if (!$checkPassword) {
                    return redirect()->to('/auth/login')->withInput()->with('error', 'A senha digitada está incorreta');
                } else {
                    $customerId = $userInfo->id;
                    session()->set('loggedCustomer', $customerId);
                    return redirect()->to('/dashboard');
                }
            }
        }

        return view('/auth/login', $data);
    }


    /**
     * Página - Cadastro/Registro
     */

    public function register()
    {
        $data['title'] = 'Registro';

        if ($this->request->getPost()) {

            $authModel = new \App\Models\AuthModel();
            $getRule = $authModel->getRule('register');
            $authModel->setValidationRules($getRule);

            $values = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'repassword' => $this->request->getPost('repassword'),
            ];

            if ($authModel->insert($values)) {
                $lastRegisterCustomer = $authModel->insertID();
                session()->set('loggedCustomer', $lastRegisterCustomer);
                return redirect()->to('/dashboard')->with('success', 'Parabéns! Cadastro realizado com sucesso.');
            } else {
                return redirect()->to('/auth/register')->withInput()->with('errors', $authModel->errors());
            }
        }

        return view('/auth/register', $data);
    }

    /**
     * Página - Logout
     */

    public function logout()
    {
        if (session()->has('loggedCustomer')) {
            session()->remove('loggedCustomer');
            session()->stop('loggedCustomer');
            return redirect()->to('/auth/login')->with('success', 'Usuário deslogado com sucesso.');
        }
    }

    /**
     * Página - Solicitação de recuperação de senha
     */

    public function recovery()
    {
        $authModel = new \App\Models\AuthModel();
        $data['title'] = 'Recuperação de senha';

        $validation = $this->validate([
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required|valid_email|is_not_unique[customer.email]',
            ],
        ]);

        if ($this->request->getPost()) {

            if (!$validation) {
                return redirect()->to('/auth/recovery-password')->withInput()->with('errors', $this->validator->getErrors());
            } else {

                $emailUser = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
                $startDate = time();
                $token = random_string('alnum', 20);
                $authtoken = password_hash($token, PASSWORD_DEFAULT);
                $message = ' ' . base_url() . '/auth/recovery-password/' . $authtoken . ' '; // token

                if (Settings('email_status') == 0) { 
                    $sendMail =  SendMailPhpMailer(Settings('phpmailer_username'), Settings('phpmailer_username'),$emailUser,$emailUser,'Recuperação de senha',$message);
                } else {
                    $sendMail = SendMail(Settings('phpmailer_username'), Settings('phpmailer_username'), $emailUser, $emailUser, 'Recuperação de senha', $message);
                }

                $data = [
                    'recovery_hash' => $authtoken,
                    'recovery_expires' => date('Y-m-d H:i:s', strtotime('+1 day', $startDate)),
                ];

                $userInfo = $authModel->where('email', $emailUser)->first();
                if($sendMail && $authModel->update($userInfo->id, $data)){
                    session()->setFlashdata('success', 'O link de recuperação de senha foi enviado para o seu e-mail.');
                    return redirect()->to(current_url());
                } else {
                    session()->setFlashdata('error', 'Houve um erro no envio do link de recuperação do seu e-mail. Entre em contato com o adminstrador do site.');
                }
            }
        }

        return view('/auth/recovery', $data);
    }

    /**
     * Página - Solicitação de recuperação de senha / alteração de senha
     */

    public function recoveryKey()
    {

        $request = \Config\Services::request();
        $url = explode("auth/recovery-password/", $request->getUri()->getPath());
        $keyGet = $url[1];

        $authModel = new \App\Models\AuthModel();
        $userInfo = $authModel->where('recovery_hash', $keyGet)->first();

        $data['title'] = 'Recuperação de senha';

        if (!$userInfo) {
            return redirect()->to('/auth')->withInput()->with('error', 'Acesso não autorizado para recuperação de senha');
        }
        if (date('Y-m-d H:i:s', time()) > $userInfo->recovery_expires) {
            return redirect()->to('/auth')->withInput()->with('error', 'Token de recuperação de senha vencido');
        } else {

            $validation = $this->validate([
                'password' => [
                    'label' => 'Nova senha',
                    'rules' => 'required|min_length[4]'
                ],
                'repassword' => [
                    'label' => 'Confirme a nova senha',
                    'rules' => 'required|min_length[4]|matches[password]',
                ],
            ]);


            if ($this->request->getPost()) {

                if (!$validation) {
                    return redirect()->to(current_url())->withInput()->with('errors', $this->validator->getErrors());
                } else {

                    $password = $this->request->getPost('password');
                    $repassword = $this->request->getPost('repassword');

                    $userInfo->password = $repassword;
                    $userInfo->recovery_hash = NULL;
                    $userInfo->recovery_expires = NULL;

                    if ($authModel->update($userInfo->id, $userInfo)) {
                        return redirect()->to('/auth')->withInput()->with('success', 'A senha foi alterada com sucesso');
                    } else {
                        session()->setFlashdata('error', 'Houve um error ao alterar a sua senha');
                    }
                    return redirect()->to(current_url())->withInput();
                }
            }

            return view('/auth/recovery_key', $data);
        }

        return view('/auth/recovery_key', $data);
    }
}
