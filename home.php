<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwooshX - Home</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<header class="main-header">
    <div class="header-left">
        <div class="logo">SwooshX</div>
    </div>
    <div class="header-center">
        <nav class="main-nav">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
            </ul>
        </nav>
    
    </div>
    <div class="header-right">
        <form class="search-form" action="shop.php" method="get">
            <input type="text" name="search" placeholder="Search products..." />
            <button type="submit">🔍</button>
        </form>
        <a href="cart.php" class="icon-link">🛒</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="icon-link">Logout</a>
        <?php else: ?>
            <a href="login.html" class="icon-link">Login</a>
        <?php endif; ?>
    </div>
</header>
<div class="promo-banner">
  <p>🔥 Summer Sale - Up to 50% Off on Selected Styles! 🔥</p>
</div>
<<section class="hero">
    <div class="banner-wrapper">
        <div class="banner-slide">
            <img src="images/banner.jpg" alt="Hero Banner" class="hero-image">
            <div class="banner-caption">
                <h1>Step Into Style with SwooshX</h1>
                <p>Find the best shoes for every occasion.</p>
            </div>
        </div>
        <div class="banner-slide">
            <img src="images/banner.jpg" alt="Featured Banner 2" class="hero-image">
            <div class="banner-caption">
                <h1>Fresh Arrivals Just In</h1>
                <p>Be the first to rock the newest styles.</p>
            </div>
        </div>
        <div class="banner-slide">
            <img src="images/banner.jpg" alt="Featured Banner 2" class="hero-image">
            <div class="banner-caption">
                <h1>Bestest shoes Ever</h1>
                <p>Be the first to rock the newest styles.</p>
            </div>
        </div>
    </div>
</section>
<section class="categories">
    <h2>Shop by Category</h2>
    <div class="category-gallery">
        <div class="category-item">
                <img src="https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/a5ce41b6-b350-48ff-8838-f09a6b07b737/W+NIKE+VOMERO+18.png" >
                <h3>Running Shoes</h3>
        </div>
        <div class="category-item">
                <img src="https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/77874acd-bf25-4037-bf21-9b442d1b28eb/NIKE+VICTORI+ONE+SLIDE.png" >
                <h3>Slipers</h3>
            
        </div>
        <div class="category-item">
                <img src="https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/ed8d46c0-d433-467c-a72a-c850d6380c85/NIKE+SB+DUNK+LOW+PRO.png" >
                <h3> SB Dunk Low</h3>
            
        </div>
        <div class="category-item">
                <img src="https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/693f9b4d-95da-4df4-916e-f05c35c850d8/AIR+JORDAN+1+RETRO+HIGH+OG.png">
                <h3>Air Jordan High</h3>
        </div>
    </div>
</section>
<section class="featured-products">
         <h2>Top Sellers Shoes</h2>
        <div class="product-gallery">
        <div class="product-item">
        <img src="https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/8ed56989-0a03-4186-a61a-bad7acf1b135/A%27ONE.png" alt="Nike Air Max 90">
        <h3>A'One "Pink A'ura"</h3>
    </div>
    <div class="product-item">
        <img src="https://static.nike.com/a/images/t_default/10cda5a9-d0cd-48d1-a1a6-e801fae758a5/air-force-1-07-shoes.png" alt="Nike Air Force 1">
        <h3>Nike Air Force 1</h3>
    </div>
    <div class="product-item">
        <img src="https://static.nike.com/a/images/t_default/8c0d0c9a-3a60-43f4-bb4a-570c1ad8d4b3/dunk-low-retro-shoes.png" alt="Nike Dunk Low">
        <h3>Nike Dunk Low</h3>
    </div>
    <div class="product-item">
        <img src="https://static.nike.com/a/images/t_default/38b393f2-94b2-4862-bc3c-2a28d79f3c95/air-jordan-1-mid-shoes.png" alt="Air Jordan 1 Mid">
        <h3>Air Jordan 1 Mid</h3>
    </div>
    </section>
    <section class="new-arrivals">
    <h2>New Arrivals</h2>
    <div class="product-gallery">
        <div class="product-item">
            <img src="https://static.nike.com/a/images/t_default/4ba26b11-684e-4899-b186-6634079cf325/air-max-dn-shoes.png" alt="Nike Air Max DN">
            <h3>Nike Air Max DN</h3>
            <p>$140</p>
            <a href="shop.php" class="add-to-cart">Shop Now</a>
        </div>
        <div class="product-item">
            <img src="https://static.nike.com/a/images/t_default/ede8b4cf-5171-417b-87dc-2a3cb5ffdb80/air-jordan-6-retro-shoes.png" alt="Air Jordan 6 Retro">
            <h3>Air Jordan 6 Retro</h3>
            <p>$160</p>
            <a href="shop.php" class="add-to-cart">Shop Now</a>
        </div>
        <div class="product-item">
            <img src="https://static.nike.com/a/images/t_default/2e6b7303-8392-4079-8752-35086a33fc3a/jordan-spizike-low-shoes.png" alt="Jordan Spizike Low">
            <h3>Jordan Spizike Low</h3>
            <p>$150</p>
            <a href="shop.php" class="add-to-cart">Shop Now</a>
        </div>
        <div class="product-item">
            <img src="https://static.nike.com/a/images/t_default/c0a9aecc-4385-4039-8752-ec14651d6c27/air-max-1-shoes.png" alt="Nike Air Max 1">
            <h3>Nike Air Max 1</h3>
            <p>$135</p>
            <a href="shop.php" class="add-to-cart">Shop Now</a>
        </div>
    </div>
