<?php
  include('dbconnect.php');
  $SQL = 'SELECT * FROM Term;';
  $terms = $db->query($SQL);//Creates PDO object containing query results to be used in table
  $title = 'Term';
  $message = '';
  include('header.php');
  echo "<h2>$title table</h2>";
  
?>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a class="active" href="term.php">Term Table</a></li>
    <li><a href="session.php">Session Table</a></li>
    <li><a href="course.php">Course Table</a></li>
    <li><a href="syllabus.php">Syllabus Table</a></li>
    <li><a href="units.php">Units Table</a></li>
    <li><a href="outcomes.php">Outcomes Table</a></li>
  </ul>
  
  <div class="container">
    <table>
      <tr>
        <th>Term ID</th>
        <th>Title</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
      <?php foreach ($terms as $term) { ?>
      <tr>
        <td><?php echo $term['TermID']; ?></td>
        <td><?php echo $term['Title']; ?></td>
        <td><a href="update_item.php?table=Term&TermID=<?php echo $term['TermID']; ?>
        &Title=<?php echo $term['Title']; ?>">Update</a></td>
        <?php 
        /*this block queries the db for references to this item.
          If any are found, the delete button is not displayed and an indication
          is made to the user that this item cannot be deleted.
        */
          $termID = $term['TermID'];
          $SQL = "SELECT TermID from Session
                  WHERE TermID = '$termID';";
          $canDelete = $db->query($SQL);
          if ($canDelete->rowCount() == 0) {
        ?>
        <td><a href="delete_item.php?table=Term&TermID=<?php echo $term['TermID']; ?>
        &Title=<?php echo $term['Title']; ?>">Delete</a></td>
        <?php } else { ?>
          <?php $message = '<h4>An item cannot be deleted if it is referenced in another table...</h4>'; ?>
          <td>Cannot Delete</td>
        <?php } ?>
      </tr>
      <?php } ?>
      <?php if (empty($term['TermID'])) {echo "<tr><td>Empty</td><td>Empty</td></tr>";} ?>
    </table>
    <?php if (empty($term['TermID'])) echo '<h4>No term to display</h4>'; ?>
    <form action="add_item.php" method="get">
      <input type="hidden" name="table" value="Term">
      <input type="submit" value="Add Term" />
    </form>
    <?php echo $message; ?>
  </div>


<?php
  include('footer.php')
?>