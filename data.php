<?php

$page_title = 'Climate Data For All Cities'; //Page title

include ('includes/header.html'); //Included the Header

echo '<h1>Climate Data For All Cities</h1>'; //H1 tag

require ('mysqli_connect.php'); //Connected to the database

$display = 15; //Limit the # of records per page

//If statement to calculate # of pages
if (isset($_GET['p']) && is_numeric($_GET['p']))
 {
  $pages = $_GET['p'];
 }
else
{
  $q = "SELECT COUNT(city_id) FROM city_stats"; //Utilizing city_id as COUNT
  $r = @mysqli_query ($dbc, $q);
  $row = @mysqli_fetch_array ($r, MYSQLI_NUM);
  $records = $row[0];
//If statement below to calculate # of pages
  if ($records > $display)
  {
    $pages = ceil ($records/$display);
  } else
  {
    $pages = 1;
  }
}

// If statement to figure out where in the results list the page should be right now
if (isset($_GET['s']) && is_numeric($_GET['s']))
{
	$start = $_GET['s'];
} else
{
	$start = 0;
}

// Setting default sort
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'ct';

// Use a switch-case to change sorting orders on the fly
switch ($sort)
{
	case 'st':
		$order_by = 'state ASC';
		break;
	case 'rh':
		$order_by = 'record_high ASC';
		break;
  case 'rl':
    $order_by = 'record_low ASC';
    break;
  case 'dc':
    $order_by = 'days_clear ASC';
    break;
  case 'dl':
    $order_by = 'days_cloudy ASC';
    break;
  case 'dp':
    $order_by = 'days_with_precip ASC';
    break;
  case 'ds':
    $order_by = 'days_with_snow ASC';
    break;
	case 'ct':
		$order_by = 'city ASC';
		break;
	default:
		$order_by = 'city ASC';
		$sort = 'ct';
		break;
}

//Primary query, essentialy responsible for populating the table
$q = "SELECT city, state, record_high, record_low, days_clear, days_cloudy, days_with_precip, days_with_snow FROM city_stats ORDER BY $order_by LIMIT $start, $display"; //Create query
$r = mysqli_query ($dbc, $q)or die(mysqli_error($dbc)); //Run query
$num = mysqli_num_rows($r);

// If statement to figure out how many cities are in the now populated table
if ($num > 0)
{
  $row = mysqli_fetch_array($r, MYSQLI_NUM);

// Print/echo statement to relay $ of cities in table
  echo "<p>There are $num cities in the table.</p>\n\n";

// Table header and styling for it
  echo '<table align="center" cellspacing="4" cellpadding="4" width="95%" style="border: 2px solid black";>
	<tr>
    <td align="left"><b><a href="data.php?sort=ct">City</b></td>
    <td align="left"><b><a href="data.php?sort=st">State</b></td>
    <td align="right"><b><a href="data.php?sort=rh">High</b></td>
    <td align="right"><b><a href="data.php?sort=rl">Low</b></td>
    <td align="right"><b><a href="data.php?sort=dc">Days Clear</b></td>
    <td align="right"><b><a href="data.php?sort=dl">Days Cloudy</b></td>
    <td align="right"><b><a href="data.php?sort=dp">Days With Precip</b></td>
    <td align="right"><b><a href="data.php?sort=ds">Days With Snow</b></td>
  </tr>';

// Printing the records for the table, bg is background color (which alternates using the ternary operator)
  $bg = '#99ff99';
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
  {
    $bg = ($bg=='#99ff99' ? '#80e5ff' : '#99ff99'); // <-- the ternary operator to alternate colors
    echo
    '<tr bgcolor="' . $bg . '">
      <td align="left">' . $row['city'] . '</td>
      <td align="left">' . $row['state'] . '</td>
      <td align="right">' . $row['record_high'] . '</td>
      <td align="right">' . $row['record_low'] . '</td>
      <td align="right">' . $row['days_clear'] . '</td>
      <td align="right">' . $row['days_cloudy'] . '</td>
      <td align="right">' . $row['days_with_precip'] . '</td>
      <td align="right">' . $row['days_with_snow'] . '</td>
    </tr>';
  }

echo '</table>'; //Closed the table

mysqli_free_result ($r); //Freed resources

}

else // In case the database is empty
{
  echo '<p class="error">There are currently no cities in the database.</p>';
}

mysqli_close($dbc); //Closed the database link

// Nested if structures to create numerical navigation buttons
if ($pages > 1)
{
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	if ($current_page != 1)
  // As long as we are not on page 1, there will be a previous button from this
  {
		echo '<a href="data.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
  // A for loop starting at 1 and incrementing by 1, for as long as the variable i is less than or equal to total # of pages
  // This for loop will create a click-able number button for each page, for easy nav
	for ($i = 1; $i <= $pages; $i++)
  {
		if ($i != $current_page)
    {
			echo '<a href="data.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		}
    else
    {
			echo $i . ' ';
		}
	}
	if ($current_page != $pages)
  // As long as we are not on the last page, there will be a next button from this
  {
		echo '<a href="data.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	echo '</p>';
}

include ('includes/footer.html'); //Included the footer
?>
