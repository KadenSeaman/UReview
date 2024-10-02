<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Review</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="icon" href="favicon.ico?" type="image/x-icon">
</head>
<body>
    <div class="l-r-container">
        <div class="left-container">
            <h6>welcome!</h6>
            <p>enter your username, email, name and password to create an account</p>
        </div>
        <div class="right-container">
    
            <form id="vertical-form" action="/phpViews/dashboard.php">
                <h1 class="title">sign up</h1>
                <input required class="input-outline" type="text" name="username" id="username" placeholder="username">
                <input required class="input-outline" type="email" name="email" id="email" placeholder="email">
                <input required class="input-outline" type="text" name="name" id="name" placeholder="name">
                <input required class="input-outline" type="password" name="password" id="password" placeholder="password">
                <button class="button-outline"type="submit">sign up</button>
            </form>
    
            <a id="bottom-hyperlink" href="login.php">returning user? login instead</a>
        </div>
    </div>
</body>
</html>