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

                                    <form action="<?= base_url('auth/recovery-password') ?>" method="post">

										<div class="form-group">
											<label>E-mail</label>
											<input type="email" class="form-control" name="email" id="email" value="<?= set_value('email') ?>" placeholder="">
										</div>
										
                                        <?= @csrf_field() ?>

										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Recuperar</button>
										</div>
                                        <br />
                                        <p class="text-center">
                                        Já tem uma conta? <a href="<?= base_url('/auth/login') ?>">faça o login</a>!
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