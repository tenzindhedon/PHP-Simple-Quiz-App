<?php session_start()?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Assignment 1: PHP Quiz App</title>
        <link rel="stylesheet" href="quizFormStyle.css">
    </head>
    <body>
        <?php
        // Get the quiz form from global session variable
            $quiz = $_SESSION['quiz'];
            //var_dump($_SESSION['quiz']);
        
        // print the title of the result
            echo "<h1>Result:</h1>";
            
        // store the questions in an array 
            $questions = $quiz["questions"];
           
        // check if all questions are answered. Direct to error page otherwise
            for($i=0;$i<count($questions);$i++){
                if ($_POST["answer$i"]==null) {
                    header("location:errorPage.php");
                } 
            }
            
        // store the quiz result in a variable
            $quizResult = "<div>";
       
        // run a loop through the question arry to display the questions and its anwser options
            $count = 1; // for question numbering
            $score = 0; // for counting score
            
            for($i=0; $i<count($questions); $i++){
                $quizResult .= "<div class='questionBox'>";
                // question number
                $quizResult .= "<h2>Question " .  $count++ . "</h2>"; 
                // question text
                $quizResult .= "<p>" . $questions[$i]['questionText'] . "</p>";
                
                // run a loop to print bulleted list of answers
                    for($c=0; $c<count($questions[$i]["choices"]); $c++){
                        $quizResult .= "<input type='radio' disabled>" . $questions[$i]["choices"][$c] . "<br>";
                    }
                
                // get the correct answer
                    $correctAnswer = $questions[$i]["choices"][$questions[$i]["answer"]];
                    
                // check and print correct and incorrect answers
                    if($_POST["answer$i"] == $correctAnswer){
                        $quizResult .= "<p class='correct'>Your answer: " . $_POST["answer$i"] . " (correct)</p>";
                        $score++;
                    }else{
                        $quizResult .= "<p class='incorrect'>Your answer: " . $_POST["answer$i"] . " (incorrect)</p>";
                        $quizResult .= "<p>Correct answer: " . $correctAnswer;
                    }
                $quizResult .= "</div>";
            }
        
        // print the score
            $quizResult .= "<div id='score'><h2>Score:</h2><p>Your score is <strong>" . $score;
            $quizResult .= "</strong> out of <strong>" . count($questions) . "</strong>.</p></div>";
            $quizResult .= "</div>";
            
        // print the result
            echo $quizResult;
        ?>
    </body>
</html>
