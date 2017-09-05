<?php
//include "../../php/connection/connect.php";
$selectQuestionQuery       = "select * from surveyquestion";
$selectQuestionQueryResult = mysqli_query($conn, $selectQuestionQuery);

echo '<script>';
while ($selectQuestionRow = $selectQuestionQueryResult->fetch_assoc()) {
    
    if ($selectQuestionRow['inputtype'] != 'textarea') {
        $id      = $selectQuestionRow['id'];
        $option1 = $selectQuestionRow['option1'];
        $option2 = $selectQuestionRow['option2'];
        $option3 = $selectQuestionRow['option3'];
        $option4 = $selectQuestionRow['option4'];
		
		$opt1Count['count'] = 0;
		$opt2Count['count'] = 0;
		$opt3Count['count'] = 0;
		$opt4Count['count'] = 0;
		
		$getAnswerCountQuery = "select count(answer) as count from surveydata where questionno = '$id'";
		$getAnswerCountQueryResult        = mysqli_query($conn, $getAnswerCountQuery);
        $answerCount = mysqli_fetch_assoc($getAnswerCountQueryResult);
		
		if ($option1 != NULL || $option1 != '') {
			$getoption1CountQuery = "select count(answer) as count from surveydata where questionno = '$id' and answer = '$option1'";
			$option1Result        = mysqli_query($conn, $getoption1CountQuery);
            $opt1Count            = mysqli_fetch_assoc($option1Result);
		}
		
		if ($option2 != NULL || $option2 != '') {
			$getoption2CountQuery = "select count(answer) as count from surveydata where  questionno = '$id' and answer = '$option2'";
            $option2Result        = mysqli_query($conn, $getoption2CountQuery);
            $opt2Count            = mysqli_fetch_assoc($option2Result);
		}
		
		 if ($option3 != NULL || $option3 != '') {
            $getoption3CountQuery = "select count(answer) as count from surveydata where  questionno = '$id' and answer = '$option3'";
            $option3Result        = mysqli_query($conn, $getoption3CountQuery);
            $opt3Count            = mysqli_fetch_assoc($option3Result);
        }
		
		if ($option4 != NULL || $option4 != '') {
            $getoption4CountQuery = "select count(answer) as count from surveydata where  questionno = '$id' and answer = '$option4'";
            $option4Result        = mysqli_query($conn, $getoption4CountQuery);
            $opt4Count            = mysqli_fetch_assoc($option4Result);
		}
		
		echo '
		var pieData'.$id.' = [
				{
					value: '.$opt1Count["count"].',
					color:"#30a5ff",
					highlight: "#62b9fb",
					label: "'.$option1.'"
				},
				{
					value: '.$opt2Count["count"].',
					color: "#ffb53e",
					highlight: "#fac878",
					label: "'.$option2.'"
				},
				{
					value: '.$opt3Count["count"].',
					color:"#eee",
					highlight: "#eee",
					label: "'.$option3.'"
				},
				{
					value: '.$opt4Count["count"].',
					color: "#000",
					highlight: "#000",
					label: "'.$option4.'"
				}
				

			];
		';
		
		
    }
    
}
echo '</script>';
?>