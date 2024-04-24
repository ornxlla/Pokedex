<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Pokedex</title>
</head>
<body>
    <header>
                <nav>
                        <div class="logo">
                                <img src="img/pokeball.png">
                        </div>

                        <div class="nombrePag">
                                <h1>Pokedex</h1>
                        </div>

                        <div class="formularioIngreso">
                                <form class="ingreso">
                                        <input type="text" id="usuario" name="usuario" placeholder="Usuario">
                                        <input type="password" id="contrasenia" name="contrasenia" placeholder="Contraseña">
                                        <input type="submit" id="ingreso" name="ingreso" value="Ingresar">
                                </form>
                        </div>
                </nav>
    </header>
    <main>
                <form action="/buscar" method="GET">
                        <input type="text" name="q" id="buscar" placeholder="Ingrese el nombre, tipo o número de pokemon">
                        <input type="submit" id="buscarpokemon" name="buscarpokemon" value="¿Quién es este pokemon?">
                </form>
    </main>

    <footer>
                <div class="acomodarFooter">
                        <div class="seccion1Footer">
                                <div class="logoynombreFooter">
                                        <img src="img/pokeball.png">
                                        <h2>Pokedex</h2>
                                </div>
                                <div class="alumnos">
                                            <ul>
                                                <li><span>></span> Mayra Fazzari</li>
                                                <li><span>></span> Agustin Pucci Rubio</li>
                                                <li><span>></span> Solange De Bonis</li>
                                                <li><span>></span> Ornella Alonso Reyes</li>
                                            </ul>

                                </div>

                        </div>
                        <div class="drev">
                                <p>Derechos Reservados ©2024 Pokedex. Todos los derechos reservados.</p>
                        </div>

        </div>
    </footer>
</body>
</html>