<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Docker PHP Hello World</title>
  </head>
  <body>
    <?php
      try {
        $bdd = new PDO('mysql:host=db;port=3306;dbname=lolmysql;charset=utf8', 'myuser', 'mypassword');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $bdd->query("CREATE TABLE IF NOT EXISTS lol (
          id        INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          firstname VARCHAR(30)     NOT NULL,
          seen      INT(6) UNSIGNED
          )");
      } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
      }
    ?>

    <? if ($_POST['who'] != '') {?>

      <h1>Hello <? echo htmlspecialchars($_POST['who']); ?></h1>
      <a href="index.php">Greet someone else</a>
      <?php
        try {
          $reponse = $bdd->query("SELECT firstname FROM lol WHERE firstname=" . $bdd->quote($_POST['who']));

          if ($reponse->rowCount() > 0) {
            $bdd->query("UPDATE lol SET seen = seen + 1 WHERE firstname=" . $bdd->quote($_POST['who']));
          } else {
            $bdd->query("INSERT INTO lol (firstname, seen) VALUES (" . $bdd->quote($_POST['who']) . ", 1)");
          }
        } catch (Exception $e) {
          die('Error : ' . $e->getMessage());
        }
      ?>

    <? } else { ?>
      <form class="greetingForm" action="index.php" method="post">
        <label for="who">Say hello to</label>
        <input type="text" name="who">
        <input type="submit" name="greet" value="Say Hello">
      </form>
    <? } ?>

    <p>Already greeted:</p>
    <ul>
    <?php
      try {
        $reponse = $bdd->query('SELECT * FROM lol');

        while ($donnees = $reponse->fetch()) {
          ?>
            <li><?php echo htmlspecialchars($donnees['firstname']); ?>: <?php echo $donnees['seen']; ?> times</li>
          <?php
        }
        $reponse->closeCursor();
      } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
      }
    ?>
    </ul>
  </body>
</html>
