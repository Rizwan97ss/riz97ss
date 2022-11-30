<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body{
        margin:0;
        padding: 0;
        background:  url("bg.jpg") no-repeat fixed center ;

    }
    #home{
        width: 500px;
        height: auto;
        text-align:left;
        margin: 7rem 7rem ;
        background-color: rgba(0,0,0,0.5);
        color: white;
        padding: 20px;
        border-top-left-radius: 30px;
        border-bottom-right-radius: 30px;
    }
    .bio{
        width: 270px;
        height: 270px;
        background: rgba(0,0,0,0.5);
        text-align: center;
        align-items: center;
        margin: auto;
        border-top-left-radius: 30px;
        border-bottom-right-radius: 30px;

    }
    #about{
        margin: 180px auto;
        max-width: 1200px;
        color: white;
        display: flex;
        flex-wrap:wrap;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#home">RIZWAN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Video</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Photo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signup.php">Login/SignUp</a>
        </li> 
      </ul>
    </div>
  </div>
</nav>
<div id="home">
    <h1>Meet to share ideas of potential and shall capitalize our today in better future.</h1>
    <h2>for meeting please login.</h2>
</div>
<div id="about">
    <div class="bio">
        <h1>Specialist of Automobiles that always move the world fast.</h1>
    </div>
    <div class="bio">
        <h1>Passionate about Mechanism of machines</h1>
    </div>
    <div class="bio">
        <h1>Childhood spent on IT now i am capitalizing it.</h1>
    </div>
    <div class="bio">
        <h1>Learnig from history of world wide so that do not repat that.</h1>
    </div>    
</div>
</body>
</html>


