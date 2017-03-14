<?php
  include('dbconnect.php');
  $SQL = 'SELECT * FROM Units;';
  $units = $db->query($SQL);
  
  $title = 'Units';
  $message = '';
  include('header.php');
  echo "<h2>$title table</h2>";
?>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="term.php">Term Table</a></li>
    <li><a href="session.php">Session Table</a></li>
    <li><a href="course.php">Course Table</a></li>
    <li><a href="syllabus.php">Syllabus Table</a></li>
    <li><a class="active" href="units.php">Units Table</a></li>
    <li><a href="outcomes.php">Outcomes Table</a></li>
  </ul>
  <div class="container">
    <table>
      <tr>
        <th>CourseID</th>
        <th>Term ID</th>
        <th>Session ID</th>
        <th>Unit ID</th>
        <th>Unit Title</th>
        <th>General Outcome</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
      <?php foreach ($units as $unit) { ?>
      <tr>
        <td><?php echo $unit['CourseID']; ?></td>
        <td><?php echo $unit['TermID']; ?></td>
        <td><?php echo $unit['SessionID']; ?></td>
        <td><?php echo $unit['UnitID']; ?></td>
        <td><?php echo $unit['UnitTitle']; ?></td>
        <td><?php echo $unit['GeneralOutcome']; ?></td>
        <td><a href="update_item.php?table=Units&CourseID=<?php echo $unit['CourseID']; ?>&TermID=<?php echo $unit['TermID']; ?>
        &SessionID=<?php echo $unit['SessionID']; ?>&UnitID=<?php echo $unit['UnitID']; ?>&UnitTitle=<?php echo $unit['UnitTitle']; ?>
        &GeneralOutcome=<?php echo $unit['GeneralOutcome']; ?>">Update</a></td>
        <?php 
        /*this block queries the db for references to this item.
          If any are found, the delete button is not displayed and an indication
          is made to the user that this item cannot be deleted.
        */
          $courseID = $unit['CourseID'];
          $termID = $unit['TermID'];
          $sessionID = $unit['SessionID'];
          $unitID = $unit['UnitID'];
         
          $SQL = "SELECT CourseID, TermID, SessionID, UnitID 
                  FROM Outcomes
                  WHERE SessionID = '$sessionID'
                    AND TermID = '$termID'
                    AND CourseID = '$courseID'
                    AND UnitID = '$unitID';";
          $canDelete = $db->query($SQL);
          if ($canDelete->rowCount() == 0) {
        ?>
        <td><a href="delete_item.php?table=Units&CourseID=<?php echo $unit['CourseID']; ?>&TermID=<?php echo $unit['TermID']; ?>
        &SessionID=<?php echo $unit['SessionID']; ?>&UnitID=<?php echo $unit['UnitID']; ?>&UnitTitle=<?php echo $unit['UnitTitle']; ?>
        &GeneralOutcome=<?php echo $unit['GeneralOutcome']; ?>">Delete</a></td>
        <?php } else { ?>
          <?php $message = '<h4>An item cannot be deleted if it is referenced in another table...</h4>'; ?>
          <td>Cannot Delete</td>
        <?php } ?>
      </tr>
      <?php } ?>
      <?php if (empty($unit['UnitID'])) {echo "<tr><td>Empty</td><td>Empty</td><td>Empty</td><td>Empty</td><td>Empty</td><td>Empty</td></tr>";} ?>
    </table>
    <?php if (empty($unit['UnitID'])) echo '<h4>No Unit to display</h4>'; ?>
    <form action="add_item.php" method="get">
      <input type="hidden" name="table" value="Units" />
      <input type="submit" value="Add Unit" />
    </form>
    <?php echo $message; ?>
  </div>

<?php
  include('footer.php')
?>