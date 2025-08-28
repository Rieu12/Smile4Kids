<?php include('db_connect.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Smile4Kids - Home</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f2f9fc;
      color: #333;
    }

    /* HERO SECTION - Half Page */
    .hero {
      background: linear-gradient(to right, #0073e6, #00b4d8);
      color: white;
      text-align: center;
      height: 50vh; /* 👈 Makes it half the page */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .hero h1 {
      font-size: 4rem;    /* Increased */
      font-weight: bold;
      margin-bottom: 1.2rem;
    }

    .hero p {
      font-size: 1.6rem;
      margin-bottom: 2rem;
      max-width: 700px;
      line-height: 1.8;
    }

    .hero .btn {
      background: #ff6b6b;
      color: white;
      padding: 16px 30px;
      border-radius: 10px;
      font-size: 1.3rem;
      text-decoration: none;
      cursor: pointer;
      transition: background 0.3s;
    }

    .hero .btn:hover {
      background: #e63946;
    }

    /* NAV CARDS SECTION */
    .nav-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.5rem;
      padding: 3rem 2rem;
    }

    .card {
      background: white;
      padding: 2rem;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-decoration: none;
      color: #0073e6;
      font-weight: bold;
      font-size: 1.3rem;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      background: #f0f8ff;
    }

    /* ANIMATIONS */
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
      }
      .hero p {
        font-size: 1rem;
      }
    }
    /* ABOUT SECTION - BIGGER */
    .about-section {
      max-width: 1800px;  /* Wider */
      margin: 2rem auto;
      padding: 3rem;     /* Larger padding */
      background: white;
      border-radius: 8px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
      text-align: center;
      line-height: 2;    /* More space between lines */
    }

    .about-section h2 {
      color: #0073e6;
      margin-bottom: 1.5rem;
      font-size: 2.5rem; /* Larger heading */
    }

    .about-section p {
      font-size: 1.4rem; /* Bigger text */
      color: #444;
    }
  </style>
</head>
<body>

<section class="hero">
  <div class="hero-text">
    <h1>Welcome to Smile4Kids</h1>
    <p>Empowering and protecting children for a brighter tomorrow.</p>
    <a href="register.php" class="btn">Make a Donation</a>
  </div>
</section>

<section class="nav-cards">
  <a href="about_us.html" class="card">About Us</a>
  <a href="contact_us.html" class="card">Contact Us</a>
  <a href="register.php" class="card">Register to become a member</a>
  <a href="login.php" class="card">Login</a>
</section>

<section class="about-section">
  <h2>About Smile4Kids</h2>
  <p>
    Smile4Kids is a community-driven initiative focused on supporting vulnerable children
    through education, health, and welfare programs. We believe every child deserves a safe,
    nurturing environment and access to opportunities that empower them to reach their full potential.
  </p>
</section>

</body>
</html>


<?php include('includes/footer.php'); ?>
