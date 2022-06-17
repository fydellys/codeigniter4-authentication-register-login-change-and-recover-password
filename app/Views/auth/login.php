<?= $this->extend('index') ?>

<?= $this->section('content') ?>

<div class="container h-100" style="padding: 80px;">
    		<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2"><?= $title ?></h1>
							<p class="lead" ></p>
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

                                    <form action="<?= base_url('auth/login') ?>" method="post">

										<div class="form-group">
											<label>Email</label>
											<input class="form-control form-control-lg" type="email" name="email" value="<?= set_value('email') ?>">
										</div>
										<div class="form-group">
											<label>Senha</label>
											<input class="form-control form-control-lg" type="password" name="password" value="<?= set_value('password') ?>">
										</div>

                                        <?= @csrf_field() ?>

										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Login</button>
										</div>
                                        <br />
                                        <p class="text-center">
                                        Ainda não tem uma conta? <a href="<?= base_url('/auth/register') ?>">registre-se agora</a>!<br />
                                        <a href="<?= base_url('/auth/recovery-password') ?>">Esqueceu a sua senha?</a>
                                        </p>

									</form>

								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>



<?= $this->endSection('content') ?>