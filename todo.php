<?php

// Create array to hold list of todo items
$items = array();

function listItems($list){
    $string = '';
    foreach ($list as $key => $items) {
        $key++;
        $string .= "[{$key}] {$items}\n";
    }
        return $string;
}

function getInput($lower = false){

    if($lower) {
        return strtolower(trim(fgets(STDIN)));
    } else {
        return trim(fgets(STDIN));
    }

}


// The loop!
do {
    // Echo the list produced by the function
     echo listItems($items);


    // Show the menu options
    echo '(N)ew item, (R)emove item, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = getInput(true);

    // Check for actionable input
    if ($input == 'n') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = getInput();
    } elseif ($input == 'r') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = getInput();
        // Remove from array
        $key--;
        unset($items[$key]);
    }
// Exit when input is (Q)uit
} while ($input != 'q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);