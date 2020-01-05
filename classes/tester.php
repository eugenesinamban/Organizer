<pre>
    <?php 
        /////////////////////////////////////////////////
        //                                             //
        //            Testing area for methods         //
        //                                             //
        /////////////////////////////////////////////////
        // session_start();
        // require_once(__DIR__ . "/shift.php");
        // require_once(__DIR__ . "/Compute.php");
        // //
        // $post = ["email" => "eugene@sinamban.com", 'comment' => 'hello'];

        // Shift::insert($post);
        function reverseString(string $string) {
            // 
            // $reversed = "";
            $length = strlen($string) - 1;
            for ($x = $length ; $x >= 0 ; $x--) {
                // 
                $string .= $string[$x];
            }
            return $string;
        }
        //place this before any script you want to calculate time
$time_start = microtime(true); 

//sample script
echo reverseString("Eugene is the best guy ever") . "<br>";



$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes otherwise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
        
    ?>


</pre>
