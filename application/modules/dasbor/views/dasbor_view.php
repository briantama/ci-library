<!-- content-->
    <div id="notif-msg" class="shownotifmsg"></div><!-- show notif crud -->
    <div id="load-content"></div><!--load content-->
    <div id="body-ctntl"><!--load content-->

<?php 

  // echo $param;
  //  echo json_encode($param);

  if($pages != "" && $func != ""){
  	$url   = $pages;
  	$param = $func;
  }
  else{
  	$url   = "dasbor";
  	$param = "dasbor_page";
  }

  ?>

  <script type="text/javascript">
  $(document).ready(function(){ callpage(<?php echo json_encode($url); ?>+"/"+<?php echo json_encode($param) ;?>,"","li-dashboard"); });
  console.log(<?php echo json_encode($url); ?>+"/"+<?php echo json_encode($param) ;?>);
</script>