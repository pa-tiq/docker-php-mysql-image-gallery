<?php
function pdo_connect_mysql() {
    // The below variables should reflect your MySQL credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'tutorial';
    $DATABASE_PASS = 'secret';
    $DATABASE_NAME = 'tutorial';
    try {
        // Connect to MySQL using the PDO extension
    	return new PDO('mysql:dbname=tutorial;host=mysql', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and output the error.
    	exit('Failed to connect to database!');
    }
}

function template_header($title) {
  echo <<<EOT
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>$title</title>
      <link href="style.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
      <nav class="navtop">
        <div>
          <h1>Galeria</h1>
              <a href="index.php"><i class="fas fa-image"></i>Galeria</a>
        </div>
      </nav>
  EOT;
  }

function template_footer() {
  echo <<<EOT
      </body>
  </html>
  EOT;
  }
?>