<form action="#" method="get">
    <div class="field has-addons has-addons-centered">
        <div class="select">
            <select name="month">
                <?php 
                //
                // select month
                //
                for ($x = 1; $x <= 12; $x++):
                ?>
                    <option value="<?php echo $x; ?>"> <?php echo date("F", mktime(0,0,0,$x,1)); ?> </option>
                <?php
                //
                endfor;
                ?>
            </select>
        </div>
        <div class="select">
            <select name="year">
                <?php
                    //
                    // select year
                    // 
                    for ($x = 2018; $x <= 2030; $x++):
                ?>
                <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                <?php
                    // 
                    endfor;
                ?>
            </select>
        </div>
        <input type="submit" class="button is-black">
    </div>
</forms>
<section class="section" id="welcome-hidden-desktop">
    <div class="container">
        <table class="table is-bordered is-striped is-fullwidth">
            <tr>
                <th colspan="7"><?php echo $month; ?> - <?php echo $year; ?></th>
            </tr>
            <tr>
                <?php 
                    $day = Calendar::showShortDays();
                    for ($x = 0 ; $x < 7 ; $x++) :
                        //
                        // echo for each day of the week
                        //
                ?>
                <th>
                    <?php 
                        // 
                        // print last S for sunday red
                        // 
                        echo (6 === $x) ? "<div class='has-text-danger'>" : null;
                        echo $day[$x];
                        echo (6 === $x) ? "</div>" : null;
                    ?>
                </th>
                <?php 
                    endfor;
                ?>
            </tr>
            <!-- end row for days -->
            <!-- start of the dates of the month -->
            <tr>
            <?php
                //
                // compute number of weeks to know where to end
                //
                for ($x = 0; $x < (Calendar::numberOfWeeks($month, $year)); $x++) :
                    //
                    // for each week in a month
                    //
                    for ($y = 0; $y < 7; $y++) :
                        //
                        // echo <td> regardless if there is a day or not for every day of the week
                        //
                        if ($y % 7 === 0) :
                            //
                            // after 7 days, create another line
                            //
            ?>
                        </tr>
                        <tr>
            <?php
                        // 
                        endif;
            ?>
                <td>
                <?php 
                    if ($counter2 >= $startDay && $date2 <= $endDate) :
                        //
                        // if counter is greater than or equal to the start day,
                        // and date is less than or equal to the end date,
                        // print
                        //
                        if (Output::getShifts($date2, $month, $year) && Output::getWorkplaces()) :
                            //
                            // prints only if shifts are available
                            // and if workplaces are saved
                            // 
            ?>
                    <a href="shiftmanage/details.php?date=<?php echo $date2;?>&month=<?php echo $month; ?>&year=<?php echo $year;?> " onclick="basicPopup(this.href);return false">
            <?php
                            //
                            // echo date with shifts with link to details
                            //
            ?>
                        <div class="has-text-danger">
            <?php 
                            echo $date2;
            ?>
                        </div>
                    </a>
            <?php
                        elseif (Output::getWorkplaces()) :
                            //
                            // if no shift for that day
                            //
            ?>
                    <a href="shiftmanage/addShift.php?date=<?php echo $date2;?>&month=<?php echo $month; ?>&year=<?php echo $year;?> " onclick="basicPopup(this.href);return false">
            <?php
                            //
                            // echo date without shift with link to add shift
                            //
                            echo $date2;
            ?>
                    </a>
            <?php
                        else:
                            // 
                            // if no shift, echo just the date, not inside an A tag
                            // 
                            echo $date2;
                            // 
                        endif;
                        //
                        // add date till last day
                        // 
                        $date2++;
                        //
                    endif;
                    //
                    // if counter is still not equal to start day, add more
                    // 
                    $counter2++;   
            ?>
                </td>
            <?php
                    endfor;
                endfor;
            ?>
            
            </tr>
        </table>
    </div>
</section>