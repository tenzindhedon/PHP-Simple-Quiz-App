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
            $quiz = $_SESSION['quiz'];
            echo "<h1>Result:</h1>";
            $questions = $quiz["questions"];
            for($i=0;$i<count($questions);$i++){
                if ($_POST["answer$i"]==null) {
                    header("location:errorPage.php");
                } 
            }
            
            $quizResult = "<div>";
            $count = 1;
            $score = 0; 
            
            for($i=0; $i<count($questions); $i++){
                $quizResult .= "<div class='questionBox'>";
                $quizResult .= "<h2>Question " .  $count++ . "</h2>"; 
                $quizResult .= "<p>" . $questions[$i]['questionText'] . "</p>";
                 for($c=0; $c<count($questions[$i]["choices"]); $c++){
                        $quizResult .= "<input type='radio' disabled>" . $questions[$i]["choices"][$c] . "<br>";
                    }
                    $correctAnswer = $questions[$i]["choices"][$questions[$i]["answer"]];
                    
                    if($_POST["answer$i"] == $correctAnswer){
                        $quizResult .= "<p class='correct'>Your answer: " . $_POST["answer$i"] . " (correct)</p>";
                        $score++;
                    }else{
                        $quizResult .= "<p class='incorrect'>Your answer: " . $_POST["answer$i"] . " (incorrect)</p>";
                        $quizResult .= "<p>Correct answer: " . $correctAnswer;
                    }
                $quizResult .= "</div>";
            }
        
            $quizResult .= "<div id='score'><h2>Score:</h2><p>Your score is <strong>" . $score;
            $quizResult .= "</strong> out of <strong>" . count($questions) . "</strong>.</p></div>";
            $quizResult .= "</div>";

            echo $quizResult;
        ?>
    </body>
</html>
