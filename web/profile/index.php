<?php

session_start();

CONST SUBPAGE_TEMPLATE_PATH = "../templates/subPage/";
CONST PROFILE_TEMPLATE_PATH = "../templates/subPage/profile/";

if (isset($_SESSION["Username"])) {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "loggedHeadAndHeaderSubpage.html");
} else {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unloggedHeadAndHeaderSubpage.html");
}

$content = '<section id="team" style="padding-bottom: 30px">
    <div class="container os-animation">
        <div class="row filaContenedorCentrado">
            <div id="contenedorRegistro" class="col-lg-6 col-sm-6 col-md-3">
                <h2>Información de usuario</h2>
                <form>
                    <label for="nombreUsuario">Nombre de usuario</label>
                    <input id="nombreUsuario" type="text" maxlength="32" value=' . $_SESSION["Username"] . ' disabled>
                    <label for="nombreRol">Rol de usuario</label>
                    <input id="nombreRol" type="text" maxlength="32" value=' . $_SESSION["Role"] . ' disabled>
                </form>
                <form id="formulario" action="" style="visibility: hidden; display: none" >
                    <label for="nuevaContrasena">Nueva contraseña</label>
                    <input id="nuevaContrasena" type="password" maxlength="32" required>

                    <label for="repetirContrasena">Repetir contraseña</label>
                    <input id="repetirContrasena" type="password" maxlength="32" required>
                </form>

                <div class="contenedorBotones" >
                    <button onclick="logout()" style="background-color: rgba(214, 2, 2, 0.993); color: white;">Cerrar sesión</button>
                    <button id="cambioContrasena" onclick="mostrarContenidoParaElCambio()">Cambiar contraseña</button>
                </div>
                
                <div id="botonesCambio" class="contenedorBotones" style="visibility: hidden; display: none">
                    <button onclick="limpiarCampos()">Limpiar información</button>
                    <button onclick="editProfile()" style="background-color: rgba(105, 255, 46, 0.993);">Continuar</button>
                </div>
            
            </div>
        </div>
    </div>
        
    </div>
</section>';

$footer = file_get_contents(SUBPAGE_TEMPLATE_PATH . "footerSubpage.html");

$scripts = file_get_contents(PROFILE_TEMPLATE_PATH . "scriptsProfile.html");

$builtHtmlFile = $headAndHeader . $content . $footer . $scripts;

echo $builtHtmlFile;