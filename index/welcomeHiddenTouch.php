<form action="#" method="get">
    <div class="field has-addons has-addons-centered">
        <div class="select">
            <select name="month">
                <?php 
                // 
                //  select month
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
                    //  select year
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
<section class="section" id="welcome-hidden-touch">
    <div class="container">
        <table class="table is-bordered is-striped is-fullwidth">
            <tr>
                <th colspan="7"><?php echo $month; ?> - <?php echo $year; ?></th>
            </tr>
            <tr>
            <?php 
                // 
                foreach (Calendar::showDays() as $day) :
            ?>
                <th>
            <?php
                    // 
                    //  show days of the week
                    // 
                    echo $day;
            ?>
                </th>
            <?php
                //  
                endforeach;
            ?>
            </tr>
            <!-- end row of names of the day -->
            <!-- start of the dates of the month -->
            <tr>
            <?php
                // 
                //  compute number of weeks to know where to end
                // 
                for ($x = 0; $x < (Calendar::numberOfWeeks($month, $year)); $x++) :
                    // 
                    //  for each week in a month
                    // 
                    for ($y = 0; $y < 7; $y++) :
                        // 
                        //  echo <td> regardless if there is a day or not for every day of the week
                        // 
                        if ($y % 7 === 0) :
                            // 
                            //  after 7 days, create another line
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
                    if ($counter1 >= $startDay && $date1 <= $endDate) :
                        //  
                        //  if counter is over than or equal to the start day,
                        //  and date is less than or equal to the end date,
                        //  print
                        //   
                        if (Output::getShifts($date1, $month, $year) && Output::getWorkplaces()) :
                            // 
                            //  prints only if shifts are available
                            // and if workplaces are saved
                            //  
            ?>
                    <a href="shiftmanage/details.php?date=<?php echo $date1;?>&month=<?php echo $month; ?>&year=<?php echo $year;?> " onclick="basicPopup(this.href);return false">
            <?php
                            //  
                            //  echo date with shifts with link to details
                            //  
                            echo $date1;
            ?>
                    <br>
            <?php       
                            if (3 < count(Output::getShifts($date1, $month, $year))):
                                //
                                // if there are three more entries, cut it to two
                                // 
                                $x = 0;
                                $shifts = Output::getShifts($date1, $month, $year);
                                while ($x != 2):
                                    //  
                                    if (strlen($shifts[$x]['workplace']) >= 10) :
                                        //  
                                        //  shortens name if it's too long
                                        //  
                                        echo htmlspecialchars(trim(substr($shifts[$x]['workplace'], 0, 7)), ENT_QUOTES) . "...";
                                    else :
                                        //  
                                        //  if it's not that long, show the whole name
                                        //  
                                        echo htmlspecialchars($shifts[$x]['workplace'], ENT_QUOTES);
                                    endif;
                                    ?>
                                    <br>
                                    <?php
                                    $x++;
                                    //  
                                endwhile;
                                $shiftCount = (count(Output::getShifts($date1, $month, $year))) - 2;
                                // 
                                // show total count of shifts minus 2
                                // 
                                echo "{$shiftCount} more...";
                            else:
                                foreach (Output::getShifts($date1, $month, $year) as $output) :
                                    // 
                                    //  shows the shifts for that day
                                    //  
                                    if (strlen($output['workplace']) >= 10) :
                                        // 
                                        //  shortens name if it's too long
                                        //  
                                        echo htmlspecialchars(trim(substr($output['workplace'], 0, 7)), ENT_QUOTES) . "...";
                                    else :
                                        // 
                                        //  if it's not that long, show the whole name
                                        //  
                                        echo htmlspecialchars($output['workplace'], ENT_QUOTES);
                                    endif;
                                    ?>
                                    <br>
                                    <?php
                                    //  
                                endforeach;
                                //  
                            endif; 
            ?>
                    </a>
            <?php
                        elseif (Output::getWorkplaces()) :
                            //
                            // if no shift for that day
                            // but with saved workplaces
                            // 
            ?>
                    <a href="shiftmanage/addShift.php?date=<?php echo $date1;?>&month=<?php echo $month; ?>&year=<?php echo $year;?> " onclick="basicPopup(this.href);return false">
            <?php
                            // 
                            //  echo date without shift with link to add shift
                            // 
                            echo $date1;
            ?>
                    </a>
            <?php
                        else:
                            // 
                            // if no workplaces, don't let them get to add shift
                            // 
                            echo $date1;
                            // 
                        endif;
                        // 
                        //  add date till last day
                        $date1++;
                        // 
                    endif;
                    // 
                    //  if counter is still not equal to start day, add more
                    // 
                    $counter1++;   
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