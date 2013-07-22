<?
include_once("include_generic/sqllib.inc.php");
include_once("include_pouet/pouet-box.php");
include_once("include_pouet/pouet-prod.php");

class PouetBoxTopGlops extends PouetBoxCachable {
  var $data;
  var $prods;
  function PouetBoxTopGlops() {
    parent::__construct();
    $this->uniqueID = "pouetbox_topglops";
    $this->title = "top of the glöps";
  }

  function LoadFromCachedData($data) {
    $this->data = unserialize($data);
  }

  function GetCacheableData() {
    return serialize($this->data);
  }

  function LoadFromDB() {
    $s = new BM_Query("users");
    $s->AddOrder("users.glops desc");
    $s->SetLimit(POUET_CACHE_MAX);
    $this->data = $s->perform();
  }

  function RenderBody() {
    echo "<ul class='boxlist'>\n";
    $n = 0;
    foreach($this->data as $p) {
      echo "<li>\n";
      echo $p->PrintLinkedAvatar()." ";
      echo "<span class='prod'>".$p->PrintLinkedName()."</span>\n";
      echo "<span class='group'>:: ".$p->glops." glöps</span>\n";
      echo "</li>\n";
      if (++$n == get_setting("indextopglops")) break;
    }
    echo "</ul>\n";
  }
  function RenderFooter() {
    echo "  <div class='foot'><a href='userlist.php'>more</a>...</div>\n";
    echo "</div>\n";
  }
};

?>