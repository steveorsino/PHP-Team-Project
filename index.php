<?php
  include('dbconnect.php');
  $title = 'Main Menu';
  include('header.php');
  echo "<h2>$title</h2>";
?>
  <ul>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a href="term.php">Term Table</a></li>
    <li><a href="session.php">Session Table</a></li>
    <li><a href="course.php">Course Table</a></li>
    <li><a href="syllabus.php">Syllabus Table</a></li>
    <li><a href="units.php">Units Table</a></li>
    <li><a href="outcomes.php">Outcomes Table</a></li>
  </ul>
  <a href="report.php">Go to report page</a>
<?php
  include('footer.php')
?>