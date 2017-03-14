<?php
  include('dbconnect.php');
  $SQL = 'SELECT * FROM Outcomes;';
  $outcomes = $db->query($SQL);
  
  $title = 'Outcomes';
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
    <li><a href="units.php">Units Table</a></li>
    <li><a class="active" href="outcomes.php">Outcomes Table</a></li>
  </ul>
  <div class="container">
    <table>
      <tr>
        <th>CourseID</th>
        <th>Term ID</th>
        <th>Session ID</th>
        <th>Unit ID</th>
        <th>Outcome ID</th>
        <th>Specific Outcome</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
      <?php foreach ($outcomes as $outcome) { ?>
      <tr>
        <td><?php echo $outcome['CourseID']; ?></td>
        <td><?php echo $outcome['TermID']; ?></td>
        <td><?php echo $outcome['SessionID']; ?></td>
        <td><?php echo $outcome['UnitID']; ?></td>
        <td><?php echo $outcome['OutcomeID']; ?></td>
        <td><?php echo $outcome['SpecificOutcome']; ?></td>
        <td><a href="update_item.php?table=Outcomes&CourseID=<?php echo $outcome['CourseID']; ?>&TermID=<?php echo $outcome['TermID']; ?>
        &SessionID=<?php echo $outcome['SessionID']; ?>&UnitID=<?php echo $outcome['UnitID']; ?>&OutcomeID=<?php echo $outcome['OutcomeID']; ?>
        &SpecificOutcome=<?php echo $outcome['SpecificOutcome']; ?>">Update</a></td>
        <td><a href="delete_item.php?table=Outcomes&CourseID=<?php echo $outcome['CourseID']; ?>&TermID=<?php echo $outcome['TermID']; ?>
        &SessionID=<?php echo $outcome['SessionID']; ?>&UnitID=<?php echo $outcome['UnitID']; ?>&OutcomeID=<?php echo $outcome['OutcomeID']; ?>
        &SpecificOutcome=<?php echo $outcome['SpecificOutcome']; ?>">Delete</a></td>
      </tr>
      <?php } ?>
      <?php if (empty($outcome['OutcomeID'])) {echo "<tr><td>Empty</td><td>Empty</td><td>Empty</td><td>Empty</td><td>Empty</td><td>Empty</td></tr>";} ?>
    </table>
    <?php if (empty($outcome['OutcomeID'])) echo '<h4>No Outcome to display</h4>'; ?>
    <form action="add_item.php" method="get">
      <input type="hidden" name="table" value="Outcomes" />
      <input type="submit" value="Add Outcome" />
    </form>
    <?php echo $message; ?>
  </div>

<?php
  include('footer.php')
?>