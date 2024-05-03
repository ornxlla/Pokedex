<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<header>
    <nav>
        <div class="logo">
            <img src="img/pokeball.png">
        </div>

        <div class="nombrePag">
            <h1>Pokedex</h1>
        </div>

        <div class="user-info">
            <?php
            if(isset($_SESSION['usuario'])){
                echo "<p class='usuarioBienvenido'>USUARIO:" . $_SESSION['usuario'] . "</p>";
                echo "<div class='usuarioLog'>";
               // echo "<a href='editarPerfil.php'>Editar</a>";
                echo "<a href='cerrarSesion.php'>Cerrar sesión</a>";
                echo "</div>";
            } else {
                echo "<form action='login.php' method='post'>";

            }
            ?>
        </div>
    </nav>
</header>