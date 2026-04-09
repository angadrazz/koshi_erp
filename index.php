<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $SITE_NAME; ?> | Ultra Premium ERP</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- AOS Animation -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container">
    <a class="navbar-brand" target="_blank" href="https://angadrazz.github.io/Koshi-Institute-of-Higher-Education/">
      <i class="fa-solid fa-graduation-cap"></i> KOSHI INSTITUTE
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#courses">Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

        <li class="nav-item">
          <a class="btn btn-warning ms-2 fw-bold" href="./franchise/register.php">
            Apply Franchise
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- NOTICE BAR -->
<div class="notice-bar">
  <div class="container d-flex align-items-center">

    <span class="notice-label">
      <i class="fa-solid fa-bullhorn"></i> NOTICE
    </span>

    <marquee behavior="scroll" direction="left" scrollamount="6" class="notice-text">
      🎓 Admission Open 2026 | 💻 New Computer Courses Launched | 📜 Certificate Verification Available Online | 🤝 Franchise Apply Now | 📢 Limited Seats – Apply Today! | if you have any queries, feel free to call 📞 9122552662 | 9431496862 
    </marquee>

  </div>
</div>

<!-- HERO -->
<section class="hero text-center">
  <div class="container">
    <span class="badge-premium">Ultra Premium Education ERP</span>

    <h1 class="mt-3" data-aos="fade-up">
      Koshi Institute of Higher Education
    </h1>

    <p class="mt-3" data-aos="fade-up" data-aos-delay="200">
      Online Admission | Certificate Verification | Franchise System | ERP Dashboard
    </p>

    <div class="mt-4" data-aos="zoom-in" data-aos-delay="400">
      <a href="online admission/admission.php" class="btn btn-premium me-2">
        <i class="fa-solid fa-pen-to-square"></i> Online Admission
      </a>

      <a href="verify.php" class="btn btn-light fw-bold">
        <i class="fa-solid fa-qrcode"></i> Verify Certificate
      </a>
    </div>
  </div>
</section>

<!-- QUICK BUTTONS -->
<section class="py-5">
  <div class="container">
    <div class="row g-4 text-center">

      <div class="col-md-3" data-aos="fade-up">
        <div class="card card-premium p-4">
          <i class="fa-solid fa-user-graduate fa-2x text-primary"></i>
          <h5 class="mt-3 fw-bold">Student Login</h5>
          <a href="student/login.php" class="btn btn-primary mt-2">Login</a>
        </div>
      </div>

      <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
        <div class="card card-premium p-4">
          <i class="fa-solid fa-building fa-2x text-success"></i>
          <h5 class="mt-3 fw-bold">Franchise Login</h5>
          <a href="franchise/login.php" class="btn btn-success mt-2">Login</a>
        </div>
      </div>

      <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
        <div class="card card-premium p-4">
          <i class="fa-solid fa-university fa-2x text-warning"></i>
          <h5 class="mt-3 fw-bold">University Login</h5>
          <a href="university/login.php" class="btn btn-warning mt-2">Login</a>
        </div>
      </div>

      <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
        <div class="card card-premium p-4">
          <i class="fa-solid fa-user-shield fa-2x text-danger"></i>
          <h5 class="mt-3 fw-bold">Admin Login</h5>
          <a href="./admin/login.php" class="btn btn-danger mt-2">Login</a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- COURSES -->
<section id="courses" class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title text-center" data-aos="fade-up">Our Courses</h2>
    <p class="text-center text-muted" data-aos="fade-up" data-aos-delay="100">
      Computer, Vocational & Degree Programs with Certification
    </p>

    <div class="row g-4 mt-4">

      <div class="col-md-4" data-aos="zoom-in">
        <div class="card card-premium p-4">
          <h4 class="fw-bold">Computer Courses</h4>
          <p class="text-muted">ADCA, DCA, Tally, CCC, Programming</p>
          <a href="../course/course_page.php" class="btn btn-primary">Explore</a>
        </div>
      </div>

      <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
        <div class="card card-premium p-4">
          <h4 class="fw-bold">Vocational Courses</h4>
          <p class="text-muted">Skill Development, Training Programs</p>
          <a href="../course.php" class="btn btn-success">Explore</a>
        </div>
      </div>

      <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
        <div class="card card-premium p-4">
          <h4 class="fw-bold">Degree Programs</h4>
          <p class="text-muted">B.Ed, D.El.Ed, BA, BBA, MBA</p>
          <a href="course_page.php?cat=Degree" class="btn btn-warning fw-bold">Explore</a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- GALLERY -->
