<?php
require_once("../../classes/Output.php");
require_once("../../classes/Compute.php");

// if year is null, show this year's figures 

$year = isset($_POST['year']) && is_numeric($_POST['year']) ? $_POST['year'] : date('Y');

// preapre variables for yearly figures

$yearlySalary = 0;
$yearlyHours = 0;
?>
<table class="table is-striped is-bordered is-fullwidth">
    <tr>
        <th>Month</th>
        <th>Monthly Total</th>
        <th>Total Hours</th>
    </tr>
    <?php 
    for ($x = 1 ; $x <=12 ; $x++) :
        
        // produce 12 rows for each month
        
    ?>
    <tr>
        <td>
            <a href="../index.php?month=<?php echo $x; ?>&year=<?php echo $year;?>">
                <?php
                
                // show month per row for first column
                
                echo date('F', mktime(0,0,0,$x)); 
                ?>
            </a>
        </td>
        <?php   
        if (Output::getSalary($x, $year)) :
            
            // if there is a shift for that month, show figures
            // prepare variables for monthly salary and hours
            
            $salary = 0;
            $monthlyHours = 0;
            foreach (Output::getSalary($x, $year) as $daily) {
                
                // multiply wage and total hours for that shift then add transportation allowance
                // add to prepared variable
                
                $totalHours = Compute::totalTime($daily);
                $salary += ($daily['wage'] * $totalHours) + $daily['transportation'];
                
                // add computed total hours into monthly totals
                
                $monthlyHours += $totalHours;
                
            }
        ?>
        <td>
            <?php
            
            // echo total salary for the month
            // add monthly salary to yearly total
            
            echo round($salary) . "円";
            $yearlySalary += $salary;
            ?>
        </td>
        <td>
            <?php               
            
            // echo total hours for the month
            // add monthly total hours to yearly total
            
            echo round($monthlyHours);   
            $yearlyHours += $monthlyHours;
            ?>
        </td>
        </tr>
        <?php 
        else :
            
            // if there's no shift, produce blank row with "0" figure
            // for both salary and hours
            
        ?>
        <td>0</td>
        <td>0</td>
        <?php
        endif;  
    endfor;
    ?>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td>
            Total:
        </td>
        <td>
            <?php 
            
            // echo total salary
            
            echo round($yearlySalary) . "円";
            ?>
        </td>
        <td>
            <?php
            
            // echo total hours for the year
            
            echo round($yearlyHours);
            ?>
        </td>
    </tr>
</table>