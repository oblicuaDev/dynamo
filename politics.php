<?php 
  $activeMenu = 6; 
  $bodyClass = "new-intern"; 
  include 'includes/header.php';
  include 'includes/nav.php';
?> 
    <main>
        <div class="container">
            <?php 
            switch ($_GET["type"]) {
                case '1':
                    echo '<h2 class="uppercase">POLÍTICA DE RECEPCIÓN DE INFORMACIÓN Y PRESENTACIÓN DE IDEAS</h2>';
                    break;
                case '2':
                    echo '<h2 class="uppercase">POLÍTICA DE TRATAMIENTO DE DATOS PERSONALES</h2>';
                    break;
                case '3':
                    echo '<h2 class="uppercase">Términos y condiciones</h2>';
                    break;
            }
            ?>
        </div>
        <div class="content container">
            <div class="txt">
                <p>

                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias, temporibus tenetur odit, iure esse quisquam natus excepturi numquam nemo aperiam minima ducimus, nam consectetur facilis nostrum sint illum vel ex?
                </p>
            </div>

        </div>
    </main>
<?php include 'includes/footer.php'; ?>