<?= $this->extend('index') ?>

<?= $this->section('content') ?>

<div class="container h-100" style="padding: 80px;">
    <div class="row h-100">
        <div class="col-sm-10 col-md-8 col-lg-60 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2"><?= $title ?></h1>
                    <p class="lead">

                        <a class="btn btn-primary" href="<?= base_url('dashboard') ?>" role="button">Dashboard</a>
                        <a class="btn btn-primary" href="<?= base_url('dashboard/change-password') ?>" role="button">Alterar senha</a>
                        <a class="btn btn-primary" href="<?= base_url('dashboard/change-data') ?>" role="button">Alterar dados</a>
                        <a class="btn btn-primary" href="<?= base_url('dashboard/change-photo') ?>" role="button">Alterar foto</a>
                        <a class="btn btn-warning" href="<?= base_url('dashboard/change-settings') ?>" role="button">Configurações</a>
                        <a class="btn btn-danger" href="<?= base_url('auth/logout') ?>" role="button">Sair</a>

                    </p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">

                            <?php $errors = session()->getFlashdata('errors'); ?>
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        <?php foreach ($errors as $error) : ?>
                                            <li><?php echo $error ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif ?>

                            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error'); ?>
                                </div>
                            <?php endif ?>


                            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                            <?php endif ?>

                            <form action="<?= base_url('dashboard/change-settings') ?>" method="post" enctype="multipart/form-data">
                                <div class="container">
                                    <div class="row col-12">

                                        <div class="col-12">
                                        <h5>Configurações de e-mail</h5>
                                        <hr>

                                        <select class="form-select" name="mail_method" id="mail_method" aria-label="Default select example">
                                            <option selected>Selecione um método de envio de e-mails</option>
                                            <option value="0" <?php if (Settings('mail_method') == 0) { echo 'selected'; } else { echo ''; } ?>>PHP Mailer</option>
                                            <option value="1" <?php if (Settings('mail_method') == 1) { echo 'selected'; } else { echo ''; } ?>>SMTP - Padrão</option>
                                        </select>   
                                        <br />
                                        </div>

                                        <div class="col-6">
                                            <strong>PHP Mailer</strong>
                                            <div class="form-group">
                                                <label>Hostname</label>
                                                <input type="text" class="form-control" name="phpmailer_host" id="phpmailer_host" value="<?= Settings('phpmailer_host') ?>" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="text" class="form-control" name="phpmailer_username" id="phpmailer_username" value="<?= Settings('phpmailer_username') ?>" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Senha</label>
                                                <input type="text" class="form-control" name="phpmailer_password" id="phpmailer_password" value="<?= Settings('phpmailer_password') ?>" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Segurança (tls/ssl)</label>
                                                <input type="text" class="form-control" name="phpmailer_secure" id="phpmailer_secure" value="<?= Settings('phpmailer_secure') ?>" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Porta</label>
                                                <input type="text" class="form-control" name="phpmailer_port" id="phpmailer_port" value="<?= Settings('phpmailer_port') ?>" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Charset</label>
                                                <input type="text" class="form-control" name="phpmailer_charset" id="phpmailer_charset" value="<?= Settings('phpmailer_charset') ?>" placeholder="">
                                            </div>

                                        </div>

                                        <div class="col-6">
                                            <strong>SMTP - Padrão</strong>
                                            <div class="form-group">
                                                <label>Hostname</label>
                                                <input type="text" class="form-control" name="email_host" id="email_host" value="<?= Settings('email_host') ?>" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="text" class="form-control" name="email_username" id="email_username" value="<?= Settings('email_username') ?>" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Senha</label>
                                                <input type="text" class="form-control" name="email_password" id="email_password" value="<?= Settings('email_password') ?>" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Segurança (tls/ssl)</label>
                                                <input type="text" class="form-control" name="email_secure" id="email_secure" value="<?= Settings('email_secure') ?>" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Porta</label>
                                                <input type="text" class="form-control" name="email_port" id="email_port" value="<?= Settings('email_port') ?>" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Charset</label>
                                                <input type="text" class="form-control" name="email_charset" id="email_charset" value="<?= Settings('email_charset') ?>" placeholder="">
                                            </div>

                                        </div>




                                    </div>
                                </div>
                                <?= @csrf_field() ?>

                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">Alterar</button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<?= $this->endSection('content') ?>