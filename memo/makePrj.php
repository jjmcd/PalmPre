<?php
  include('functions.inc');
  openHTML("To-Do List","ToDo");
  $db = openDatabase('myToDo');

  $starttime = strftime("%Y-%m-%d");

  // If category passed in display only that category
  if ( isset($_GET['category']) )
    {
      $category=$_GET['category'];
      $SelectCat = " AND `category`=" . $category;
    }
  else
    $SelectCat = "";

  echo "<p></p>\n";
  echo "<pre>\n";

  echo "project todo \"WB8RCR To-Do List\" \"1.0\" 2010-06-01 - 2010-12-31 {\n";
  echo "  # Hide the clock time. Only show the date.\n";
  echo "  timeformat \"%Y-%m-%d\"\n";
  echo "  # The currency for all money values is EUR.\n";
  echo "  currency \"USD\"\n";
  echo "\n";
  echo "  # We want to compare the baseline scenario, to one with a slightly\n";
  echo "  # delayed start.\n";
  echo "  scenario plan \"Plan\" {\n";
  echo "    scenario delayed \"Delayed\"\n";
  echo "  }\n";
  echo "}\n";
  echo "\nflags team\n\n";

  echo "account costs \"Costs\" cost\n";
  echo "account rev \"Payments\" revenue\n";
  echo "account Fedora \"Fedora\" cost\n";
  echo "account Sys \"System\" cost\n";
  echo "account ARES \"ARES/RACES\" cost\n";
  echo "account Rad \"Radio\" cost\n";
  echo "account Biz \"Business\" cost\n";
  echo "account Pers \"Personal\" cost\n";
 echo "\n";
 echo "rate 300.0\n";
 echo "\n";
 echo "# Put your resource definitions here:\n";
 echo "resource dev \"Developers\" {\n";
 echo "   resource me \"John J. McDonough\"\n";
 echo " }\n";
 echo "# This resource does not do any work.\n";
 echo "resource confRoom \"Conference Room\" {\n";
 echo "   efficiency 0.0\n";
 echo " }\n";
 echo "\n";
 echo "task myProject \"My Project\" {\n";
 echo "  start 2010-06-01\n";
 echo "\n";
 echo "  # All work related costs will be booked to this account unless the\n";
 echo "  # sub tasks specifies it differently.\n";
 echo "  account costs\n";
 echo "\n";

  $q1 = "SELECT A.priority,A.due,A.short_desc,B.color,A.item_id,A.hours,A.predecessor,B.shortname,A.percent" .
    " FROM `todo_items` A, categories B" .
    " WHERE A.category = B.cat_id" .
    //" AND `percent`<100 " . 
    $SelectCat . 
    " ORDER BY `due`,`priority`,`hours` DESC" .
    " LIMIT 0,56";
  $result = getResult($q1,$db);
  while ( $myrow = mysql_fetch_row($result) )
    {
      echo "  task t" . $myrow[4] . " \"" . $myrow[2] . "\" { \n";
      echo "      effort " . $myrow[5] . "h\n";
      if ( $myrow[6] > 0 )
	echo "      depends !t" . $myrow[6] . "\n";
      echo "      account " . $myrow[7] . "\n";
      echo "      complete " . $myrow[8] . "\n";
      echo "      allocate me\n";
      echo "      scheduling alap\n";
      echo "      end " . $myrow[1] . "\n";
      echo "      priority " . (int)(1000/$myrow[0]) . "\n";
      echo "  }\n\n";
    }
  echo "}\n";
?>

# Bookings should be put here
# supplement resource dev1 {
#   This is the work that has been done up until now by dev1.
#   booking myProject.a 2003-06-06 - 2003-06-07 { sloppy 2 }
#   booking myProject.a 2003-06-08 - 2003-06-09 { sloppy 2 }
#   booking myProject.a 2003-06-11 - 2003-06-12 { sloppy 2 }
# }

# A traditional Gantt Chart for the TaskJugglerUI
taskreport "Gantt Chart" {
  headline "Project Gantt Chart"
  columns hierarchindex, name, start, end, effort, duration, chart
  # For this report we like to have the abbreviated weekday in front
  # of the date. %a is the tag for this.
  timeformat "%a %Y-%m-%d"
  loadunit days
  hideresource 1
}

# A list of tasks showing the resources assigned to each task.
taskreport "Task Usage" {
  headline "Task Usage Report"
  columns hierarchindex, name, start, end, effort { title "Work" }, duration,
          cost, revenue
  timeformat "%Y-%m-%d"
  loadunit days
  hideresource 0
}

# A list of all tasks with the percentage complete for each task
taskreport "Tracking Gantt" {
  headline "Tracking Gantt Chart"
  columns hierarchindex, name, start, end, effort { title "Work" }, duration,
          completed, chart
  timeformat "%a %Y-%m-%d"
  loadunit days
  hideresource 1
}

# A graph showing resource allocation. It identifies whether each
# resource is under- or over-allocated for.
resourcereport "Resource Graph" {
  headline "Resource Allocation Graph"
  columns no, name, rate, utilization, freeload, chart
  loadunit days
  hidetask 1
}

# A list of all project resources, both human and material resources,
# together with the costs for each.
resourcereport "Resource Sheet" {
  headline "Resource Sheet"
  columns no, name, efficiency, id, maxeffort, rate
  loadunit days
  hidetask 1
}

# A list of resources and each task associated with each resource.
resourcereport "Resource Usage" {
  headline "Resource Usage Report"
  columns no, name, utilization, freeload, cost
  loadunit days
  hidetask 0
}

# This report looks like a regular calendar that shows the tasks by
# their dates.
htmlweeklycalendar "Calendar.html" {
}

# This report is a status report for the current week. It also
# provides an outlook for the next week.
htmlstatusreport "Status-Report.html" {
}

# A P&L report for the project.
htmlaccountreport "Accounting.html" {
  # Besides the number of the account and the name we have a column
  # with the total values (at the end of the project) and the values
  # for each month of the project.
  columns no, name, scenario, total, monthly
  headline "P&L for the Project"
  caption "The table shows the profit and loss
           analysis as well as the cashflow situation of the Accounting
           Software Project."
  # Since this is a cashflow calculation we show accumulated values
  # per account.
  accumulate
  scenarios plan, delayed
}
<?php
  echo "</pre>\n";
  echo "</p>\n";
?>
</div>
</body>
</html>