</section>
<section class="why-choose-us">
    <h2>Why Choose SwooshX?</h2>
    <div class="features-grid">
        <div class="feature-box">
            <img src="https://imgs.search.brave.com/FNNFX6vbVa7Z0LnVADyedby_C5n40P7EUfYDBTQChY8/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTQ5/MTY2MDgyMy92ZWN0/b3IvZmFzdC1zaGlw/cGluZy10aGluLWxp/bmVzLWljb24uanBn/P3M9NjEyeDYxMiZ3/PTAmaz0yMCZjPVZq/aFNrNEJiQjBFQzdo/bGxZemRxWk5jV0Ft/aWlIX0kwd0ZwNDhF/aHZyZ289" alt="Fast Shipping">
            <h3>Fast Shipping</h3>
            <p>Get your kicks delivered quickly with our express shipping options worldwide.</p>
        </div>
        <div class="feature-box">
            <img src="https://imgs.search.brave.com/pBfBsCxYDb3JH_qhPSfyZibeYOfC8W3vmbZVYmONL-o/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly90My5m/dGNkbi5uZXQvanBn/LzA3LzAyLzM3LzM2/LzM2MF9GXzcwMjM3/MzY0N19HY2d5eGdw/RVlEaGI3N1lVQXNQ/cHNsZ1l1OEJtbWRH/YS5qcGc" alt="100% Authentic">
            <h3>100% Authentic</h3>
            <p>We guarantee genuine products—no fakes, no replicas, just the real deal.</p>
        </div>
        <div class="feature-box">
            <img src="https://imgs.search.brave.com/3JiO0tEML9yOF_nEhFMXhzQecSvFRRnN_RQIW8c_zQA/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly90My5m/dGNkbi5uZXQvanBn/LzExLzQwLzQzLzg2/LzM2MF9GXzExNDA0/Mzg2MjZfNUs1QXAx/NzQ5bHBNZGRVZ1Bp/OFJMYkZWYk56M0VI/M00uanBn" alt="Easy Returns">
            <h3>Easy Returns</h3>
            <p>Not the right fit? No problem. Enjoy hassle-free 14-day returns on all items.</p>
        </div>
        <div class="feature-box">
            <img src="https://imgs.search.brave.com/6CZHWLbSYMbSyNxl8oF7kydpkU-hfhinTdqNQ7qxNds/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvMTE2/MjMzNjM3NC92ZWN0/b3IvMjQtaG91cnMt/aWNvbi5qcGc_cz02/MTJ4NjEyJnc9MCZr/PTIwJmM9T0RWVmNM/MlhJcmJSam1JSzlk/ZkVmQmZGdHdFM2xs/STJSVTR1b0h3Tlg2/Yz0" alt="24/7 Support">
            <h3>24/7 Support</h3>
            <p>Our friendly team is available around the clock to help with anything you need.</p>
        </div>
    </div>
</section>

<section class="subscribe-section">
    <div class="subscribe-container">
        <div class="ad-section">
            <!-- You can use image ads or embed ad scripts here -->
            <img src="https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExdHhmczFidDRlZHcwbG4wcXlxcXM4enJ6b2pwc3ZsdXN2amtqbGN6ciZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/26FlruUbK9XSEQDoQ/giphy.gif" alt="Ad" class="ad-image">
        </div>
        <div class="subscribe-form-section">
            <h2>Subscribe to Our Newsletter</h2>
            <p>Get the latest updates on new arrivals and exclusive offers.</p>
            <form action="subscribe.php" method="post" class="subscribe-form">
                <input type="email" name="email" placeholder="Enter your email address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
</section>


    <script src="script.js"></script>
    <footer>
    <div class="footer-container">
        <div class="footer-logo">SwooshX</div>

        <div class="footer-links">
            <a href="home.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact</a>
        </div>
        <div class="footer-socials">
            <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="https://www.twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="https://www.youtube.com" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
        </div>
        <div class="footer-info">
            <p>&copy; <?php echo date("Y"); ?> SwooshX. All rights reserved.</p>
        </div>
    </div>
</footer>


</body>
</html>
