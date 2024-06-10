<?php 
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

if ($productos != null) {
    foreach ($productos as $clave=> $cantidad) {
        $sql = $con->prepare("SELECT id, nombre, precio, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
                $sql->execute([$clave]);
                $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Productos</title>
    <link rel="stylesheet" href="checkout.css"> 
    <link rel="stylesheet" href="styles.css"> <!-- Estilos globales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>
<body>
<header>
    <div class="container">
        <nav class="navbar">
            <ul class="links">
                <li><a href="index.php#home">Inicio</a></li>
                <li><a href="index.php#products">Productos Destacados</a></li>
                <li><a href="productos.php">Todos los Productos</a></li>
                <li><a href="index.php#about">Acerca de Nosotros</a></li>
                <li><a href="index.php#contact">Contacto</a></li>
                
            </ul>
            <div class="logo">
                <a href="#">V Ė Ŗ Ā</a>
            </div>
            <div class="search-cart">
                <div class="toggle-switch">
                    <label class="switch-label">
                        <input type="checkbox" class="checkbox" id="dark-mode-toggle">
                        <span class="slider"></span>
                    </label>
                </div>
                <input type="text" placeholder="Buscar...">
                <div class="carrito">
                <a href="carrito.php">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <span class="texto-carrito" id="num_cart"><?php echo $num_cart;?></span>
                </div>
            </div>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        <h1>CHECKOUT</h1>
        <div class="checkout-form">
            <div class="left-side">
                <div class="contacts">
                    <h2>DATOS</h2>
                    <div class="contact-form">
                        <div class="name-inputs">
                            <input type="text" placeholder="Nombre">
                            <input type="text" placeholder="Apellido">
                        </div>
                        <input type="email" placeholder="E-mail">
                        <button>Ingresar</button>
                    </div>
                </div>
                <div class="shipping-address">
                    <h2>DATO DE ENVIO</h2>
                    <input type="text" placeholder="País">
                    <div class="city-postcode">
                        <input type="text" placeholder="Ciudad">
                        <input type="text" placeholder="Codigo Postal">
                    </div>
                    <input type="text" placeholder="Direccion">
                    <textarea placeholder="Observaciones"></textarea>
                    <div class="privacy-policy">
                        <input type="checkbox" id="privacy">
                        <label for="privacy">Acuerdo de politicas de privacidad</label>
                    </div>
                </div>
                <div class="shipping-method">
                    <h2>Método de Envío</h2>
                    <div>
                        <input type="radio" id="standard" name="shipping" value="standard" checked>
                        <label for="standard">Envío Estandar (8-10 Days) - Gratis</label>
                    </div>
                    <div>
                        <input type="radio" id="express" name="shipping" value="express">
                        <label for="express">Envío Express (1-5 Days) - $10</label>
                    </div>
                </div>
                <button class="payment-btn">Metodo de pago</button>
            </div>
            <div class="right-side">
                <h2>Tu orden</h2>
                <div class="order-item">
                    <img src="imgs/productos/1/prin.jpg" alt="elixir">
                    <div class="item-details">
                        <p>Sauvage Elixir</p>
                        <p>x1 - $262,200.00</p>
                    </div>
                </div>
                <div class="order-item">
                    <img src="imgs/productos/3/prin.jpg" alt="DIOR HOMME SPORT">
                    <div class="item-details">
                        <p>Dior Homme Sport</p>
                        <p>x10 - $154,500.00</p>
                    </div>
                </div>
                <div class="order-total">
                    <p>Shipping: FREE</p>
                    <p>Total: $416,700.00</p>
                </div>
            </div>
        </div>
    </div>
    </main>
<footer>
        <div class="footer-container">
            <div class="footer-section">
                <h2>V Ė Ŗ Ā</h2>
            </div>
            <div class="footer-section">
                <h3>MENU</h3>
                <ul>
                    <li><a href="productos.php">Todos los Productos</a></li>
                    <li><a href="index.php#about">Acerca de Nosotros</a></li>
                    <li><a href="index.php#contact">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>PRODUCTOS</h3>
                <ul>
                    <li><a href="#">DIOR</a></li>
                    <li><a href="#">Carolina Herrera</a></li>
                    <li><a href="#">Versace</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>SIGUENOS</h3>
                <ul>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Behance</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>