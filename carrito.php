<?php 
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
$lista_carrito = [];
if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {
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
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="carrito.css">
    <link rel="stylesheet" href="styles.css">
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
                    <div class="carrit">
                        <a href="carrito.php">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                        <span class="texto-carrito" id="num_cart"><?php echo $num_cart;?></span>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="contenedor">
        <h1 class="encabezado-carrito">TU CARRITO</h1>
        <table class="tabla-carrito">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if($lista_carrito != null) {
                    $total = 0;
                    foreach ($lista_carrito as $producto) {
                        $_id = $producto['id'];
                        $nombre = $producto['nombre'];
                        $precio = $producto['precio'];
                        $cantidad = $producto['cantidad'];
                        $subtotal = $cantidad * $precio;
                        $total += $subtotal;
                ?>
                <tr>
                    <td><?php echo $nombre; ?></td>
                    <td>$<?php echo number_format($precio, 2, '.', ','); ?></td>
                    <td>
                        <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                    </td>
                    <td>
                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">$<?php echo number_format($subtotal, 2, '.', ','); ?></div>
                    </td>
                    <td>
                        <a href="#" id="eliminar" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <?php } ?>
        </table>
        <div class="total-carrito">
            <h3 id="total">Total: $<?php echo number_format($total, 2, '.', ','); ?></h3>
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

    <script>
        function actualizaCantidad(cantidad, id) {
    let url = 'clases/actualizar_carrito.php';
    let formData = new FormData();
    formData.append('action', 'agregar');
    formData.append('id', id);
    formData.append('cantidad', cantidad);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    }).then(response => {
        return response.text().then(text => {
            try {
                return JSON.parse(text);
            } catch (error) {
                console.error('Respuesta no válida del servidor:', text);
                throw new Error('Respuesta no válida del servidor');
            }
        });
    }).then(data => {
        if (data.ok) {
            let divsubtotal = document.getElementById('subtotal_' + id);
            divsubtotal.innerHTML = data.sub;

            let total = 0.00;
            let list = document.getElementsByName('subtotal[]');

            for (let i = 0; i < list.length; i++) {
                total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''));
            }

            total = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(total);
            document.getElementById('total').innerHTML = "$" + total;
        } else {
            alert('Hubo un problema con la actualización del carrito. Por favor, inténtelo de nuevo.');
        }
    }).catch(error => {
        console.error('Error:', error);
        alert('Hubo un problema con la actualización del carrito. Por favor, inténtelo de nuevo.');
    });
}

    </script>
</body>
</html>
