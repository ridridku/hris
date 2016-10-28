<?php 
/************************************************************************************** 
* Class: Pager 
* Author: Tsigo <tsigo@tsiris.com> 
* Methods: 
*         findStart 
*         findPages 
*         pageList 
*         nextPrev 
* Redistribute as you see fit. 
**************************************************************************************/ 
class Pager 
  { 
  /*********************************************************************************** 
   * int findStart (int limit) 
   * Returns the start offset based on $_GET['page'] and $limit 
   ***********************************************************************************/ 
   function findStartGet($limit) { // limit diisi 10
		if ((!isset($_GET['page'])) || ($_GET['page'] == "1")) 
		  { 
		   $start = 0; 
		   $_GET['page'] = 1; 
		  } 
		 else 
		  { // jika $page= 3 
		   $start = ($_GET['page']-1) * $limit; // maka $start= 20
		  }
			
		 return $start; 
   }
	
	function findStartPost($limit) // limit diisi 10
    { 
	
	if ((!isset($_POST['page'])) || ($_POST['page'] == "1")) 
      { 
       $start = 0; 
       $_POST['page'] = 1; 
      } 
     else 
      { // jika $page= 3
       $start = ($_POST['page']-1) * $limit; // maka $start= 20
      }
	  	
     return $start; 
    }

  /*********************************************************************************** 
   * int findPages (int count, int limit) 
   * Returns the number of pages needed based on a count and a limit 
   ***********************************************************************************/ 
   function findPages($count, $limit) // count diisi 50 dan limit diisi 10
    { 
     $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1; // maka $pages= 5

     return $pages; 
    } 
  /*********************************************************************************** 
   * string pageList (int curpage, int pages) 
   * Returns a list of pages in the format of "« < [pages] > »" 
   ***********************************************************************************/ 
   function pageList($curpage, $pages) // curpage diisi 2 dan pages diisi 5
    { 
     $page_list  = ""; 

     /* Print the first and previous page links if necessary */ 
     if (($curpage != 1) && ($curpage)) 
      { // awal dari curpage adalah 0
       $page_list .= "  <a href=\"".$_SERVER['PHP_SELF']."?page=1\" alt=\"Halaman pertama ...\">«</a> "; 
      } 

     if (($curpage-1) > 0) 
      { 
       $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage-1)."\" alt=\"Halaman sebelumnya ...\"><</a> "; 
      } 

     /* Print the numeric page list; make the current page unlinked and bold */ 
     for ($i=1; $i<=$pages; $i++) // pages diisi 5
      { 
       if ($i == $curpage) 
        { 
         $page_list .= "<b>".$i."</b>"; 
        } 
       else 
        { 
         $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\" alt=\"Halaman ".$i."\">".$i."</a>"; 
        } 
       $page_list .= " "; 
      } 

     /* Print the Next and Last page links if necessary */ 
     if (($curpage+1) <= $pages) 
      { 
       $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage+1)."\" alt=\"Halaman berikutnya ...\">></a> "; 
      } 

     if (($curpage != $pages) && ($pages != 0)) 
      { 
       $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".$pages."\" alt=\"Halaman terakhir ...\">»</a> "; 
      } 
     $page_list .= "</td>\n"; 

     return $page_list; 
    } 
  /*********************************************************************************** 
   * string nextPrev (int curpage, int pages) 
   * Returns "Previous | Next" string for individual pagination (it's a word!) 
   ***********************************************************************************/ 
   function nextPrev($curpage, $pages) 
    { 
     $next_prev  = ""; 

     if (($curpage-1) <= 0) 
      { 
       $next_prev .= "Previous"; 
      } 
     else 
      { 
       $next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage-1)."\" alt=\"Halaman sebelumnya ...\">Previous</a>"; 
      } 

     $next_prev .= " | "; 

     if (($curpage+1) > $pages) 
      { 
       $next_prev .= "Next"; 
      } 
     else 
      { 
       $next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage+1)."\" alt=\"Halaman berikut ...\">Next</a>"; 
      } 

     return $next_prev; 
    } 
   

  
