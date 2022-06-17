<?= $this->extend('index') ?>

<?= $this->section('content') ?>

<div class="container h-100" style="padding: 80px;">
    		<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-60 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2"><?= $title ?></h1>
							<p class="lead" >

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
                                    
                                    <h4 class="text-center">Seja bem vindo <?= $userInfo->name ?>!</h4>


								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>



<?= $this->endSection('content') ?>