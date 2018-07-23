<?php

?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>

<h3>Longest Recurring Sequence</h3>
<h4>Input a sequence of integers, e.g. 155566667777888111</h4>
<input type="text" id="arrayInput"/>
<button onclick = "getLongestSequence()">Submit</button>

<h3>ASCII Triangle</h3>
<h4>Input the length of the triangle's base:</h4>
<input type="text" id="triangleBaseInput"/>
<button onclick = "drawTriangle()">Submit</button>

<h3>Bracket Validation</h3>
<h4>Input a sequence of brackets, e.g. {{[]}} or {()[]}</h4>
<input type="text" id="bracketInput"/>
<button onclick = "validateBrackets()">Submit</button>

<script type="text/javascript">
    // Init
    $(function()
    {
        console.log("Hello World!");
    });

    // Task 1
    function getLongestSequence()
    {
        var inputString = $("#arrayInput").val();

        // If there's any input
        if(inputString.length > 0)
        {
            var inputArray = inputString.split('');
            var prevInt    = null;
            var currentSeq = 0;
            var largestSeq = 0;
            var largestInt = 0;

            $.each(inputArray, function(key, value)
            {
                currentSeq++;
                largestInt = value;

                // Repeating integers
                if(prevInt == value)
                {
                    console.log("CURRENT INTEGER: " + value);
                    console.log("CURRENT SEQUENCE: " + currentSeq);
                    if(currentSeq > largestSeq)
                    {
                        largestSeq = currentSeq;
                        largestInt = value;
                    }
                }
                // Non-repeating integers
                else
                {
                    currentSeq = 1;
                }
                prevInt = value;
            });
            console.log("LONGEST SEQUENCE: " + largestSeq + ", INTEGER: " + largestInt);
        }
        else
            console.log("Input box empty");
    }

    // Task 2
    function drawTriangle()
    {
        var baseLength = parseInt($("#triangleBaseInput").val());
        var levels = [];
        var triangle = '\n';
        var spaces = '';
        var level = 0;

        while(baseLength > 0)
        {
            spaces = '';

            // Add leading spaces first
            for(var i = 0; i < level; i++)
            {
                spaces += ' ';
            }
            var levelStr = spaces;

            // Add asterisks
            for(var i = 0; i < baseLength; i++)
            {
                levelStr += '*';
            }
            // Add trailing spaces
            levelStr += spaces;
            levels.push(levelStr);
            baseLength -= 2;
            level++;
        }

        levels.reverse();

        levels.forEach(function(levelPrint)
        {
            triangle += levelPrint + '\n';
        });
        console.log(triangle);
    }

    // Task 3
    function validateBrackets()
    {
        if (isBalanced($("#bracketInput").val()))
            console.log("Balanced");
        else console.log("Not Balanced");
    }

    function isBalanced(bracketStr)
    {
        var brackets = bracketStr.split('');
        var prevBrackets = [];
        var balanced = true;

        // Iterate through all brackets in the input
        brackets.forEach( function(bracket)
        {
            // Check every closing bracket to see if it has a corresponding opening bracket encountered previously
            // If the two brackets matched, remove the saved bracket from memory, otherwise fail validation
            if (bracket == '}')
            {
                if(prevBrackets[prevBrackets.length - 1] == '{')
                    prevBrackets.splice(-1, 1);
                else
                    balanced = false;
            }
            else if (bracket == ']')
            {
                if(prevBrackets[prevBrackets.length - 1] == '[')
                    prevBrackets.splice(-1, 1);
                else
                    balanced = false;
            }
            else if (bracket == ')')
            {
                if(prevBrackets[prevBrackets.length - 1] == '(')
                    prevBrackets.splice(-1, 1);
                else
                    balanced = false;
            }

            // Save every encountered opening bracket to memory for later comparison
            else if(bracket == '{' || bracket == '[' || bracket == '(')
            {
                prevBrackets.push(bracket);
            }
        });

        // If any bracket has remained unclosed, not balanced
        if(prevBrackets.length > 0) balanced = false;
        return balanced;
    }
</script>