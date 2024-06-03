
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Productos</title>
    <link rel="stylesheet" href="styles.css"> <!-- Estilos globales -->
    <link rel="stylesheet" href="productos.css"> <!-- Estilos específicos para productos -->
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
                    <option value="unisex">Unisex</option>
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
                session_start();
                $db = new Database();
                $con = $db->conectar();

                $sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
                $sql->execute();
                $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
                $con = null;
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
                    $productId = $_POST['product_id'];
                    $productName = $_POST['product_name'];
                    $productPrice = $_POST['product_price'];
                
                    $cartItem = [
                        'id' => $productId,
                        'name' => $productName,
                        'price' => $productPrice,
                        'quantity' => 1
                    ];
                
                    if (isset($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['quantity'] += 1;
                    } else {
                        $_SESSION['cart'][$productId] = $cartItem;
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
                            <img src="' . htmlspecialchars($imagen) . '" alt="' . htmlspecialchars($row['nombre']) . '">
                        </div>
                        <div class="producto">
                            <h3>' . htmlspecialchars($row['nombre']) . '</h3>
                            <p class="price">$' . number_format($row['precio'], 2, '.', ',') . '</p>
                            <button>Comprar</button>
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
</body>
</html>

