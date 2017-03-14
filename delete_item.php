<?php
  include('dbconnect.php');//passes username and password to PDO object and creates $db variable
  $title = 'Delete Form';
  include('header.php');
?>
  <div class="container">
    <?php /*
    This block handles the data if this page was accessed from the add button.
    It first checks which table is being affected.
    */ ?>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'GET') { 
      //Check which table to affect
      $table = filter_input(INPUT_GET, 'table'); ?>
      <?php echo "<h2>Confirm deletion from the $table table</h2>"; ?>
      <!-- Start Form -->
      <form action="delete_item.php" method="post">
      <table>
      <!-- Term Table -->
      <?php if ($table === 'Term') { 
      $TermID = filter_input(INPUT_GET, 'TermID');
      $Title = filter_input(INPUT_GET, 'Title');
      ?>
        <tr>
          <td>Term ID: </td>
          <td><?php echo $TermID; ?></td>
          <td><input type="hidden" name="TermID" value="<?php echo $TermID; ?>"></td>
        </tr>
        <tr>
          <td>Title: </td>
          <td><?php echo $Title; ?></td>
          <td><input type="hidden" name="Title" value="<?php echo $Title; ?>"></td>
        </tr>
      <?php } //close term?>
      <!-- Session Table -->
      <?php if ($table === 'Session') { 
        $sessionID = filter_input(INPUT_GET, 'SessionID');
        $termID = filter_input(INPUT_GET, 'TermID');
        $startDate = filter_input(INPUT_GET, 'StartDate');
        $endDate = filter_input(INPUT_GET, 'EndDate');
      ?>
        <tr>
          <td>Session ID: </td>
          <td><?php echo $sessionID; ?></td>
          <td><input type="hidden" name="SessionID" value="<?php echo $sessionID; ?>" /></td>
        </tr>
        <tr>
          <td>Term ID: </td>
          <td><?php echo $termID; ?></td>
          <td><input type="hidden" name="TermID" value="<?php echo $termID; ?>" /></td>
        </tr>
        <tr>
          <td>Start Date: <?php echo $startDate; ?></td>
          <td><input type="hidden" name="StartDate" value="<?php echo $startDate; ?>" /></td>
        </tr>
        <tr>
          <td>End Date: <?php echo $endDate; ?></td>
          <td><input type="hidden" name="EndDate" value="<?php echo $endDate; ?>" /></td>
        </tr>          
      <?php } //close session?>
      <!-- Course Table -->
      <?php if ($table === 'Course') { 
        $courseID = filter_input(INPUT_GET, 'CourseID');
        $courseTitle = filter_input(INPUT_GET, 'CourseTitle');
        $courseDescription = filter_input(INPUT_GET, 'CourseDescription');
      ?>
        <tr>
          <td>Course ID: <?php echo $courseID; ?></td>
          <td><input type="hidden" name="CourseID" value="<?php echo $courseID; ?>" /></td>
        </tr>
        <tr>
          <td>Course Title: <?php echo $courseTitle; ?></td>
          <td><input type="hidden" name="CourseTitle" value="<?php echo $courseTitle; ?>" /></td>
        </tr>
      <?php } //close Course?>
      <!-- Syllabus Table -->
      <?php if ($table === 'Syllabus') { 
        $CourseID = filter_input(INPUT_GET, 'CourseID');
        $TermID = filter_input(INPUT_GET, 'TermID');
        $SessionID = filter_input(INPUT_GET, 'SessionID'); 
      ?>
        <tr>
          <td>Term ID: <?php echo $TermID; ?></td>
          <td><input type="hidden" name="TermID" value="<?php echo $TermID; ?>" /></td>
        </tr>
        <tr>
          <td>Session ID: <?php echo $SessionID; ?></td>
          <td><input type="hidden" name="SessionID" value="<?php echo $SessionID; ?>" /></td>
        </tr>
        <tr>
          <td>Course ID: <?php echo $CourseID; ?></td>
          <td><input type="hidden" name="CourseID" value="<?php echo $CourseID; ?>" /></td>
        </tr>
      <?php } //close Syllabus?>
      <!-- Units Table -->
      <?php if ($table === 'Units') { 
        $CourseID = filter_input(INPUT_GET, 'CourseID');
        $TermID = filter_input(INPUT_GET, 'TermID');
        $SessionID = filter_input(INPUT_GET, 'SessionID');
        $UnitID = filter_input(INPUT_GET, 'UnitID');
        $UnitTitle = filter_input(INPUT_GET, 'UnitTitle');
        $GeneralOutcome = filter_input(INPUT_GET, 'GeneralOutcome');
      ?>     
        <tr>
          <td>Unit ID: <?php echo $UnitID; ?></td>
          <td><input type="hidden" name="UnitID" value="<?php echo $UnitID; ?>" /></td>
        </tr>
        <tr>
          <td>Unit Title: <?php echo $UnitTitle; ?></td>
          <td><input type="hidden" name="UnitTitle" value="<?php echo $UnitTitle; ?>" /></td>
        </tr>
        <tr>
          <td><input type="hidden" name="CourseID" value="<?php echo $CourseID; ?>" /></td>
          <td><input type="hidden" name="TermID" value="<?php echo $TermID; ?>" /></td>
          <td><input type="hidden" name="SessionID" value="<?php echo $SessionID; ?>" /></td>
        </tr>
                      
      <?php } //close Units?>
      <!-- Outcomes Table -->
      <?php if ($table === 'Outcomes') { 
        $CourseID = filter_input(INPUT_GET, 'CourseID');
        $TermID = filter_input(INPUT_GET, 'TermID');
        $SessionID = filter_input(INPUT_GET, 'SessionID');
        $UnitID = filter_input(INPUT_GET, 'UnitID');
        $OutcomeID = filter_input(INPUT_GET, 'OutcomeID');
        $SpecificOutcome = filter_input(INPUT_GET, 'SpecificOutcome');
      ?>     
        <tr>
          <td>Outcome ID: <?php echo $OutcomeID; ?></td>
          <td><input type="hidden" name="OutcomeID" value="<?php echo $OutcomeID; ?>" /></td>
          <td><input type="hidden" name="UnitID" value="<?php echo $UnitID; ?>" /></td>
          <td><input type="hidden" name="CourseID" value="<?php echo $CourseID; ?>" /></td>
          <td><input type="hidden" name="TermID" value="<?php echo $TermID; ?>" /></td>
          <td><input type="hidden" name="SessionID" value="<?php echo $SessionID; ?>" /></td>
        </tr>
        <tr>
          <td colspan="2">Specific Outcome</td>
        </tr>
        <tr>
          <td><textarea name="SpecificOutcome" rows="5" cols="20"><?php echo $SpecificOutcome; ?></textarea></td>
        </tr>
      <?php } //close Outcomes?>         
        <tr>
          <td><input type="submit" value="Delete Item" /></td>
          <td><input type="hidden" name="table" value="<?php echo $table; ?>" /></td>
        </tr>
      </table>
      </form>
    <?php } //close method post?>
    <?php/*
    This section of code accepts data from the page itself via the post method.
    It accepts the data entered in the form section above.
    It then carries out the row insertion to the appropriate table.
    */?>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
      $table = filter_input(INPUT_POST, 'table'); ?>
      <?php if ($table == 'Term') { 
      //begin term insert
        $TermID = filter_input(INPUT_POST, 'TermID');
        $Title = filter_input(INPUT_POST, 'Title');
        $SQL = "DELETE FROM Term
                  WHERE TermID = '$TermID';";
        $success = $db->exec($SQL);
        if ($success < 1) {
          echo '<h4 class="error">There was an error inserting the item</h4>';
        } else {
          //redirect to term page if successful
          header('Location: term.php');
        }
      ?>
      <?php } ?>
      <?php if ($table == 'Session') { 
      //begin session insert
        $SessionID = filter_input(INPUT_POST, 'SessionID');
        $StartDate = filter_input(INPUT_POST, 'StartDate');
        $EndDate = filter_input(INPUT_POST, 'EndDate');
        $TermID = filter_input(INPUT_POST, 'TermID');
        $SQL = "DELETE FROM Session
                WHERE TermID = '$TermID' AND SessionID = '$SessionID';";
        $success = $db->exec($SQL);
        if ($success < 1) {
          echo '<h4 class="error">There was an error inserting the item</h4>';
        } else {
          //redirect to session page if successful
          header('Location: session.php');
        }
      ?>
      <?php } ?>
      <?php if ($table == 'Course') { 
      //begin Course insert
        $CourseID = filter_input(INPUT_POST, 'CourseID');
        $CourseTitle = filter_input(INPUT_POST, 'CourseTitle');
        $SQL = "DELETE FROM Course
                WHERE CourseID = '$CourseID';";
        $success = $db->exec($SQL);
        if ($success < 1) {
          echo '<h4 class="error">There was an error inserting the item</h4>';
        } else {
          //redirect to Course page if successful
          header('Location: course.php');
        }
      ?>
      <?php } ?>
      <?php if ($table == 'Syllabus') { 
      //begin Syllabus Delete
        $termID = filter_input(INPUT_POST, 'TermID');
        $sessionID = filter_input(INPUT_POST, 'SessionID');
        $courseID = filter_input(INPUT_POST, 'CourseID');
        //echo "Term = $termID, session = $sessionID, course = $courseID";
        
        $SQL = "DELETE FROM Syllabus
                WHERE CourseID =  '$courseID' AND 
                      TermID = '$termID' AND 
                      SessionID = '$sessionID'
                ;";
        $success = $db->exec($SQL);
        if ($success < 1) {
          echo '<h4 class="error">There was an error inserting the item</h4>';
        } else {
          //redirect to syllabus page if successful
          header('Location: syllabus.php');
        }
        
      ?>
      <?php } ?>
      <?php if ($table == 'Units') { 
      //begin Units Delete
        $unitID = filter_input(INPUT_POST, 'UnitID');
        $courseID = filter_input(INPUT_POST, 'CourseID');
        $termID = filter_input(INPUT_POST, 'TermID');
        $sessionID = filter_input(INPUT_POST, 'SessionID');
        $unitTitle = filter_input(INPUT_POST, 'UnitTitle');
        $generalOutcome = filter_input(INPUT_POST, 'GeneralOutcome');
        
        $SQL = "DELETE FROM Units
                WHERE
                UnitID = '$unitID' AND 
                CourseID = '$courseID' AND
                TermID = '$termID' AND
                SessionID = '$sessionID';";
        $success = $db->exec($SQL);
        if ($success < 1) {
          echo '<h4 class="error">There was an error inserting the item</h4>';
        } else {
          //redirect to units page if successful
          header('Location: units.php');
        }
        
      ?>
      <?php } ?>
      <?php if ($table == 'Outcomes') { 
      //begin Outcomes insert
        $outcomeID = filter_input(INPUT_POST, 'OutcomeID');
        $unitID = filter_input(INPUT_POST, 'UnitID');
        $courseID = filter_input(INPUT_POST, 'CourseID');
        $termID = filter_input(INPUT_POST, 'TermID');
        $sessionID = filter_input(INPUT_POST, 'SessionID');
        $specificOutcome = filter_input(INPUT_POST, 'SpecificOutcome');
        
        $SQL = "DELETE FROM Outcomes
                WHERE
                OutcomeID = '$outcomeID' AND
                UnitID = '$unitID' AND 
                CourseID = '$courseID' AND
                TermID = '$termID' AND
                SessionID = '$sessionID';";
        $success = $db->exec($SQL);
        if ($success < 1) {
          echo '<h4 class="error">There was an error inserting the item</h4>';
        } else {
          //redirect to units page if successful
          header('Location: outcomes.php');
        }  
      ?>
      <?php } ?>
    <?php } //close method get?>
  </div>
<?php 
  include('footer.php');
?>