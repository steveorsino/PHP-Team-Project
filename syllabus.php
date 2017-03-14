<?php
  include('dbconnect.php');
  $SQL = 'SELECT * FROM Syllabus;';
  $syllabi = $db->query($SQL);
  
  $title = 'Syllabus';
  $message = '';
  include('header.php');
  echo "<h2>$title table</h2>";
?>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="term.php">Term Table</a></li>
    <li><a href="session.php">Session Table</a></li>
    <li><a href="course.php">Course Table</a></li>
    <li><a class="active" href="syllabus.php">Syllabus Table</a></li>
    <li><a href="units.php">Units Table</a></li>
    <li><a href="outcomes.php">Outcomes Table</a></li>
  </ul>
  <div class="container">
    <table>
      <tr>
        <th>CourseID</th>
        <th>Term ID</th>
        <th>Session ID</th>
        <!--<th>Update</th>-->
        <th>Delete</th>
      </tr>
      <?php foreach ($syllabi as $syllabus) { ?>
      <tr>
        <td><?php echo $syllabus['CourseID']; ?></td>
        <td><?php echo $syllabus['TermID']; ?></td>
        <td><?php echo $syllabus['SessionID']; ?></td>
        <!--<td><a href="update_item.php?table=Syllabus&CourseID=<?php echo $syllabus['CourseID']; ?>
        &TermID=<?php echo $syllabus['TermID']; ?>&SessionID=<?php echo $syllabus['SessionID']; ?>">Update</a></td>-->
        <?php 
        /*this block queries the db for references to this item.
          If any are found, the delete button is not displayed and an indication
          is made to the user that this item cannot be deleted.
        */
          $courseID = $syllabus['CourseID'];
          $termID = $syllabus['TermID'];
          $sessionID = $syllabus['SessionID'];
         
          $SQL = "SELECT CourseID, TermID, SessionID 
                  FROM Units
                  WHERE SessionID = '$sessionID'
                    AND TermID = '$termID'
                    AND CourseID = '$courseID';";
          $canDelete = $db->query($SQL);
          if ($canDelete->rowCount() == 0) {
        ?>
        <td><a href="delete_item.php?table=Syllabus&CourseID=<?php echo $syllabus['CourseID']; ?>
        &TermID=<?php echo $syllabus['TermID']; ?>&SessionID=<?php echo $syllabus['SessionID']; ?>">Delete</a></td>
        <?php } else { ?>
          <?php $message = '<h4>An item cannot be deleted if it is referenced in another table...</h4>'; ?>
          <td>Cannot Delete</td>
        <?php } ?>
      </tr>
      <?php } ?>
      <?php if (empty($syllabus['SessionID'])) {echo "<tr><td>Empty</td><td>Empty</td></tr>";} ?>
    </table>
    <?php if (empty($syllabus['SessionID'])) echo '<h4>No Syllabus to display</h4>'; ?>
    <form action="add_item.php" method="get">
      <input type="hidden" name="table" value="Syllabus" />
      <input type="submit" value="Add Syllabus" />
    </form>
    <?php echo $message; ?>
  </div>

<?php
  include('footer.php')
?>