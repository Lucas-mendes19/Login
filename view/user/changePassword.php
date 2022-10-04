<?php include(__DIR__."/../startHeader.php"); ?>

    <?php include(__DIR__."/../menssage.php"); ?>
    <form class="mt-3" action="./../../../change/user/password/validate?token=<?= $token; ?>" method="POST">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card text-dark" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div>
                                    <h2 class="fw-bold mb-2 text-uppercase">Redefinir senha</h2>
                                    <p class="text-dark-50 mb-4">Por favor, digite sua nova senha!</p>

                                    <div class="form-outline form-dark mb-3">
                                        <label class="sr-only" for="inlineFormInput">Senha</label>
                                        <input name="password" type="password" class="form-control mb-2" id="inlineFormInput" placeholder="Senha">
                                    </div>

                                    <div class="form-outline form-dark mb-4">
                                        <label class="sr-only" for="inlineFormInput">Confirmar senha</label>
                                        <input name="confirmPassword" type="password" class="form-control mb-2" id="inlineFormInput" placeholder="Confirmar senha">
                                    </div>

                                    <button class="btn btn-outline-dark btn-lg px-5 mb-3" type="submit">Redefinir senha</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
<?php include(__DIR__."/../endFooter.php"); ?>