<section id="gallery" class="py-5">
  <div class="container">
    <h2 class="section-title text-center" data-aos="fade-up">Gallery</h2>
    <p class="text-center text-muted" data-aos="fade-up" data-aos-delay="100">
      Our Events, Classes & Campus Activities
    </p>

    <div class="row g-3 mt-4">
      <div class="col-md-3" data-aos="zoom-in"><img src="assets/images/g1.jpg" class="img-fluid rounded-4 shadow"></div>
      <div class="col-md-3" data-aos="zoom-in"><img src="assets/images/g2.jpg" class="img-fluid rounded-4 shadow"></div>
      <div class="col-md-3" data-aos="zoom-in"><img src="assets/images/g3.jpg" class="img-fluid rounded-4 shadow"></div>
      <div class="col-md-3" data-aos="zoom-in"><img src="assets/images/g4.jpg" class="img-fluid rounded-4 shadow"></div>
      <div class="col-md-3" data-aos="zoom-in"><img src="assets/images/g5.jpg" class="img-fluid rounded-4 shadow"></div>
      <div class="col-md-3" data-aos="zoom-in"><img src="assets/images/g6.jpg" class="img-fluid rounded-4 shadow"></div>
      <div class="col-md-3" data-aos="zoom-in"><img src="assets/images/g7.jpg" class="img-fluid rounded-4 shadow"></div>
      <div class="col-md-3" data-aos="zoom-in"><img src="assets/images/g8.jpg" class="img-fluid rounded-4 shadow"></div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section id="testimonials" class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title text-center" data-aos="fade-up">Testimonials</h2>

    <div class="row g-4 mt-4">
      <div class="col-md-4" data-aos="fade-up">
        <div class="card card-premium p-4">
          <p>"Best institute for computer courses. Very professional staff."</p>
          <h6 class="fw-bold mt-3">⭐ Rahul Kumar</h6>
        </div>
      </div>

      <div class="col-md-4" data-aos="fade-up" data-aos-delay="150">
        <div class="card card-premium p-4">
          <p>"Online certificate verification system is excellent. Trusted."</p>
          <h6 class="fw-bold mt-3">⭐ Priya Singh</h6>
        </div>
      </div>

      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card card-premium p-4">
          <p>"Franchise support and student portal is very premium."</p>
          <h6 class="fw-bold mt-3">⭐ Amit Verma</h6>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT + MAP -->
<section id="contact" class="py-5">
  <div class="container">
    <h2 class="section-title text-center" data-aos="fade-up">Contact & Admission Enquiry</h2>

    <div class="row g-4 mt-4">
      
      <div class="col-md-6" data-aos="fade-right">
        <div class="card card-premium p-4">
          <h5 class="fw-bold">Send Enquiry</h5>

          <form action="enquiry_save.php" method="POST">
            <input class="form-control mt-2" type="text" name="name" placeholder="Your Name" required>
            <input class="form-control mt-2" type="text" name="mobile" placeholder="Mobile Number" required>
            <input class="form-control mt-2" type="email" name="email" placeholder="Email (optional)">
            <input class="form-control mt-2" type="text" name="course_interest" placeholder="Course Interested">
            <textarea class="form-control mt-2" name="message" placeholder="Message"></textarea>

            <button class="btn btn-primary mt-3 w-100 fw-bold">Submit Enquiry</button>
          </form>

        </div>
      </div>

      <div class="col-md-6" data-aos="fade-left">
        <div class="card card-premium p-3">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.086105798203!2d85.0!3d25.6"
            width="100%" height="350" style="border:0;border-radius:18px;" allowfullscreen="" loading="lazy">
          </iframe>
        </div>
      </div>

    </div>

    <div class="text-center mt-4">
  <a class="btn btn-success fw-bold" target="_blank" href="https://wa.me/919122552662">
    <i class="fa-brands fa-whatsapp"></i> WhatsApp Admission Help
  </a>

  <p class="mt-2 fw-bold">
   if you have any queries, feel free to call 📞 9122552662 | 9431496862
  </p>
</div>

  </div>
</section>

<!-- FOOTER -->
<footer class="footer text-center">
  <div class="container">
    <h5 class="fw-bold">Koshi Institute of Higher Education</h5>
    <p class="mb-1">(A Unit of Koshi Shiksha Private Limited)</p>
    <p class="small">
      An ISO 9001:2015 Certified Institute | MSME Registered Organization | Registered under Companies Act 2013 (MCA)
    </p>

    <p class="mt-3">
      © <?php echo date("Y"); ?> Koshi Institute. All Rights Reserved.
    </p>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({duration:1000});
</script>

</body>
</html>
