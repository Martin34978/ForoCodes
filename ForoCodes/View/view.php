
<?php
/*              Alerta Cookies
El botón envia por GET cookies-policy y por tanto
entra en el if que crea la cookie y evitando entrar
en el if que muestra el cartel                    */
function cookiesPolicy(){
if(isset($_REQUEST['cookies-policy'])) {
    $time = time() + (60 * 60 * 24 * 7);
    setcookie('policy', '1', $time, '/', NULL, TRUE, TRUE);
}
if (!isset($_REQUEST['cookies-policy']) && !isset($_COOKIE['policy'])){
echo <<<EOT
<div class="d-flex justify-content-center container mt-5">
    <div class="row">
        <div class="col-md-10">
            <div class="d-flex flex-row justify-content-between align-items-center card cookie p-3">
                <div class="d-flex flex-row align-items-center"><img src="https://i.imgur.com/Tl8ZBUe.png" width="40">
                    <div class="ml-2 mr-2"><span>Si triste es perdir, mas triste es robar.<br>Usamos cookies para el funcionamiento de la web.<br> Estas cookies
                     son estrictamente funcionales y novendemos datos a terceros.<br></span><a class="learn-more" href="https://www.iglesia.net/biblia/libros/apocalipsis.html">Leer la biblia<i class="fa fa-angle-right ml-2"></i></a></div>
                </div>
                <div><a href="?cookies-policy=1" class="btn btn-dark" type="button">Aceptar</a></div>
            </div>
        </div>
    </div>
</div>
EOT;
}
}
?>