<?php
  include('dbconnect.php');
  
  $title = 'Report';
  include('header.php');
  echo "<h2>$title page</h2>";
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $thisSyllabus = filter_input(INPUT_POST, 'thisSyllabus');
    $thisSyllabus = explode(',', $thisSyllabus);
    $CourseID = $thisSyllabus[0];
    $TermID = $thisSyllabus[1];
    $SessionID = $thisSyllabus[2];
    
    $SQL = "SELECT Title From Term WHERE TermID = '$TermID';";
    $Terms = $db->query($SQL);
    $SQL = "SELECT CourseTitle, CourseDescription FROM Course WHERE CourseID = '$CourseID';";
    $Courses = $db->query($SQL);
    $SQL = "SELECT StartDate, EndDate FROM Session WHERE SessionID = '$SessionID' AND TermID = '$TermID';";
    $Sessions = $db->query($SQL);
    $SQL = "SELECT UnitID, UnitTitle, GeneralOutcome FROM Units WHERE SessionID = '$SessionID' AND TermID = '$TermID' AND CourseID = '$CourseID';";
    $Units = $db->query($SQL);
    $SQL = "SELECT UnitID, OutcomeID, SpecificOutcome FROM Outcomes WHERE SessionID = '$SessionID' AND TermID = '$TermID' AND CourseID = '$CourseID';";
    $Outcomes = $db->query($SQL);
    if (!$Terms || !$Courses || !$Sessions || !$Units || !$Outcomes) {
      echo "<h4>There was an error</h4>";
    } else {
?>
  <h3>Syllabus Report</h3>
  <table>
    <?php foreach($Terms as $Term){ ?>
    <tr>
      <td>Term ID: <?php echo $TermID; ?></td>
    </tr>
    <tr>
      <td>Term Title: </td>
      <td><?php echo $Term['Title']; ?></td>
    </tr>
    <?php } //close foreach?>
    <?php foreach($Sessions as $Session) { ?>
    <tr>
      <td>Session ID: <?php echo $SessionID; ?></td>
    </tr>
    <tr>
      <td>Start Date: </td>
      <td><?php echo $Session['StartDate']; ?></td>
    </tr>
    <tr>
      <td>End Date: </td>
      <td><?php echo $Session['EndDate']; ?></td>
    </tr>
    <?php }  //close foreach?>
    <?php foreach($Courses as $Course) { ?>
    <tr>
      <td>Course ID: <?php echo $CourseID; ?></td>
    </tr>
    <tr>
      <td>Course Title: </td>
      <td><?php echo $Course['CourseTitle']; ?></td>
    </tr>
    <tr>
      <td>Course Description: </td>
      <td><?php echo $Course['CourseDescription']; ?></td>
    </tr>
    <?php }  //close foreach?>
  </table>
  <h3>Units and Outcomes</h3>
  <table>
    <?php foreach($Units as $Unit) { ?>
      <tr>
        <td>Unit ID: <?php echo $Unit['UnitID'] ?></td>
      </tr>
      <tr>
        <td>Unit Title: <?php echo $Unit['UnitTitle'] ?></td>
      </tr>
      <tr>
        <td>General Outcome: <?php echo $Unit['GeneralOutcome'] ?></td>
      </tr>
      <?php foreach($Outcomes as $Outcome) { 
              if ($Outcome['UnitID'] == $Unit['UnitID']) { ?>
                <tr>
                  <td>Outcome ID: <?php echo $Outcome['OutcomeID']; ?></td>
                </tr>
                <tr>
                  <td>Specific Outcome:</td>
                </tr>
                <tr>
                  <td><?php echo $Outcome['SpecificOutcome']; ?>
                </tr>
              <?php } //close if ?>
      <?php } //close outcome foreach?>
    <?php } //close unit foreach?>
  </table>
    <?php } //close error else?>
<?php } /*close method if*/else { ?>
  <table>
    <form action="report.php" method="post">
      <tr>
        <th colspan="3">Enter Syllabus Information</th>
      </tr>
        <?php
          $i = 0;
          $SQL = "SELECT * FROM Syllabus;";
          $syllabi = $db->query($SQL);
          foreach($syllabi as $syllabus) {
            $courseID = $syllabus['CourseID'];
            $termID = $syllabus['TermID'];
            $sessionID = $syllabus['SessionID'];
            $thisSyllabus = "$courseID,$termID,$sessionID";
            $i++;
        ?>
      
      <tr>
        <td>Syllabus <?php echo $i; ?></td>
      </tr>
      <tr>
        <td><input type="radio" name="thisSyllabus" value="<?php echo $thisSyllabus; ?>" /></td>
        <td>Course ID: <?php echo $courseID; ?></td>
        <td>Term ID: <?php echo $termID; ?></td>
        <td>Session ID: <?php echo $sessionID; ?></td>
      </tr>
          <?php } //close foreach ?>
      <tr>
        <td><input type="submit" value="Generate Report"</td>
      </tr>
    </form>
  </table>
  <?php } //close method else ?>

<?php
  include('footer.php');
?>