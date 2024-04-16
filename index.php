<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>TalentCrafters</title>
</head>

<body>

<?php
include "Navigation.php";

$start = "details.php";
$show = "Start Creating";

if (isset($_SESSION['user_id'])){
    $start = "template.php";
    $show = "Select template";
}
?>

    <section id="head" class="head py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="image">
                        <img src="img/banner2.png" class="img-fluid" alt="" title="" loading="lazy">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="heading">
                        <h1>Crafters</h1>
                    </div>
                    <div class="heading-one">
                        <p class="systems">Our Perfect resume builder takes the hassle out of resume writing. Choose
                            from several
                            templates and follow easy prompts to create the perfect job-ready resume.

                        </p>
                        <a href="<?php echo $start;?>" class="btn btn-primary"><?php echo $show;?></a>
                        <a href="contactus.php" class="btn btn-primary">Contact-Us</a>

                    </div>
                </div>
            </div>
        </div>
    </section>





    <section id="main" class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="number">
                    </div>
                    <div class="row">
                        <p class="systems">This platform serves as a comprehensive overview of TalentCrafters's skills, experiences, and accomplishments in the field of your profession.
                            With a steadfast dedication to excellence and a commitment to continuous growth, TalentCrafters endeavors to deliver outstanding results in all endeavors.

                            This website offers a window into TalentCrafters's professional journey, featuring notable projects, achievements, and capabilities. 
                            Whether you're an employer seeking top-tier talent or a fellow professional exploring potential collaborations,
                            we invite you to explore this portfolio and discover the value TalentCrafters brings to the table.
                            
                            Thank you for visiting, and we look forward to the opportunity to connect and collaborate with you.
                            
                            </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="img/business-team-office_23-2147807977.jpg" class="img-fluid" alt="" title=""
                        loading="lazy">
                </div>
                <div class="col-md-4">
                    <div class="number">
                    </div>
                    <div class="row">
                        <p class="systems">Driven by a passion for innovation and a relentless pursuit of excellence, TalentCrafters is committed to pushing the boundaries of your profession. 
                            TalentCrafters thrives in dynamic environments where creativity and strategic thinking are valued. Beyond professional achievements, TalentCrafters is also dedicated to community engagement and lifelong learning, actively seeking opportunities to give back and stay abreast of emerging trends and technologies.
                            Click below to delve deeper into TalentCrafters's portfolio.</p>
                        <a href="aboutus.php" class="btn btn-dark text-light">About us</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="tutorial" class="tutorial-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="tutorial-info">
                        <h2 class="main-heading">About Our Tutorial</h2>
                        <p class="systems">Learn how to use TalentCrafters effectively with our detailed tutorial video. This video provides a step-by-step guide on creating professional resumes, exploring job suggestions, and utilizing our AI integration for career advancement.</p>
                        <p class="systems">Whether you're a student looking to enhance your resume or a professional seeking new career opportunities, our tutorial covers essential features and tips to make the most out of TalentCrafters.</p>
                        <p class="systems">Watch the video to discover how TalentCrafters can empower you in your career journey.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tutorial-video">
                        <video width="100%" controls>
                            <source src="img/tutorial.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="third" class="third py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-heading">
                        We Deliver The Best

                    </div>
                    <ul class="stye">
                        <li class="provw">Proven CV Templates to increase Hiring Channce.
                        </li>
                        <li class="provw">Creative and Clean Templates Design.</li>
                        <li class="provw">Easy and Intuitive Online CV Builder.</li>
                        <li class="provw">Free to use. Developed by hiring professionals.</li>
                        <li class="provw">Fast Easy CV and Resume Formatting.
                        </li>
                        <li class="provw">Recruiter Approved Phrases.</li>
                    </ul>
                    <a href="contactus.php"  class="btn btn-outline-success btn-primary text-light d-flex justify-content-center">Contact-Us</a>
                    <a href="template.php"  class="btn btn-outline-success btn-primary text-light d-flex justify-content-center">Review Templates</a>  
                </div>
                <div class="col-md-6">
                    <img src="img/cv.png" class="img-fluid" alt="" title="" loading="lazy">
                </div>
            </div>
        </div>
    </section>





    <section id="cta" class="cta py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img src="img/custom.png" class="img-fluid size" alt="" title="" loading="lazy">
                </div>
                <div class="col-md-6">
                    <div class="main-heading">
                        Already have an resume? <br>Upload to fetch details

                    </div>

                </div>
                <div class="col-md-3">
                    <a href="pdftotext/upload.html" class="btn btn-primary text-light">Upload pdf</a>
                </div>
            </div>
        </div>
    </section>


    <section id="cta2" class="cta2 py-5">
        <div class="container">
            <div class="row">
                <div class="main-heading">
                    Our Creative Templates
                    <p class="text-center systems mt-3">Our creative templates are meticulously crafted to empower individuals and businesses alike to make a lasting impression in today's competitive landscape. Designed with innovation and versatility in mind, our templates offer a myriad of possibilities for expressing unique brand identities and captivating audiences across various platforms..</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img src="img/resume-application-employment-form-concept_53876-132184.jpg" class="img-fluid sixe" alt=""
                        title="" loading="lazy">
                    <a href="#" class="btn btn-primary text-light">Demo</a>
                    <a href="#" class="btn btn-primary btn-outline-success text-light">Download</a>
                </div>
                <div class="col-md-4">
                    <img src="img/resume-apply-work-form-concept_53876-139722.jpg" class="img-fluid sixe" alt="" title=""
                        loading="lazy">
                    <a href="#" class="btn btn-primary text-light">Demo</a>
                    <a href="#" class="btn btn-primary btn-outline-success text-light">Download</a>
                </div>
                <div class="col-md-4">
                    <img src="img/businessman-resume_1421-79.jpg" class="img-fluid sixe" alt="" title="" loading="lazy">
                    <a href="#" class="btn btn-primary text-light">Demo</a>
                    <a href="#" class="btn btn-primary btn-outline-success text-light">Download</a>
                </div>
            </div>
        </div>
    </section>




    <section id="fourth" class="fourth py-5">
        <div class="container">
            <h2 class="main-heading">Our Main Feature</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="system">
                        <img src="img/f1.png" class="img-fluid" alt="" title="" loading="lazy">
                        <h3 class="proff">Resume Builder</h3>
                        <p class="proffs">Allow users to create professional resumes by entering their personal details, work experience, education, skills, and other relevant information. Provide multiple templates for users to choose from, allowing them to customize the design and layout of their resumes easily.</p>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="system">
                        <img src="img/f2.png" class="img-fluid" alt="" title="" loading="lazy">
                        <h3 class="proff">Guest Resume Creation</h3>
                        <p class="proffs">Enable users to create resumes without requiring them to create an account. This feature provides a quick and convenient way for users to generate resumes on-the-fly, ideal for one-time users or those who prefer not to register.</p>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="system">
                        <img src="img/f3.png" class="img-fluid" alt="" title="" loading="lazy">
                        <h3 class="proff"> User Accounts</h3>
                        <p class="proffs">Encourage users to create accounts for a more personalized experience. Registered users can save their resumes, templates, and preferences securely, making it easier for them to edit and update their resumes in the future. User accounts also facilitate features like resume versioning and profile management.</p>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="system">
                        <img src="img/f4.png" class="img-fluid" alt="" title="" loading="lazy">
                        <h3 class="proff"> Resume Upload & Parsing</h3>
                        <p   class="proffs">Allow users to upload existing resumes in PDF format to automatically populate their profile details. Implement resume parsing technology to extract relevant information such as work history, education, skills, and contact details, saving users time during the resume creation process.</p>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="system">
                        <img src="img/f5.png" class="img-fluid" alt="" title="" loading="lazy">
                        <h3 class="proff">Chatbot Assistance</h3>
                        <p class="proffs">Incorporate a chatbot feature that provides real-time assistance and answers common questions related to resume building, job searching, and career advice. The chatbot can guide users through the resume creation process, offer tips on optimizing resumes, and provide information about job opportunities.</p>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="system">
                        <img src="img/f6.png" class="img-fluid" alt="" title="" loading="lazy">
                        <h3 class="proff">Career Roadmap & Job Suggestions</h3>
                        <p class="proffs">Offer personalized career guidance by generating a roadmap based on a user's skills, experience, and career goals. Recommend job opportunities and potential employers aligned with the user's field of interest, leveraging data analytics and machine learning to provide relevant job suggestions.</p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <footer class="text-center text-lg-start bg-body-tertiary text-muted">
       
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class=" d-none d-lg-block main-heading">
                <span>Get connected with us on social networks:</span>
            </div>
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
         
        </section>
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3"></i> Faridabad, India</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            talentcrafters2024@gmail.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> + 91 637 726 6748</p>
                        <p><i class="fas fa-print me-3"></i> + 91 813 044 8958</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-reset fw-bold" href="index.php">TalentCrafters</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>