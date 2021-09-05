<?php

   // Insert the page header
   $page_title = 'Search Offers & Requests';
   require_once('header.php');
   require_once('connectvars.php');
   // Show the navigation menu
   require_once('navmenu.php');



    //End
/* Search */
      // This function builds a search query from the search keywords and sort setting
      function build_query($user_search, $sort) {
        $search_query = "SELECT * FROM resources";

        // Extract the search keywords into an array
        $clean_search = str_replace(',', ' ', $user_search);
        $search_words = explode(' ', $clean_search);
        $final_search_words = array();
        if (count($search_words) > 0) {
          foreach ($search_words as $word) {
            if (!empty($word)) {
              $final_search_words[] = $word;
            }
          }
        }

        // Generate a WHERE clause using all of the search keywords
        $where_list = array();
          //$where_list[] = "type = 'Requests'";//adddddddddddddddddddddddddddddddded in maybe not work""
        if (count($final_search_words) > 0) {

          foreach($final_search_words as $word) {

            $where_list[] = "description LIKE '%$word%'";
          }
        }
        $where_clause = implode(' OR ', $where_list);

        // Add the keyword WHERE clause to the search query
        if (!empty($where_clause)) {
          $search_query .= " WHERE $where_clause";
        //  $search_query .= " and WHERE type = 'Requests' ";
        }

        // Sort the search query using the sort setting
        switch ($sort) {
        // Ascending by resource title
        case 1:
          $search_query .= " ORDER BY title";
          break;
        // Descending by resource title
        case 2:
          $search_query .= " ORDER BY title DESC";
          break;
        // Ascending by contact_name
        case 3:
          $search_query .= " ORDER BY contact_name";
          break;
        // Descending by contact_name
        case 4:
          $search_query .= " ORDER BY contact_name DESC";
          break;
        // Ascending by date created (oldest first)
        case 5:
          $search_query .= " ORDER BY date_created";
          break;
        // Descending by date posted (newest first)
        case 6:
          $search_query .= " ORDER BY date_created DESC";
          break;
        default:
          // No sort setting provided, so don't sort the query
        }

        return $search_query;


      }

      // This function builds heading links based on the specified sort setting
      function generate_sort_links($user_search, $sort) {
        $sort_links = '';

        switch ($sort) {
        case 1:
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=2">Posting Title</a></th><th>Description</th>';
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Contact Name</a></th><th>Email</th>';
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=5">Date Posted</a></th>';
          break;
        case 3:
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Posting Title</a></th><th>Description</th>';
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=4">Contact Name</a></th><th>Email</th>';
          $sort_links .= '<th>><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Date Posted</a></th>';
          break;
        case 5:
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Posting Title</a></th><th>Description</th>';
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Contact Name</a></th><th>Email</th>';
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=6">Date Posted</a></th>';
          break;
        default:
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Posting Title</a></th><td>Description</th>';
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Contact Name</a></th><th>Email</th>';
          $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=5">Date Posted</a></th>';
        }

        return $sort_links;
      }

      // This function builds navigational page links based on the current page and the number of pages
      function generate_page_links($user_search, $sort, $cur_page, $num_pages) {
        $page_links = '';

        // If this page is not the first page, generate the "previous" link
        if ($cur_page > 1) {
          $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page - 1) . '"><-</a> ';
        }
        else {
          $page_links .= '<- ';
        }

        // Loop through the pages generating the page number links
        for ($i = 1; $i <= $num_pages; $i++) {
          if ($cur_page == $i) {
            $page_links .= ' ' . $i;
          }
          else {
            $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . $i . '"> ' . $i . '</a>';
          }
        }

        // If this page is not the last page, generate the "next" link
        if ($cur_page < $num_pages) {
          $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page + 1) . '">-></a>';
        }
        else {
          $page_links .= ' ->';
        }

        return $page_links;
      }



      ?>

         <h3>Search Offers & Requests</h3>
         <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">

           <input type="text" id="usersearch" name="usersearch" /><br />
           <input type="submit" name="submit" value="Submit" />
         </form>
      <?php





      // Grab the sort setting and search keywords from the URL using GET
    isset($_GET['sort']) ? $sort = $_GET['sort'] : $sort = '';


       isset($_GET['usersearch']) ? $user_search = $_GET['usersearch'] : $user_search = '';//testing this out

      // Calculate pagination information
      $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $results_per_page = 5;  // number of results per page
      $skip = (($cur_page - 1) * $results_per_page);

      // Start generating the table of results
      echo '<table class=”table-dark” id="requests">';

      // Generate the search result headings
      echo '<tr class="heading">';
      echo generate_sort_links($user_search, $sort);
      echo '</tr>';

      // Connect to the database
      require_once('connectvars.php');
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Query to get the total results
      $query = build_query($user_search, $sort);
      $result = mysqli_query($dbc, $query);
      $total = mysqli_num_rows($result);
      $num_pages = ceil($total / $results_per_page);
      //give user feedback if no results


      // Query again to get just the subset of results
      $query =  $query . " LIMIT $skip, $results_per_page";
      $result = mysqli_query($dbc, $query);
      while ($row = mysqli_fetch_array($result)) {
        echo '<tr class="results">';
        echo '<td valign="top">' . $row['title'] . '</td>';
        echo '<td valign="top">' . substr($row['description'], 0, 100) . '...</td>';
        echo '<td valign="top">' . $row['contact_name'] . '</td>';
        echo '<td valign="top">' . substr($row['email'], 0, 10) . '</td>';
        echo '<td valign="top">' . substr($row['date_created'], 0, 10) . '</td>';
        echo '</tr>';
      }
      echo '</table>';

      // Generate navigational page links if we have more than one page
      if ($num_pages > 1) {
        echo generate_page_links($user_search, $sort, $cur_page, $num_pages);
      }
       if (empty($row = mysqli_fetch_array($result)))
            {
              echo 'Sorry, there were no results for this search.';
            }

      mysqli_close($dbc);




        

   require_once('footer.php');
   ?>
