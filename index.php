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
        include 'ChromePhp.php';
        include 'FileUtils.php';
        
            $fileName = "WorldGeography.json";
            $fileContents = readFileIntoString($fileName);
            
            $_SESSION['quiz'] = json_decode($fileContents, true);
            $quiz = json_decode($fileContents, true); 
            echo "<h1>" . $quiz["title"] . "</h1>";
            $questions = $quiz["questions"];
            $quizForm = "<form action='results.php' method='post'>";
            $count = 1; 
            
            for($i=0; $i<count($questions); $i++){
                $quizForm .= "<div class='questionBox'>";
                $quizForm .= "<h2>Question " .  $count++ . "</h2>"; 
                $quizForm .= "<p>" . $questions[$i]['questionText'] . "</p>";
                    for($c=0; $c<count($questions[$i]["choices"]); $c++){
                        $quizForm .= "<input type='radio' name='answer$i' value='";
                        $quizForm .= $questions[$i]["choices"][$c] . "'>" . $questions[$i]["choices"][$c] . "<br>";
                    }
                $quizForm .= "</div>";
            }
        
            $quizForm .= "<input id='submit' type='submit' value='Submit'>";
            $quizForm .= "</form>";
            
            echo $quizForm;
        ?>
    </body>
</html>
