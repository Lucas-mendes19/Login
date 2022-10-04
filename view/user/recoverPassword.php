<?php include(__DIR__."/../startHeader.php"); ?>

    <?php include(__DIR__."/../menssage.php"); ?>
    <form class="mt-3" action="./../../user/send/email/code" method="POST">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card text-dark" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div>
                                    <h2 class="fw-bold mb-2 text-uppercase">Recuperar senha</h2>
                                    <p class="text-dark-50 mb-4">Esqueceu sua senha? Digite seu e-mail que enviaremos um link para definir uma nova senha.</p>

                                    <div class="form-outline form-dark mb-4">
                                        <label class="sr-only" for="inlineFormInputGroup">Email</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">@</div>
                                            </div>
                                            <input name="email" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Endereço de e-mail">
                                        </div>
                                    </div>

                                    <button class="btn btn-outline-dark btn-lg px-4" type="submit">Recuperar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
<?php include(__DIR__."/../endFooter.php"); ?>
