<?php
  include('dbconnect.php');//passes username and password to PDO object and creates $db variable
  $title = 'Update Form';
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
      <?php echo "<h2>Update the $table table</h2>"; ?>
      <!-- Start Form -->
      <form action="update_item.php" method="post">
      <table>
      <!-- Term Table -->
      <?php if ($table === 'Term') { 
        //store row values into varables
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
          <td><input type="text" name="Title" value="<?php echo $Title; ?>"></td>
        </tr>
      <?php } //close term?>
      <!-- Session Table -->
      <?php if ($table === 'Session') { 
        //store row values into varables
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
        </tr>
        <tr>
          <td>Enter new Start Date: </td>
          <td><input type="date" name="StartDate" value="<?php echo $startDate; ?>" /></td>
        </tr>
        <tr>
          <td>Enter new End Date: </td>
          <td><input type="date" name="EndDate" value="<?php echo $endDate; ?>" /></td>
        </tr>          
      <?php } //close session?>
      <!-- Course Table -->
      <?php if ($table === 'Course') { 
        //store row values into varables
        $courseID = filter_input(INPUT_GET, 'CourseID');
        $courseTitle = filter_input(INPUT_GET, 'CourseTitle');
        $courseDescription = filter_input(INPUT_GET, 'CourseDescription');
      ?>
        <tr>
          <td>Course ID: </td>
          <td><?php echo $courseID; ?></td>
        </tr>
        <tr>
          <td>Course Title: </td>
          <td><input type="text" name="CourseTitle" value="<?php echo $courseTitle; ?>" /></td>
        </tr>
        <tr>
          <td>Course Description: </td>
        </tr>
        <tr>
          <td><textarea name="CourseDescription" rows="5" cols="20"><?php echo $courseDescription; ?></textarea></td>
        </tr>
        <tr>
          <td><input type="hidden" name="CourseID" value="<?php echo $courseID; ?>" />
      <?php } //close Course?>
      <!-- Units Table -->
      <?php if ($table === 'Units') { 
        //store row values into varables
        $CourseID = filter_input(INPUT_GET, 'CourseID');
        $TermID = filter_input(INPUT_GET, 'TermID');
        $SessionID = filter_input(INPUT_GET, 'SessionID');
        $UnitID = filter_input(INPUT_GET, 'UnitID');
        $UnitTitle = filter_input(INPUT_GET, 'UnitTitle');
        $GeneralOutcome = filter_input(INPUT_GET, 'GeneralOutcome');
      ?>     
        <tr>
          <td>Unit ID: </td>
          <td><?php echo $UnitID; ?></td>
          <td><input type="hidden" name="UnitID" value="<?php echo $UnitID; ?>" /></td>
          <td><input type="hidden" name="CourseID" value="<?php echo $CourseID; ?>" /></td>
          <td><input type="hidden" name="TermID" value="<?php echo $TermID; ?>" /></td>
          <td><input type="hidden" name="SessionID" value="<?php echo $SessionID; ?>" /></td>
        </tr>
        <tr>
          <td>Term ID: <?php echo $TermID; ?></td>
          <td>Session ID: <?php echo $SessionID; ?></td>
          <td>Course ID: <?php echo $CourseID; ?></td>
        </tr>
        <tr>
          <td>Unit Title</td>
          <td><input type="text" name="UnitTitle" value="<?php echo $UnitTitle; ?>" /></td>
        </tr>
        <tr>
          <td colspan="2">Enter General Outcome</td>
        </tr>
        <tr>
          <td><textarea name="GeneralOutcome" rows="5" cols="20"><?php echo $GeneralOutcome; ?></textarea></td>
        </tr>              
      <?php } //close Units?>
      <!-- Outcomes Table -->
      <?php if ($table === 'Outcomes') { 
        //store row values into varables
        $CourseID = filter_input(INPUT_GET, 'CourseID');
        $TermID = filter_input(INPUT_GET, 'TermID');
        $SessionID = filter_input(INPUT_GET, 'SessionID');
        $UnitID = filter_input(INPUT_GET, 'UnitID');
        $OutcomeID = filter_input(INPUT_GET, 'OutcomeID');
        $SpecificOutcome = filter_input(INPUT_GET, 'SpecificOutcome');
      ?>     
        <tr>
          <td>Outcome ID: </td>
          <td><?php echo $OutcomeID; ?></td>
          <td><input type="hidden" name="OutcomeID" value="<?php echo $OutcomeID; ?>" /></td>
          <td><input type="hidden" name="UnitID" value="<?php echo $UnitID; ?>" /></td>
          <td><input type="hidden" name="CourseID" value="<?php echo $CourseID; ?>" /></td>
          <td><input type="hidden" name="TermID" value="<?php echo $TermID; ?>" /></td>
          <td><input type="hidden" name="SessionID" value="<?php echo $SessionID; ?>" /></td>
        </tr>
        <tr>
          <td>Unit ID:  <?php echo $UnitID; ?></td>
          <td>Term ID: <?php echo $TermID; ?></td>
          <td>Session ID: <?php echo $SessionID; ?></td>
          <td>Course ID: <?php echo $CourseID; ?></td>
        </tr>
        <tr>
          <td colspan="2">Enter Updated Specific Outcome</td>
        </tr>
        <tr>
          <td><textarea name="SpecificOutcome" rows="5" cols="20"><?php echo $SpecificOutcome; ?></textarea></td>
        </tr>
      <?php } //close Outcomes?>         
        <tr>
          <td><input type="submit" value="Update Item" /></td>
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
        $SQL = "UPDATE Term
                  SET Title = '$Title'
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
        //validate the dates
        if ($StartDate > $EndDate) {
          echo '<h4>The End Date must be later than the Start Date.</h4>';
          echo '<a href="session.php">Back to session page</a>';
        } else {
            $SQL = "UPDATE Session
                    SET StartDate = '$StartDate',
                        EndDate = '$EndDate'
                    WHERE SessionID = '$SessionID' AND TermID = '$TermID';";
            $success = $db->exec($SQL);
            if ($success < 1) {
              echo '<h4 class="error">There was an error inserting the item</h4>';
            } else {
              //redirect to session page if successful
              header('Location: session.php');
            }
        }
      ?>
      <?php } ?>
      <?php if ($table == 'Course') { 
      //begin Course insert
        $CourseID = filter_input(INPUT_POST, 'CourseID');
        $CourseTitle = filter_input(INPUT_POST, 'CourseTitle');
        $CourseDescription = filter_input(INPUT_POST, 'CourseDescription');
        $SQL = "UPDATE Course SET CourseTitle = '$CourseTitle', CourseDescription = '$CourseDescription' WHERE CourseID = '$CourseID';";
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
      //begin Syllabus insert
        $termSessPair = filter_input(INPUT_POST, 'termSessPair');
        $termSessPair = explode(',', $termSessPair);
        $termID = $termSessPair[0];
        $sessionID = $termSessPair[1];
        $courseID = filter_input(INPUT_POST, 'CourseID');
        //echo "Term = $termID, session = $sessionID, course = $courseID";
        
        $SQL = "INSERT INTO Syllabus
                (CourseID, TermID, SessionID)
                VALUES
                ('$courseID', '$termID', '$sessionID');";
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
      //begin Units insert
        $unitID = filter_input(INPUT_POST, 'UnitID');
        $courseID = filter_input(INPUT_POST, 'CourseID');
        $termID = filter_input(INPUT_POST, 'TermID');
        $sessionID = filter_input(INPUT_POST, 'SessionID');
        $unitTitle = filter_input(INPUT_POST, 'UnitTitle');
        $generalOutcome = filter_input(INPUT_POST, 'GeneralOutcome');
        
        $SQL = "UPDATE Units
                SET UnitTitle = '$unitTitle',
                    GeneralOutcome = '$generalOutcome'
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
        
        $SQL = "UPDATE Outcomes
                SET SpecificOutcome = '$specificOutcome'
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