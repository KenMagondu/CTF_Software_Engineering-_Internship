
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Scoring System</title>
    <style>
        nav {
            background-color: #333;
            overflow: hidden;
            margin-bottom: 20px;
        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        nav a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/event_scoreboard/judge/" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/judge/') !== false) ? 'active' : ''; ?>">Judge Portal</a>
        <a href="/event_scoreboard/scoreboard/" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/scoreboard/') !== false) ? 'active' : ''; ?>">Scoreboard</a>
    </nav>