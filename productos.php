<?php 
require 'config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Productos</title>
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

<main class="products-page">
    <section class="product-list">
        <div class="product-header">
            <h2>TIENDA</h2>
        </div>
        <div class="filters">
            <div class="filter-left">
                <label for="category">Categoría:</label>
                <select id="category" name="category">
                    <option value="all">Todas</option>
                    <option value="mens">Hombres</option>
                    <option value="womens">Mujeres</option>
                </select>
                <label for="price">Precio:</label>
                <input type="range" id="price" name="price" min="0" max="200">
            </div>
            <div class="filter-right">
                <label for="sort">Ordenar por:</label>
                <select id="sort" name="sort">
                    <option value="relevance">Relevancia</option>
                    <option value="price-asc">Precio: de menor a mayor</option>
                    <option value="price-desc">Precio: de mayor a menor</option>
                    <option value="rating">Calificación</option>
                </select>
            </div>
        </div>
        
        <div class="products">
            <?php
                
                require 'config/database.php';
                
                $db = new Database();
                $con = $db->conectar();

                $sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
                $sql->execute();
                $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
                $con = null;
                
                
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                $con = $db->conectar();
                if ($id > 0) {
                    $sql = $con->prepare("SELECT * FROM productos WHERE id = :id AND activo = 1");
                    $sql->execute(['id' => $id]);
                    $producto = $sql->fetch(PDO::FETCH_ASSOC);
                    $con = null; 

                    if ($producto) {
                        
                        echo "<h1>" . htmlspecialchars($producto['nombre']) . "</h1>";
                        echo "<p>Precio: $" . number_format($producto['precio'], 2, '.', ',') . "</p>";
                        
                    } else {
                        echo "Producto no encontrado.";
                    }
                } 
                
                foreach ($resultado as $row) {
                    $id = $row["id"];
                    $imagen = "imgs/productos/" . $id . "/prin.jpg";
                    if (!file_exists($imagen)) {
                        $imagen = "imgs/nofoto.jpg";
                    }
                    echo '
                    <div class="product-item">
                        <div class="polaroid">
                            <a href="detalles.php?id=' . htmlspecialchars($id) . '">
                                <img src="' . htmlspecialchars($imagen) . '" alt="' . htmlspecialchars($row['nombre']) . '">
                            </a>
                        </div>
                        <div class="producto">
                            <a href="detalles.php?id=' . htmlspecialchars($id) . '">
                                <h3>' . htmlspecialchars($row['nombre']) . '</h3>
                                <p class="price">$' . number_format($row['precio'], 2, '.', ',') . '</p>
                            </a>
                            <button onclick="comprarProducto(' . $id . ')">Comprar</button>
                            <button class="add-to-cart" onclick="addProducto(<?php echo $id; ?>)">AGREGAR AL CARRITO</button>
                        </div>
                    </div>';

                    
                }
            ?>
        </div>
    </section>
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