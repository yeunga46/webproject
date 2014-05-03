<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
        <head>
                <title>HW2 Page</title>
                <meta charset="utf-8" />
                <meta name="Author" content="Andy Yeung" />
                <meta name="generator" content="pico" />

                <!-- Be sure mobile devices don't try to scale up. -->
                <meta name="viewport" content="width=device-width" />
                <meta name="viewport" content="initial-scale=1.0" />

                <!-- NOTE: Do not put "title" attribute unless there are
                alternate stylesheets! -->
                <link rel="shortcut icon" href="/~yeunga46/images/tardis.png" />
                <script type="text/javascript"
                src="http://code.jquery.com/jquery-1.9.0.min.js"></script>

                <link rel="stylesheet" type="text/css" href="highscore.css">
        </head>

        <body>

                <div id = "container" >
                        <h1>High-Score</h1>

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
                                                        <td>Rank</td><td>Member</td><td>Points</td><td>Time</td>
                                                </tr>
                        </tbody>        </table>
                                <?php

                                // access information in directory with no web access
                                require_once ('/export/home/fidukj40/source_html/web/webProject/Connect.php');

                                // other functions are right here
                                require_once ('DBfuncs.php');

                                $dbh = ConnectDB();
                                //longest time *****************
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
                                        echo $number -> total_time;
                                        echo "</td>";
                                        echo "</tr>\n";
                                }
                                echo "</tbody></table>";
                                //Shortest time *************************
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
                                        echo $number -> total_time;
                                        echo "</td>";
                                        echo "</tr>\n";
                                }
                                echo "</tbody></table>";
                                //Most Correct*********************************
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
                                        echo $number -> total_time;
                                        echo "</td>";
                                        echo "</tr>\n";
                                }
                                echo "</tbody></table>";
                                //Long time and correct*************************
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
                                //Fastest average and correct**********************
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

                                // uncomment next line for debugging
                                # echo '<pre>'; print_r($phonelist); echo '</pre>';
                                ?>

                        </div>
                </div>
                <footer>
                        <div id = "validation">
                                <table id="webline">
                                        <tr>
                                                <td><a href="http://elvis.rowan.edu/~yeunga46/web/"
                                                title="Link to web directory"> <img src="/~yeunga46/images/tardis.png" alt="" /> A. Yeung </a></td>

                                                <td style="word-spacing:1em;">Valid: <a href="http://validator.w3.org/check/referer">HTML5</a><a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3"> CSS3</a></td>
                                        </tr>
                                </table>
                        </div>
                </footer>
        </body>
</html>
