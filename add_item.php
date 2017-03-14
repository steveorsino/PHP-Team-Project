<?php
  include('dbconnect.php');//passes username and password to PDO object and creates $db variable
  $title = 'Add Form';
  $button = true;
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
      <?php echo "<h2>Add to the $table table</h2>"; ?>
      <!-- Start Form -->
      <form action="add_item.php" method="post">
      <table>
      <!-- Term Table -->
      <?php if ($table === 'Term') { ?>
        <tr>
          <td>Term ID(int): </td>
          <td><input type="number" name="TermID"></td>
        </tr>
        <tr>
          <td>Title: </td>
          <td><input type="text" name="Title"></td>
        </tr>
      <?php } //close term?>
      <!-- Session Table -->
      <?php if ($table === 'Session') { ?>
        <?php $SQL = 'SELECT TermID from Term;';//check to ensure Terms exist
              $terms = $db->query($SQL); ?>
              <?php if ($terms->rowCount() == 0) {
                echo "<h4>You must add terms before you can add sessions.</h4>";
                $button = false; //to prevent the add button from showing
              } else { //close if?>
              <tr>
                <td>Session ID(int): </td>
                <td><input type="number" name="SessionID"></td>
              </tr>
              <tr>
                <td>Start Date: </td>
                <td><input type="date" name="StartDate" /></td>
              </tr>
              <tr>
                <td>End Date: </td>
                <td><input type="date" name="EndDate" /></td>
              </tr>
              <?php foreach ($terms as $term) { ?>
              <tr>
                <td>Term: <?php echo $term['TermID']; ?></td>
                <td><input type="radio" name="TermID" value="<?php echo $term['TermID']; ?>" /></td>
              </tr>
                <?php } //close foreach?>      
              <?php } //close session else?>
      <?php } //close session?>
      <!-- Course Table -->
      <?php if ($table === 'Course') { ?>
        <tr>
          <td>Course ID(int): </td>
          <td><input type="number" name="CourseID" /></td>
        </tr>
        <tr>
          <td>Course Title: </td>
          <td><input type="text" name="CourseTitle"></td>
        </tr>
        <tr>
          <td>Course Description: </td>
        </tr>
        <tr>
          <td><textarea name="CourseDescription" rows="5" cols="20"></textarea></td>
        </tr>
      <?php } //close Course?>
      <!-- Syllabus Table -->
      <?php if ($table === 'Syllabus') { ?>
        <?php $SQL1 = 'SELECT CourseID FROM Course;'; //checks to ensure Term, Session, and Course exist
              $courses = $db->query($SQL1);
              $SQL2 = 'SELECT TermID, SessionID FROM Session ORDER BY TermID;';
              $termSessions = $db->query($SQL2);?> 
              <?php if (($courses->rowCount() == 0) || ($termSessions->rowCount() == 0)) {
                echo "<h4>You must add a Term, Session, and a Course before you can add a Syllabus.</h4>";
                $button = false; //to prevent the add button from showing
              } else {//close if ?>
                  <tr>
                    <td colspan="2">Select Term</td>
                  </tr>
                <?php 
                
                foreach ($termSessions as $termSession) { 
                  $termID = $termSession['TermID'];
                  $sessionID = $termSession['SessionID'];
                  $termSessPair = "$termID,$sessionID";
                  
                ?>
                  <tr>
                    <td>Term ID: <?php echo $termSession['TermID']; ?></td>
                    <td>Session ID: <?php echo $termSession['SessionID']; ?></td>
                    <td><input type="radio" name="termSessPair" value="<?php echo $termSessPair; ?>" /></td>
                  </tr>
                <?php } //close Term foreach?>
                  <tr>
                    <td colspan="2">Select Course</td>
                  </tr>
                <?php foreach ($courses as $course) { ?>
                  <tr>
                    <td>Course ID: <?php echo $course['CourseID']; ?></td>
                    <td><input type="radio" name="CourseID" value="<?php echo $course['CourseID']; ?>" /></td>
                  </tr>
                <?php } //close Course foreach?>
              <?php } //close else ?>
      <?php } //close Syllabus?>
      <!-- Units Table -->
      <?php if ($table === 'Units') { ?>
        <?php $SQL = 'SELECT CourseID, TermID, SessionID
                        FROM Syllabus
                          ORDER BY TermID;'; //checks to ensure Term, Session, and Course exist
              $units = $db->query($SQL); ?>
              <?php if ($units->rowCount() == 0) {
                echo "<h4>You must add a Syllabus before you can add a Unit.</h4>";
                $button = false; //to prevent the add button from showing
              } else {//close if ?>
                  <tr>
                    <td>Unit ID: </td>
                    <td><input type="number" name="UnitID" /></td>
                  </tr>
                  <tr>
                    <td>Unit Title</td>
                    <td><input type="text" name="UnitTitle" /></td>
                  </tr>
                  <tr>
                    <td colspan="2">Select Syllabus</td>
                  </tr>
                <?php foreach ($units as $unit) { 
                  $courseID = $unit['CourseID'];
                  $termID = $unit['TermID'];
                  $sessionID = $unit['SessionID'];
                  $unitSyl = "$courseID,$termID,$sessionID";
                ?>
                  <tr>
                    <td>Term ID: <?php echo $unit['TermID']; ?></td>
                    <td>Session ID: <?php echo $unit['SessionID']; ?></td>
                    <td>Course ID: <?php echo $unit['CourseID']; ?></td>
                    <td><input type="radio" name="unitSyl" value="<?php echo $unitSyl; ?>" /></td>
                  </tr>
                <?php } //close unitSyl foreach?>
                  <tr>
                    <td colspan="2">Enter General Outcome</td>
                  </tr>
                  <tr>
                    <td><textarea name="GeneralOutcome" rows="5" cols="20"></textarea></td>
                  </tr>
              <?php } //close else ?>
      <?php } //close Units?>
      <!-- Outcomes Table -->
      <?php if ($table === 'Outcomes') { ?>
        <?php $SQL = 'SELECT UnitID, CourseID, TermID, SessionID
                        FROM Units
                          ORDER BY UnitID, TermID;'; //checks to ensure Term, Session, and Course exist
              $outcomes = $db->query($SQL); ?>
              <?php if ($outcomes->rowCount() == 0) {
                echo "<h4>You must add a Unit before you can add an Outcome.</h4>";
                $button = false; //to prevent the add button from showing
              } else {//close if ?>
                  <tr>
                    <td>Outcome ID: </td>
                    <td><input type="number" name="OutcomeID" /></td>
                  </tr>
                  <tr>
                    <td colspan="2">Select Unit</td>
                  </tr>
                <?php foreach ($outcomes as $outcome) { 
                  $unitID = $outcome['CourseID'];
                  $courseID = $outcome['CourseID'];
                  $termID = $outcome['TermID'];
                  $sessionID = $outcome['SessionID'];
                  $outcomeUnit = "$unitID,$courseID,$termID,$sessionID";
                ?>
                  <tr>
                    <td>Unit ID: <?php echo $outcome['UnitID']; ?></td>
                    <td>Term ID: <?php echo $outcome['TermID']; ?></td>
                    <td>Session ID: <?php echo $outcome['SessionID']; ?></td>
                    <td>Course ID: <?php echo $outcome['CourseID']; ?></td>
                    <td><input type="radio" name="outcomeUnit" value="<?php echo $outcomeUnit; ?>" /></td>
                  </tr>
                <?php } //close outcomeUnit foreach?>
                  <tr>
                    <td colspan="2">Enter Specific Outcome</td>
                  </tr>
                  <tr>
                    <td><textarea name="SpecificOutcome" rows="5" cols="20"></textarea></td>
                  </tr>
              <?php } //close else ?>
      <?php } //close Outcomes?>  
        <?php if ($button) { //if flase, prevents the add button from existing?>
          <tr>
            <td><input type="submit" value="Add Item" /></td>
            <td><input type="hidden" name="table" value="<?php echo $table; ?>" /></td>
          </tr>
            <?php } //close button if?>
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
        $SQL = "INSERT INTO Term
                (TermID, Title)
                VALUES
                ('$TermID', '$Title');";
        try {
          $success = $db->exec($SQL);
        } catch(PDOException $e) {
          echo '<h4>There was an error adding this item. Check that the ID Does not already exist.</h4>';
        }
        if (!$e) {
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
            $SQL = "INSERT INTO Session
                    (SessionID, StartDate, EndDate, TermID)
                    VALUES
                    ('$SessionID', '$StartDate', '$EndDate', '$TermID');";
            try {
              $success = $db->exec($SQL);
            } catch(PDOException $e) {
              echo '<h4>There was an error adding this item. Check that the TermID and Session ID combination does not already exist.</h4>';
            }
            if (!$e) {
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
        $SQL = "INSERT INTO Course
                (CourseID, CourseTitle, CourseDescription)
                VALUES
                ('$CourseID', '$CourseTitle', '$CourseDescription');";
       try {
          $success = $db->exec($SQL);
        } catch(PDOException $e) {
          echo '<h4>There was an error adding this item. Check that the ID Does not already exist.</h4>';
        }
        if (!$e) {
          //redirect to course page if successful
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
       try {
          $success = $db->exec($SQL);
        } catch(PDOException $e) {
          echo '<h4>There was an error adding this item. Check that the ID combination does not already exist.</h4>';
        }
        if (!$e) {
          //redirect to syllabus page if successful
          header('Location: syllabus.php');
        } 
        
      ?>
      <?php } ?>
      <?php if ($table == 'Units') { 
      //begin Units insert
        $unitID = filter_input(INPUT_POST, 'UnitID');
        $unitTitle = filter_input(INPUT_POST, 'UnitTitle');
        $unitSyl = filter_input(INPUT_POST, 'unitSyl');
        $unitSyl = explode(',', $unitSyl);
        $courseID = $unitSyl[0];
        $termID = $unitSyl[1];
        $sessionID = $unitSyl[2];
        $generalOutcome = filter_input(INPUT_POST, 'GeneralOutcome');
        
        $SQL = "INSERT INTO Units
                (UnitID, CourseID, TermID, SessionID, UnitTitle, GeneralOutcome)
                VALUES
                ('$unitID', '$courseID', '$termID', '$sessionID', '$unitTitle', '$generalOutcome');";
        try {
          $success = $db->exec($SQL);
        } catch(PDOException $e) {
          echo '<h4>There was an error adding this item. Check that the ID combination does not already exist.</h4>';
        }
        if (!$e) {
          //redirect to units page if successful
          header('Location: units.php');
        } 
        
      ?>
      <?php } ?>
      <?php if ($table == 'Outcomes') { 
      //begin Outcomes insert
        $outcomeID = filter_input(INPUT_POST, 'OutcomeID');
        $outcomeUnit = filter_input(INPUT_POST, 'outcomeUnit');
        $outcomeUnit = explode(',', $outcomeUnit);
        $unitID = $outcomeUnit[0];
        $courseID = $outcomeUnit[1];
        $termID = $outcomeUnit[2];
        $sessionID = $outcomeUnit[3];
        $specificOutcome = filter_input(INPUT_POST, 'SpecificOutcome');
        
        $SQL = "INSERT INTO Outcomes
                (OutcomeID, UnitID, CourseID, TermID, SessionID, SpecificOutcome)
                VALUES
                ('$outcomeID', '$unitID', '$courseID', '$termID', '$sessionID', '$specificOutcome');";
        try {
          $success = $db->exec($SQL);
        } catch(PDOException $e) {
          echo '<h4>There was an error adding this item. Check that the ID combination does not already exist.</h4>';
        }
        if (!$e) {
          //redirect to outcomes page if successful
          header('Location: outcomes.php');
        } 
        
      ?>
      <?php } ?>
    <?php } //close method get?>
  </div>
<?php 
  include('footer.php');
?>