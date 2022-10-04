<?php include(__DIR__."/../startHeader.php"); ?>

    <?php include(__DIR__."/../menssage.php"); ?>
    <div class="container py-5 h-100">
        <form class="mt-3" action="./user/validate" method="POST">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4"><span class="text-danger">*</span> Email</label>
                    <input type="text" name="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress"><span class="text-danger">*</span> Nome Completo</label>
                    <input type="text" name="name" class="form-control" id="inputAddress" placeholder="Nome Completo">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="inputPassword4"><span class="text-danger">*</span> Senha</label>
                    <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Senha">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="inputAddress"><span class="text-danger">*</span> Confirmar Senha</label>
                    <input type="password" name="confirmPassword" class="form-control" id="inputAddress" placeholder="Confirmar Senha">
                </div>
            </div>

            <button type="submit" class="btn btn-dark">Cadastrar-se</button>
        </form>
    </div>

<?php include(__DIR__."/../endFooter.php"); ?>
