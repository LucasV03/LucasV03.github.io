<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="carrito.css">
    <link rel="stylesheet" href="styles.css">
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
                    <button data-quantity="0" class="btn-cart">
                        <svg class="icon-cart" viewBox="0 0 24.38 30.52" height="30.52" width="24.38" xmlns="http://www.w3.org/2000/svg">
                            <title>icon-cart</title>
                            <path transform="translate(-3.62 -0.85)" d="M28,27.3,26.24,7.51a.75.75,0,0,0-.76-.69h-3.7a6,6,0,0,0-12,0H6.13a.76.76,0,0,0-.76.69L3.62,27.3v.07a4.29,4.29,0,0,0,4.52,4H23.48a4.29,4.29,0,0,0,4.52-4ZM15.81,2.37a4.47,4.47,0,0,1,4.46,4.45H11.35a4.47,4.47,0,0,1,4.46-4.45Zm7.67,27.48H8.13a2.79,2.79,0,0,1-3-2.45L6.83,8.34h3V11a.76.76,0,0,0,1.52,0V8.34h8.92V11a.76.76,0,0,0,1.52,0V8.34h3L26.48,27.4a2.79,2.79,0,0,1-3,2.44Zm0,0"></path>
                        </svg>
                        <span class="quantity"></span>
                    </button>
                </div>
            </nav>
        </div>
    </header>


    <div class="contenedor">
        <h1 class="encabezado-carrito">TU CARRITO</h1>
        <table class="tabla-carrito">
            <tr>
                <th>Artículo</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>
                    <img src="ruta/a/pequeno_bol.jpg" alt="Pequeño Bol" class="imagen-producto">
                    Pequeño Bol por Christian Roy
                </td>
                <td>1</td>
                <td>$34.00</td>
            </tr>
            <tr>
                <td>
                    <img src="imgs/productos/1/prin.jpg" alt="Pequeño Dip" class="imagen-producto">
                    Pequeño Dip por Atelier Tremà
                </td>
                <td>1</td>
                <td>$20.00</td>
            </tr>
        </table>
        <div class="total-carrito">
            <p>Envío: $10.00</p>
            <h3>Total: $64.00</h3>
        </div>
        <a href="checkout.php" class="boton-checkout">FINALIZAR COMPRA</a>
    </div>
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
                    <li><a href="#">Vases</a></li>
                    <li><a href="#">Mugs & Cups</a></li>
                    <li><a href="#">Plates</a></li>
                    <li><a href="#">Jugs</a></li>
                    <li><a href="#">Gift Baskets</a></li>
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
    </div>
</body>
</html>
