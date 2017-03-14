<?php
  include('dbconnect.php');
  $SQL = 'SELECT * FROM Session;';
  $sessions = $db->query($SQL);
  $title = 'Session';
  $message = '';
  include('header.php');
  echo "<h2>$title table</h2>";
?>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="term.php">Term Table</a></li>
    <li><a class="active" href="session.php">Session Table</a></li>
    <li><a href="course.php">Course Table</a></li>
    <li><a href="syllabus.php">Syllabus Table</a></li>
    <li><a href="units.php">Units Table</a></li>
    <li><a href="outcomes.php">Outcomes Table</a></li>
  </ul>
  
  <div class="container">
    <table>
      <tr>
        <th>Session ID</th>
        <th>Term ID</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
      <?php foreach ($sessions as $session) { ?>
      <tr>
        <td><?php echo $session['SessionID']; ?></td>
        <td><?php echo $session['TermID']; ?></td>
        <td><?php echo $session['StartDate']; ?></td>
        <td><?php echo $session['EndDate']; ?></td>
        <td><a href="update_item.php?table=Session&SessionID=<?php echo $session['SessionID']; ?>
        &TermID=<?php echo $session['TermID']; ?>&StartDate=<?php echo $session['StartDate']; ?>
        &EndDate=<?php echo $session['EndDate']; ?>">Update</a></td>
        <?php 
        /*this block queries the db for references to this item.
          If any are found, the delete button is not displayed and an indication
          is made to the user that this item cannot be deleted.
        */
          $sessionID = $session['SessionID'];
          $termID = $session['TermID'];
          $SQL = "SELECT SessionID, TermID
                  FROM Syllabus
                  WHERE SessionID = '$sessionID' AND TermID = '$termID';";
          $canDelete = $db->query($SQL);
          if ($canDelete->rowCount() == 0) {
        ?>
        <td><a href="delete_item.php?table=Session&SessionID=<?php echo $session['SessionID']; ?>
        &TermID=<?php echo $session['TermID']; ?>&StartDate=<?php echo $session['StartDate']; ?>
        &EndDate=<?php echo $session['EndDate']; ?>">Delete</a></td>
        <?php } else { ?>
          <?php $message = '<h4>An item cannot be deleted if it is referenced in another table...</h4>'; ?>
          <td>Cannot Delete</td>
        <?php } ?>
      </tr>
      <?php } ?>
      <?php if (empty($session['SessionID'])) {echo "<tr><td>Empty</td><td>Empty</td><td>Empty</td></td><td>Empty</td></tr>";} ?>
    </table>
    <?php if (empty($session['SessionID'])) echo '<h4>No Session to display</h4>'; ?>
    <form action="add_item.php" method="get">
      <input type="hidden" name="table" value="Session" />
      <input type="submit" value="Add Session" />
    </form>
    <?php echo $message; ?>
  </div>


<?php
  include('footer.php')
?>