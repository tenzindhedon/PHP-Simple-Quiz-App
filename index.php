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
        
        // get the json file
            $fileName = "WorldGeography.json";
            $fileContents = readFileIntoString($fileName);
            
        // copy quiz to global session variable
            $_SESSION['quiz'] = json_decode($fileContents, true);
        // convert the json file
            $quiz = json_decode($fileContents, true); // true = array
            
        // print the title of the quiz
            echo "<h1>" . $quiz["title"] . "</h1>";
        
        // store the questions in an array 
            $questions = $quiz["questions"];
        
        // store the form in a variable
            $quizForm = "<form action='results.php' method='post'>";
       
        // run a loop through the question arry to display the questions and its anwser options
            $count = 1; // for question numbering
            
            for($i=0; $i<count($questions); $i++){
                $quizForm .= "<div class='questionBox'>";
                // question number
                $quizForm .= "<h2>Question " .  $count++ . "</h2>"; 
                // question text
                $quizForm .= "<p>" . $questions[$i]['questionText'] . "</p>";
                // run a loop to print bulleted list of answers
                    
                    for($c=0; $c<count($questions[$i]["choices"]); $c++){
                        $quizForm .= "<input type='radio' name='answer$i' value='";
                        $quizForm .= $questions[$i]["choices"][$c] . "'>" . $questions[$i]["choices"][$c] . "<br>";
                    }
                $quizForm .= "</div>";
            }
        
            $quizForm .= "<input id='submit' type='submit' value='Submit'>";
            $quizForm .= "</form>";
            
        // print the form
            echo $quizForm;
        ?>
    </body>
</html>
