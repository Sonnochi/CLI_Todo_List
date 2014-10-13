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
// funtion to access "Sort" menu
function sort_menu($list){
    $input = getInput(true);
    switch ($input) {
        case 'a':
            asort($list);
            break;
        case 'z':
            arsort($list);
            break;
        case 'o':
            ksort($list);
            break;
        case 'r':
            krsort($list);
                break;
        case 'c':
            //Does nothing
                break;    
       }
       //Retruns back to list
    return $list;
}
function open() {
    echo "Please enter file name: ";
    $filename = trim(fgets(STDIN));
    $handle = fopen($filename, 'r');
    $contents = fread($handle, filesize($filename));
    $contentsArray = explode("\n", $contents);
    return $contentsArray;
    fclose($handle);
 }
function save($items){
    echo "Please enter a name for file: ";
    $filename = getInput();
    $handle = fopen($filename, 'w');

    foreach ($items as $item){
        fwrite($handle, $item . PHP_EOL);
    }
    fclose($handle);
}
// The loop!
do {
    // Echo the list produced by the function
     echo listItems($items);


    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort, (Op)en file, S(a)ve file, (Q)uit: ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = getInput(true);

    // Check for actionable input
    if ($input == 'n') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $newItem = getInput(true);
        echo "Would you like to add this item to the (B)eginning or the (E)nd?\n";

        $choice = getInput();
        if ($choice == 'b') {
            // do some code to add to the beginnig of the array
            array_unshift($items, $newItem);
        }
        elseif ($choice == 'e') {
            // do some code to add to the end of the array; our default.
            $items[] = $newItem;
        }
        

    } elseif ($input == 'r') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = getInput();
        // Remove from array
        $key--;
        unset($items[$key]);
    } elseif ($input == 's') {
        // Ask for user to input an option
        echo '(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered, (C)ancel:';
        //calls for "sort_menu() function"
        $items = sort_menu($items);
    } 
        elseif ($input == 'f') {
            array_shift($items);
        } 
        elseif ($input == 'l') {
            array_pop($items);
        }

    elseif ($input == 'op') {
        $file_Array = open();
        print_r(array_merge($items, $file_Array));
    }
    elseif ($input == 'a') {
        save($items);
        echo 'Save complete!' . PHP_EOL;
    }

// Exit when input is (Q)uit
} while ($input != 'q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);