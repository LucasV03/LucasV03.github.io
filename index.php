<?php 
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
$con = null; 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce de Perfumes</title>
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

    <section id="home" class="hero">
        <div class="container">
            <h2 class="arom"></h2>
        </div>
    </section>

    <div class="product">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <div class="numbertext">1 / 5</div>
                <img src="imgs/perfumgrand.jpg" alt="Descripción de la imagen 1">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">2 / 5</div>
                <img src="imgs/perfgra2.jpg" alt="Descripción de la imagen 2">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">3 / 5</div>
                <img src="imgs/Perfumes-franceses-para-hombre.jpg" alt="Descripción de la imagen 3">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">4 / 5</div>
                <img src="imgs/jhon.jpg" alt="Descripción de la imagen 4">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">5 / 5</div>
                <img src="imgs/Perfumes-masculinos-verano-2022-06.jpg" alt="Descripción de la imagen 5">
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
        </div>
    </div>

    <section id="products" class="products">
        <div class="container">
            <h2 class="prod">Mejores Productos</h2>
            <div class="mejores_productos">
                <?php 
                $count = 0;
                foreach($resultado as $row) {
                    if ($count >= 4) {
                        break;
                    }
                    else{
                        $count ++;
                    }  ?>
                    <div class="product-grid">
                        <div class="product-item">
                            <?php
                            $id = $row["id"];
                            $imagen = "imgs/productos/" . $id . "/prin.jpg";
                            if (!file_exists($imagen)) {
                                $imagen = "imgs/nofoto.jpg";
                            }
                            ?>
                            <div class="polaroid">
                                <img src="<?php echo htmlspecialchars($imagen); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                            </div>
                            <div class="producto">
                                <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                                <p class="price">$<?php echo number_format($row['precio'], 2, '.', ','); ?></p>
                                <button>Comprar</button>
                                <div class="rating">
                                    <input value="5" name="rate<?php echo $id; ?>" id="star5-<?php echo $id; ?>" type="radio">
                                    <label title="text" for="star5-<?php echo $id; ?>"></label>
                                    <input value="4" name="rate<?php echo $id; ?>" id="star4-<?php echo $id; ?>" type="radio">
                                    <label title="text" for="star4-<?php echo $id; ?>"></label>
                                    <input value="3" name="rate<?php echo $id; ?>" id="star3-<?php echo $id; ?>" type="radio" checked="">
                                    <label title="text" for="star3-<?php echo $id; ?>"></label>
                                    <input value="2" name="rate<?php echo $id; ?>" id="star2-<?php echo $id; ?>" type="radio">
                                    <label title="text" for="star2-<?php echo $id; ?>"></label>
                                    <input value="1" name="rate<?php echo $id; ?>" id="star1-<?php echo $id; ?>" type="radio">
                                    <label title="text" for="star1-<?php echo $id; ?>"></label>
                                </div> 
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>                
        </div>
    </section>

    <section id="about" class="about about-expand-lg">
        <div class="container">
            <h2>Acerca de Nosotros</h2>
            <p>Somos una tienda dedicada a ofrecer los mejores perfumes del mercado. Nuestra misión es proporcionar fragancias únicas y de alta calidad a nuestros clientes.</p>
        </div>
    </section>

    <section id="contact" class="contact contact-expand-lg">
        <div class="container">
            <h2>Contacto</h2>
            <form>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" required></textarea>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </section>

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
    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
        autoSlide = setTimeout(showSlides, 2000); // Cambiar imagen cada 2 segundos (2000 ms)
    }

    
        function plusSlides(n) {
            clearTimeout(autoSlide); // Clear the timeout to avoid interference
            slideIndex += n;
            if (slideIndex > slides.length) { slideIndex = 1 }
            if (slideIndex < 1) { slideIndex = slides.length }
            showSlidesManual();
        }
    
        function currentSlide(n) {
            clearTimeout(autoSlide); 
            slideIndex = n;
            showSlidesManual();
        }
    
        function showSlidesManual() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            autoSlide = setTimeout(showSlides, 4000);
        }
    
        
    </script>
    
    
    <script>
        
        document.getElementById('dark-mode-toggle').addEventListener('change', function() {
            document.body.classList.toggle('dark-mode');
            document.querySelector('header').classList.toggle('dark-mode');
            document.querySelector('footer').classList.toggle('dark-mode');
            document.querySelectorAll('button').forEach(btn => btn.classList.toggle('dark-mode'));
        });

        
        const images = document.querySelectorAll('.product-image');
        let currentImageIndex = 0;

        function showImage(index) {
            currentImageIndex = index;
            images.forEach((img, i) => {
                img.style.transform = `translateX(${-index * 100}%)`;
            });
        }
    </script>                        
    <script src="scripts.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
