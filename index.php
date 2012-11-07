<?php

/**
 * @file
 * Markdown processing script
 * 
 * Convert any text into HTML with markdown.
 *
 * This script is NOT SECURE.
 * It should be used only locally and as a tool for content writers.
 *
 * Created by: Topsitemakers
 * http://www.topsitemakers.com/
 */

require 'markdown.php';

if ($_POST) {
  $output = Markdown($_POST['input']);
  // Filter out common problematic characters that are usually copied from Word
  // and other rich text editors. If necessary, these can be returned back with
  // something like Smarty pants
  $output = strtr($output, array(
    '„' => '"',
    '“' => '"',
    '”' => '"',
    '–' => '-',
    '‘' => "'",
    '’' => "'",
  ));
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Markdown processor</title>
<style type="text/css">
body {
  padding: 0;
  margin: 0;
}
.row {
  float: left;
  width: 98%;
  margin: 0 1%;
}
textarea {
  font-family: monospace;
  font-size: 14px;
  width: 98%;
  padding: 1%;
  margin: 1% 0 0 0;
  min-height: 250px;
}
textarea,
textarea[disabled=disabled] {
  background: #FFF;
}
input[type=submit] {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 30px;
  cursor: pointer;
}
</style>
</head>
<body>

<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
  
  <div class="row">
    <?php if ($_POST): ?>
    <textarea id="input" name="input"><?php print $_POST['input']; ?></textarea>
    <?php else: ?>
    <textarea id="input" name="input"></textarea>
    <?php endif; ?>
  </div>
  
  <div class="row" style="text-align: center;">
    <input type="submit" value="Convert">
  </div>

  <div class="row">
    <?php if ($_POST): ?>
    <textarea id="output" name="output" disabled="disabled"><?php print $output; ?></textarea>
    <?php endif; ?>
  </div>

</form>

</body>
</html>
