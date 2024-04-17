<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TalentCrafters</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f6fc; /* Light blue background */
    color: #333; /* Dark text color */
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    box-sizing: border-box;
}

header {
    text-align: center;
    margin-bottom: 30px;
}

header h1 {
    color: #007bff; /* Blue header text color */
}

.description, .mission, .team {
    margin-bottom: 30px;
}

.team-members {
    display: flex;
    justify-content: center;
    gap: 30px;
}

.team-member {
    text-align: center;
    padding: 20px;
    background-color: #fff; /* White background for team member cards */
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle box shadow */
    border-radius: 8px;
}

.team-member img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
}

.team-member h3 > a{
    color: #007bff;
    decoration: none; 
}

.team-member p {
    color: #666; 
}

    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>About TalentCrafters</h1>
        </header>
        <section class="description">
            <p>Welcome to TalentCrafters, your ultimate destination for creating professional resumes and advancing your career.</p>
            <p>Our platform is designed to empower individuals by offering intuitive tools for resume building, job exploration, and career guidance.</p>
            <p>Whether you're a seasoned professional or just starting your career journey, TalentCrafters is here to support you every step of the way.</p>
        </section>
        <section class="mission">
            <h2>Our Mission</h2>
            <p>At TalentCrafters, our mission is to provide a seamless and innovative experience that enables users to craft compelling resumes, discover relevant job opportunities, and navigate their career paths with confidence.</p>
        </section>
        <section class="team">
            <h2>Meet Our Team</h2>
            <div class="team-members">
                <div class="team-member">
                    <img src="img/anmol.jpg" alt="Anmol Negi">
                    <h3><a href="https://github.com/anmolnegi31"> Anmol Negi </a> </h3>
                    <p>Frontend Developer</p>
                </div>
                <div class="team-member">
                    <img src="img/aayush.jpg" alt="Aayush Kukreja">
                    <h3><a href="https://github.com/Aayush6377">Aayush Kukreja</a></h3>
                    <p>Backend Developer</p>
                </div>
                <div class="team-member">
                    <img src="img/kartik.jpg" alt="Kartik Mendiratta">
                    <h3><a href="#">Kartik Mendiratta</a></h3>
                    <p>AI Integration Specialist</p>
                </div>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>