//-----------
 function nextPrevCustom($curpage, $pages, $str_completer) 
    { 
     global $HREF_IMAGES;
	 $next_prev  = ""; 

     if (($curpage-1) <= 0) 
      { 
       $next_prev .= "<img src=\"".$HREF_IMAGES."/icon/arrow_prev2.png\" title=\"Halaman awal...\" align=\"absmiddle\" border=\"0\" class=\"pngfix\">  "; 
      } 
     else 
      { 
       $next_prev .= "<img src=\"".$HREF_IMAGES."/icon/arrow_prev.png\" title=\"Halaman sebelumnya...\" align=\"absmiddle\" border=\"0\" onClick=\"doNavigateContentOver('".$_SERVER['PHP_SELF']."?page=".($curpage-1)."&".$str_completer."','mainFrame');\" class=\"link\"> "; 
      } 
     $next_prev .= "Page <INPUT class=\"pager\" TYPE=\"text\" NAME=\"page\" size=\"".strlen($pages)."\" maxlength=\"".strlen($pages)."\" value=".$curpage." onKeyUp=\"checkPages(".$pages.",".$curpage.");\"><noscript><input type=\"submit\" value=\"Go\"/></noscript> of ".$pages; 
	 if (($curpage+1) > $pages) 
      { 
       $next_prev .= "  <img src=\"".$HREF_IMAGES."/icon/arrow_next2.png\" title=\"Halaman terakhir...\" align=\"absmiddle\" border=\"0\" class=\"pngfix\">"; 
      } 
     else 
      { 
       $next_prev .= " <img src=\"".$HREF_IMAGES."/icon/arrow_next2.png\" title=\"Halaman selanjutnya...\" align=\"absmiddle\" border=\"0\" onClick=\"doNavigateContentOver('".$_SERVER['PHP_SELF']."?page=".($curpage+1)."&".$str_completer."','mainFrame');\" class=\"link\">"; 
      } 

     return $next_prev; 
    } 
  
//-----------
	function deBugger(){
		echo "<HR>";
		echo "<CENTER>";
		echo "<form method=\"post\" action=\"$_SERVER[PHP_SELF]\">";
		echo "Sql Debug Mode : "; 
		echo "<select name=\"DBG\">";
		echo "<option value=\"true\">On</option>";
		echo "<option value=\"false\">Off</option>";
		echo "</select>";
		echo "&nbsp;&nbsp;";
		echo "<input type=\"submit\" value=\"Go\">";
		echo "</form>";
		echo "</CENTER>";
		echo "<HR>";
	}

}
//Example on how to use: 


 
/* Instantiate class */ 
//require_once("class.pager.php"); 
//$p = new Pager; 

/* Show many results per page? */ 
//$limit = 100; 

/* Find the start depending on $_GET['page'] (declared if it's null) */ 
//$start = $p->findStart($limit); 

/* Find the number of rows returned from a query; Note: Do NOT use a LIMIT clause in this query */ 
//$count = mysql_num_rows(mysql_query("SELECT field FROM table")); 

/* Find the number of pages based on $count and $limit */ 
//$pages = $p->findPages($count, $limit); 

/* Now we use the LIMIT clause to grab a range of rows */ 
//$result = mysql_query("SELECT * FROM table LIMIT ".$start.", ".$limit); 

/* Now get the page list and echo it */ 
//$pagelist = $p->pageList($_GET['page'], $pages); 
//echo $pagelist; 

/* Or you can use a simple "Previous | Next" listing if you don't want the numeric page listing */ 
//$next_prev = $p->nextPrev($_GET['page'], $pages); 
//echo $next_prev; 

/* From here you can do whatever you want with the data from the $result link. */ 

?> 
