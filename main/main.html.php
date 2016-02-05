<?php
require_once(ROOT_PATH . "includes/layouts/header.php");

if($view === "daily") {
    $heading = "$selectedMonthName $selectedDay, $selectedYear";
}
else if($view === "monthly") {
    $heading = "$selectedMonthName $selectedYear";
}
else if($view === "yearly") {
    $heading = $selectedYear;
}
else if($view === "allTime") {
    $heading = "All Time Data";
}

?>

<div id="wrapper">
    <?php 
        if(isset($heading)) {
            echo "<h2 id=\"mainHeading\">Selected Date: $heading</h2>";
        }
        if($view !== "allTime") {
    ?>
            <section id="datePicker">
            <?php
                // show a different date picker based on the view
                if($view === "daily") {
                    require_once("dailyDatePicker.html.php");
                }
                else if($view ==="monthly") {
                    require_once("monthlyDatePicker.html.php");
                }
                else if($view === "yearly") {
                    require_once("yearlyDatePicker.html.php");
                }
            ?>
            </section>
    <?php
        }
    ?>

    <section id="subViewSelector">
        <nav>
            <ul id="subViewNavigation">
                <li id="subViewHeading">Display:</li>
                <?php 
                    if($view === "daily") { ?>
                        <li><a href="?subView=info&month=<?php echo $selectedMonth; ?>&day=<?php echo $selectedDay; ?>&year=<?php echo $selectedYear; ?>" id="infoLink"<?php if($subView === "info") echo ' class="selectedSubView"'; ?>>View/Edit</a></li>
                        <li><a href="?subView=summary&month=<?php echo $selectedMonth; ?>&day=<?php echo $selectedDay; ?>&year=<?php echo $selectedYear; ?>" id="summaryLink"<?php if ($subView ==="summary") echo ' class="selectedSubView"'; ?>>Summary</a></li>
                <?php 
                    } 
                    else if($view ==="monthly") {
                ?>
                    <li><a href="?view=monthly&subView=info&month=<?php echo $selectedMonth; ?>&year=<?php echo $selectedYear; ?>" id="infoLink"<?php if($subView === "info") echo ' class="selectedSubView"'; ?>>Month</a></li>
                    <li><a href="?view=monthly&subView=summary&month=<?php echo $selectedMonth; ?>&year=<?php echo $selectedYear; ?>" id="summaryLink"<?php if($subView === "summary") echo ' class="selectedSubView"'; ?>>Summary</a></li>
                <?php
                    }
                    else if($view === "yearly") {
                ?>
                        <li><a href="?view=yearly&subView=info&year=<?php echo $selectedYear; ?>" id="infoLink"<?php if($subView === "info") echo ' class="selectedSubView"'; ?>>Year</a></li>
                        <li><a href="?view=yearly&subView=summary&year=<?php echo $selectedYear; ?>" id="summaryLink"<?php if($subView === "summary") echo ' class = "selectedSubView"'; ?>>Summary</a></li>
                <?php
                    }
                    else if($view === "allTime") {
                ?>
                        <li><a href="?view=allTime&subView=info" id="infoLink"<?php if($subView === "info") echo ' class="selectedSubView"'; ?>>All Time</a></li>
                        <li><a href="?view=allTime&subView=summary" id="summaryLink"<?php if($subView ==="summary") echo ' class="selectedSubView"'; ?>>Summary</a></li>
                <?php
                    }
                ?>
            </ul>
        </nav>
    </section>

    
    <section id="mainContent">
        <div id="mainContentLeft">
            <?php
                if($view === "daily" && $subView === "info") { 
                    require_once("dailyInfoView.html.php"); 
                }
                else if($view === "monthly" && $subView === "info") {
                    require_once("monthlyInfoView.html.php");
                }
                else if($view === "yearly" && $subView === "info") {
                    require_once("yearlyInfoView.html.php");
                }
                else if($view === "allTime" && $subView === "info") {
                    require_once("allTimeInfoView.html.php");
                }
                else if($subView === "summary") {
                    require_once("summaryView.html.php");
                } 
            ?>
        </div>
        <?php
            if($view !== "allTime") {
        ?>
        <div id="mainContentRight">
            <?php
                if($view === "daily") {
                    require_once("dailyCalendar.html.php");
                }
                else if($view === "monthly") {
                    require_once("monthlyCalendar.html.php");
                }
                else if($view === "yearly") {
                    require_once("yearlyCalendar.html.php");
                }
            ?>
        </div>
        <?php
            }
        ?>
 </section>
</div>

<script type="text/javascript" src="date.js"></script>
<?php
    if($view === "daily" && $subView === "info" && $canEdit === true) {
?>
<script type="text/javascript" src="addIncomeExpenseFields.js"></script>
<?php
    }
    if($subView === "summary") {
        require_once("summary.js.php");
?>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript" src="googleCharts.js"></script> 
<?php
    }
    if($view === "daily") {
?>
        <script type="text/javascript"> 
            var selectedMonth = <?php echo $selectedMonth; ?>;
            var selectedYear = <?php echo $selectedYear; ?>;
            var selectedDay = <?php echo $selectedDay; ?>;
        </script>
<?php
    }
    else if($view === "monthly") {
?>
        <script type="text/javascript">
            var selectedMonth = <?php echo $selectedMonth; ?>;
            var selectedYear = <?php echo $selectedYear; ?>;
            var selectedDay = false;
        </script>
<?php
    }
    else if($view === "yearly") {
?>
        <script type="text/javascript">
            var selectedMonth = false;
            var selectedDay = false;
            var selectedYear = <?php echo $selectedYear; ?>;
        </script>
<?php
    }
?>
<script type="text/javascript" src="calendar.js"></script>

<?php
require_once(ROOT_PATH . "includes/layouts/footer.php");
?>

