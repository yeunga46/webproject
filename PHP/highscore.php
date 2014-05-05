<!-- All of the html for the highscore page.  Uses php to display tables of highscores
Authors: Jason Fiduk and Andy Yeung-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
        <head>
                <title>HW2 Page</title>
                <meta charset="utf-8" />
                <meta name="Author" content="Andy Yeung and Jason Fiduk" />
                <meta name="generator" content="pico" />

                <!-- Be sure mobile devices don't try to scale up. -->
                <meta name="viewport" content="width=device-width" />
                <meta name="viewport" content="initial-scale=1.0" />

                
                <link rel="shortcut icon" href="/~yeunga46/images/tardis.png" />
                <!--Link to Jquery, used in navbar -->
                <script type="text/javascript"
                src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
                <!--Link to the stylesheet for the highscore page -->
                <link rel="stylesheet" type="text/css" href="highscore.css">
        </head>

        <body>

                <div id = "container" >
                        <h1>High-Score</h1>
                      <!--Contains all the possible categories as clickable buttons. Shows and hides db tables -->
                        <table id="navbar">
                                <tr>
                                        <td><a onmousedown="$('.records').hide(); $(longtimetable).show();" > Longest Time</a></td>
                                        <td><a onmousedown="$('.records').hide(); $(shorttimetable).show();"> Shortest Time</a></td>
                                        <td><a onmousedown="$('.records').hide(); $(correcttable).show();"> Most Correct</a></td>
                                        <td><a onmousedown="$('.records').hide(); $(longcorrecttable).show();" > Longest Time and Most Correct</a></td>
                                        <td><a onmousedown="$('.records').hide(); $(shortcorrecttable).show();"> Fastest Average with Most Correct</a></td>
                                </tr>
                        </table>
                        <div >
                                <table id="score">
                                        <tbody>
                                                <tr class="panelheader">
                                                        <th colspan="4">Top Members</th>
                                                </tr>
                                                <tr class="panelsubheader">
                                                        <td>Rank</td><td>Member</td><td>Points</td><td id = "atime">Time</td>
                                                </tr>
                        </tbody>        </table>
                                <?php

                                // access information in directory with no web access
                                require_once ('/export/home/fidukj40/source_html/web/webProject/Connect.php');

                                // other functions are right here
                                require_once ('DBfuncs.php');

                                $dbh = ConnectDB();
                                //Longest time table*****************
                                $recordlist = ListLongest($dbh);
                                echo "<table class='records' id='longtimetable'>";
                                echo "<tbody>";

                                $counter = 0;

                                foreach ($recordlist as $number) {
                                        $counter++;
                                        echo "<tr class='panelsubheader'>";
                                        echo "<td>";
                                        echo $counter;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> name;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> num_correct;
                                        echo "</td>";
                                        echo "<td>";
                                        echo gmdate("H:i:s",$number -> total_time);
                                        echo "</td>";
                                        echo "</tr>\n";
                                }
                                echo "</tbody></table>";
                                //Shortest time table*************************
                                $recordlist = ListShortest($dbh);
                                echo "<table style='display:none;' class = 'records' id='shorttimetable'>";
                                echo "<tbody>";

                                $counter = 0;

                                foreach ($recordlist as $number) {
                                        $counter++;
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $counter;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> name;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> num_correct;
                                        echo "</td>";
                                        echo "<td>";
                                        echo gmdate("H:i:s",$number -> total_time);
                                        echo "</td>";
                                        echo "</tr>\n";
                                }
                                echo "</tbody></table>";
                                //Most Correct table*********************************
                                $recordlist = ListMostCorrect($dbh);
                                echo "<table style='display:none;' class='records' id='correcttable'>";
                                echo "<tbody>";

                                $counter = 0;

                                foreach ($recordlist as $number) {
                                        $counter++;
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $counter;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> name;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> num_correct;
                                        echo "</td>";
                                        echo "<td>";
                                        echo gmdate("H:i:s",$number -> total_time);
                                        echo "</td>";
                                        echo "</tr>\n";
                                }
                                echo "</tbody></table>";
                                //Longest average time table*************************
                                $recordlist = ListLongestCorrect($dbh);
                                echo "<table class='records' style='display:none;' id='longcorrecttable'>";
                                echo "<tbody>";

                                $counter = 0;

                                foreach ($recordlist as $number) {
                                        $counter++;
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $counter;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> name;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> num_correct;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> average;
                                        echo "</td>";
                                        echo "</tr>\n";
                                }
                                echo "</tbody></table>";
                                //Shortest average time table**********************
                                $recordlist = ListShortestCorrect($dbh);
                                echo "<table style='display:none;' class='records' id='shortcorrecttable'>";
                                echo "<tbody>";

                                $counter = 0;

                                foreach ($recordlist as $number) {
                                        $counter++;
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $counter;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> name;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> num_correct;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $number -> average;
                                        echo "</td>";
                                        echo "</tr>\n";
                                }
                                echo "</tbody></table>";
                                
                                ?>

                        </div>
                </div>
              
        </body>
</html>
