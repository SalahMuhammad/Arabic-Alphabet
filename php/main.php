<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/php/main.css">
  <title>Settings</title>
</head>
<body>

  <a href="../index.html">Back</a>
  <a href="main.php">Refresh</a>

  <?php
  if ( !isset( $_POST ["letter"] ) ) { ?>
    <form action="main.php" method="post">
      <input type="text" name="letter">
      <button type="submit">Select</button>
    </form>
  <?php } ?>

  <?php 
  if ( isset( $_POST ["letter"] ) ) {
    require_once 'Json.class.php';
    $json         = new Json();
    $letter       = $_POST ["letter"];
    $data         = $json -> getSinle( $letter );

    if ( !empty( $data ) ) { ?>
      <form action="action.php" method="post">
        <h3>Front Face</h3>
        <?php
        foreach ( $data ["front"] as $key => $value ) { ?>
          <input type="text" name="front-<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php } ?>

        <h3>Back Face</h3>
        <?php
        foreach ( $data ["back"] as $key => $value ) { ?>
          <input type="text" name="back-<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php } ?>

        <input type="hidden" name="letter" value="<?php echo $letter; ?>">
        <br>
        <button type="submit" name="submit">Save</button>
      </form>
    <?php
    } else { ?>
      <div class="error">
        <span>Wrong Letter</span> 
      </div>
    <?php }
  } ?>
</body>
</html>