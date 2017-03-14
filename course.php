<?php
  include('dbconnect.php');
  $SQL = 'SELECT * FROM Course;';
  $courses = $db->query($SQL);//
  
  $title = 'Course';
  $message = '';
  include('header.php');
  echo "<h2>$title table</h2>";
?>

  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="term.php">Term Table</a></li>
    <li><a href="session.php">Session Table</a></li>
    <li><a class="active" href="course.php">Course Table</a></li>
    <li><a href="syllabus.php">Syllabus Table</a></li>
    <li><a href="units.php">Units Table</a></li>
    <li><a href="outcomes.php">Outcomes Table</a></li>
  </ul>
  
  <div class="container">
    <table>
      <tr>
        <th>Course ID</th>
        <th>Title</th>
        <th>Course Description</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
      <?php foreach ($courses as $course) { ?>
      <tr>
        <td><?php echo $course['CourseID']; ?></td>
        <td><?php echo $course['CourseTitle']; ?></td>
        <td><?php echo $course['CourseDescription']; ?></td>
        <td><a href="update_item.php?table=Course&CourseID=<?php echo $course['CourseID']; ?>
        &CourseTitle=<?php echo $course['CourseTitle']; ?>&CourseDescription=<?php echo $course['CourseDescription']; ?>">Update</a></td>
        <?php 
        /*this block queries the db for references to this item.
          If any are found, the delete button is not displayed and an indication
          is made to the user that this item cannot be deleted.
        */
          $courseID = $course['CourseID'];
          $SQL = "SELECT CourseID from Syllabus
                  WHERE CourseID = '$courseID';";
          $canDelete = $db->query($SQL);
          if ($canDelete->rowCount() == 0) {
        ?>
        <td><a href="delete_item.php?table=Course&CourseID=<?php echo $course['CourseID']; ?>
        &CourseTitle=<?php echo $course['CourseTitle']; ?>&CourseDescription=<?php echo $course['CourseDescription']; ?>">Delete</a></td>
        <?php } else { ?>
          <?php $message = '<h4>An item cannot be deleted if it is referenced in another table...</h4>'; ?>
          <td>Cannot Delete</td>
        <?php } ?>
      </tr>
      <?php } ?>
      <?php if (empty($course['CourseID'])) {echo "<tr><td>Empty</td><td>Empty</td><td>Empty</td></tr>";} ?>
    </table>
    <?php if (empty($course['CourseID'])) echo '<h4>No Course to display</h4>'; ?>
    <form action="add_item.php" method="get">
      <input type="hidden" name="table" value="Course" />
      <input type="submit" value="Add Course" />
    </form>
    <?php echo $message; ?>
  </div>

<?php
  include('footer.php')
?>