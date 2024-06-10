<?php 

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();


$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
$sql->execute([$id]);
if ($sql->fetchColumn() > 0) {
    $sql = $con->prepare("SELECT id, nombre, precio, descripcion FROM productos WHERE id=? AND activo=1 LIMIT 1");
    $sql->execute([$id]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    $id =$row['id'];
    $nombre =$row['nombre'];
    $precio =$row['precio'];
    $descripcion =$row['descripcion'];
}



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Productos</title>
    <link rel="stylesheet" href="design.css"> 
    <link rel="stylesheet" href="styles.css"> <!-- Estilos globales -->
    <link rel="stylesheet" href="productos.css"> <!-- Estilos específicos para productos -->
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
    
    <div class="product-container">
        <?php $imagen = "imgs/productos/$id/prin.jpg"; ?>
        <div class="product-image">
            <img src="<?php echo htmlspecialchars($imagen); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
        </div>
        <div class="product-details">
            <h1><?php echo $nombre ?></h1>
            <p class="price">$<?php echo number_format($precio,2, '.',',') ?></p>
            
            <div class="size-options">
                <p>2 TALLAS DISPONIBLES</p>
                <div class="sizes">
                    <button class="size selected">60 ml</button>
                    <button class="size">100 ml</button>
                </div>
            </div>
            <p class="description">
            <?php echo $descripcion ?>
            </p>
            <div class="purchase-options">
                <input type="number" value="1" min="1" class="quantity">
                <button class="add-to-cart" onclick="addProducto(<?php echo $id; ?>)">AGREGAR AL CARRITO</button>
                <button class="wishlist">&#x2661;</button>
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

<script>
function comprarProducto(id) {
    
    alert('Producto ' + $id[nombre] + ' añadido al carrito');
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const sizeButtons = document.querySelectorAll(".size");
    
    sizeButtons.forEach(button => {
        button.addEventListener("click", function() {
            // Remove the 'selected' class from all buttons
            sizeButtons.forEach(btn => btn.classList.remove("selected"));
            // Add the 'selected' class to the clicked button
            this.classList.add("selected");
        });
    });
});
</script>

<script>
    function addProducto(id){
        let url = 'clases/carrito.php'
        let formData = new FormData()
        formData.append('id', id)

        fetch(url,{
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data=> {
            if(data.ok){  
                let elemento = document.getElementById("num_cart");
                elemento.innerHTML = data.numero;
            }
        })
    }
</script>