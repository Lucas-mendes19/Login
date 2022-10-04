    <?php if(isset($_SESSION['menssage'])): ?>

   <div class="alert alert-<?= $_SESSION['type_menssage']; ?>" role="alert">
        <?= $_SESSION['menssage']; ?>
    </div>
    
    <?php
        unset($_SESSION['type_menssage'], $_SESSION['menssage']);
    endif;
    ?>