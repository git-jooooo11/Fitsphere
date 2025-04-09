<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PowerFit - Premium Gym Equipment</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
        }
        
        header {
            background-color: #1a1a1a;
            color: white;
            padding: 20px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #ff6b00;
        }
        
        .auth-buttons {
            display: flex;
            gap: 15px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-login {
            background-color: transparent;
            color: white;
            border: 2px solid #ff6b00;
        }
        
        .btn-login:hover {
            background-color: #ff6b00;
        }
        
        .btn-register {
            background-color: #ff6b00;
            color: white;
            border: 2px solid #ff6b00;
        }
        
        .btn-register:hover {
            background-color: #e05d00;
            border-color: #e05d00;
        }
        
        .hero {
            height: 100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            margin-top: 68px;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }
        
        .btn-hero {
            background-color: #ff6b00;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-hero:hover {
            background-color: #e05d00;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .features {
            padding: 80px 0;
            background-color: white;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            font-size: 36px;
            color: #1a1a1a;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .feature-card {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 50px;
            color: #ff6b00;
            margin-bottom: 20px;
        }
        
        .feature-card h3 {
            margin-bottom: 15px;
            font-size: 24px;
        }
        
        footer {
            background-color: #1a1a1a;
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .footer-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: #ff6b00;
        }
        
        .copyright {
            color: #777;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <div class="header-content">
            <div class="logo">FitSphere</div>
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn btn-register">Register</a>
            </div>
        </div>
    </div>
</header>
    
    <section class="hero">
        <div class="hero-content">
            <h1>Build Your Dream Home Gym</h1>
            <p>Premium quality gym equipment with free shipping and lifetime warranty on all products.</p>
            <button class="btn-hero">Shop Now</button>
        </div>
    </section>
    
    <section class="features">
        <div class="container">
            <h2 class="section-title">Why Choose FitSphere</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🏋️</div>
                    <h3>Professional Quality</h3>
                    <p>Equipment designed for both home and commercial use with durable materials.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🚚</div>
                    <h3>Free Shipping</h3>
                    <p>Free delivery on all orders over $50 with fast and reliable shipping.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🛡️</div>
                    <h3>Lifetime Warranty</h3>
                    <p>All our products come with a lifetime warranty against manufacturing defects.</p>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <div class="footer-links">
                <a href="#">About Us</a>
                <a href="#">Products</a>
                <a href="#">Contact</a>
                <a href="#">FAQ</a>
                <a href="#">Terms of Service</a>
            </div>
            <p class="copyright">© 2023 PowerFit. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>