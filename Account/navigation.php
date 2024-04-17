<?php
if (!isset($_SESSION)){
    session_start();
}

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters'; 

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if(isset($_SESSION['user_id'])) {
    $sql = "SELECT username FROM users where user_id = ".$_SESSION["user_id"];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $username = $user['username'];
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <style>
.navbar-links {
    display: flex;
    align-items: center;
}

.navbar-links a {
    color: #007bff; 
    text-decoration: none;
    margin-right: 20px;
    padding: 10px;
    transition: color 0.3s ease; 
}

.navbar-links a:hover {
    color: #0056b3; 
}

.dropdown {
    position: relative;
}


.dropbtn {
    background-color: transparent;
    border: none;
    color: #007bff; 
    font-size: 16px;
    cursor: pointer;
    padding: 10px;
    transition: color 0.3s ease; 
}


.dropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff; 
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: #333; 
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s ease; 
}

.dropdown-content a:hover {
    background-color: #f0f0f0;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    color: #0056b3; 
}
#searchForm {
            position: relative;
            display: flex;
            align-items: center;
        }
        #searchInput {
            width: 300px;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #searchResults {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 100;
            width: 300px;
            max-height: 200px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 4px 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: none;
        }
        #searchResults ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        #searchResults li {
            padding: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #searchResults li:hover {
            background-color: #f0f0f0;
        }

    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">TalentCrafters</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../template.php">Template</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../ChatBot/bot.php">Chat Bot</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Job Suggest
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../Job_suggestion/career_roadmap.php">Road map</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../Job_suggestion/jobs.php">Jobs available</a></li>
                    </ul>
                </li>
            </ul>
            <form id="searchForm" class="d-flex">
                <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <div id="searchResults"></div>
            </form>
            
            <?php
            if(isset($_SESSION['user_id'])) {
                echo '<div class="username">';
                echo '<div class="navbar-links">
                        <div class="dropdown">
                            <button class="dropbtn">'. $username. '</button>
                            <div class="dropdown-content">
                                <a href="view_profile.php?user_id='.$_SESSION["user_id"].'">View Profile</a>
                                <a href="edit_profile.php?user_id='.$_SESSION["user_id"].'">Edit Profile</a>
                                <a href="logout.php">Logout</a>
                                <a href="delete.php?user_id='.$_SESSION["user_id"].'">Delete Account</a>
                            </div>
                        </div>
                    </div>
            ';
                echo '</div>';
                echo '<a href="logout.php" class="btn btn-danger">Logout</a>';
            } else {
                echo '<div class="signup-btn">';
                echo '<a href="signup.html" class="signup-btn">Signup</a>';
                echo '<a href="login.html" class="signup-btn">Login</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.querySelector('.dropbtn');
    const dropdownContent = document.querySelector('.dropdown-content');

    dropdownButton.addEventListener('click', function() {
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function(event) {
        if (!dropdownButton.contains(event.target) && !dropdownContent.contains(event.target)) {
            dropdownContent.style.display = 'none';
        }
    });
});
</script>
<script>
        const searchTerms = [
            { term: 'Templates', url: '../template.php' },
            { term: 'Resumes', url: '../template.php' },
            { term: 'Chat bot', url: '../ChatBot/bot.php' },
            { term: 'PDF upload', url: '../pdftotext/upload.html' },
            { term: 'Road map', url: '../Job_suggestion/career_roadmap.php' },
            { term: 'Jobs available', url: '../Job_suggestion/jobs.php' },
            { term: 'Classic', url: '../template.php' },
            { term: 'Professional', url: '../template.php' },
            { term: 'Creative', url: '../template.php' }
        ];

        const searchInput = document.getElementById('searchInput');
        const searchResultsContainer = document.getElementById('searchResults');

        let timeoutId;

        function handleSearch() {
            const searchTerm = searchInput.value.trim().toLowerCase();
            clearTimeout(timeoutId);

            timeoutId = setTimeout(() => {
                const searchResults = searchTerms.filter(item =>
                    item.term.toLowerCase().includes(searchTerm)
                );

                displaySearchResults(searchResults);
            }, 300); 
        }

        function displaySearchResults(results) {
            const ul = document.createElement('ul');
            ul.innerHTML = '';

            if (results.length === 0) {
                searchResultsContainer.style.display = 'none';
            } else {
                results.forEach(item => {
                    const li = document.createElement('li');
                    li.textContent = item.term;
                    li.addEventListener('click', function() {
                        window.location.href = item.url;
                    });
                    ul.appendChild(li);
                });
                searchResultsContainer.innerHTML = '';
                searchResultsContainer.appendChild(ul);
                searchResultsContainer.style.display = 'block';
            }
        }

        searchInput.addEventListener('input', handleSearch);
        document.addEventListener('click', function(event) {
            if (!searchResultsContainer.contains(event.target) && event.target !== searchInput) {
                searchResultsContainer.style.display = 'none';
            }
        });
    </script>
