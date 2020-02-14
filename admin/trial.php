<?php include_once 'headeradmin.php';

?>

<body>
	<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#home">Home</a></li>
  <li><a href="#profile">Profile</a></li>
  <li><a href="#messages">Messages</a></li>
  <li><a href="#settings">Settings</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="home">home</div>
  <div class="tab-pane" id="profile">profile</div>
  <div class="tab-pane" id="messages">messages</div>
  <div class="tab-pane" id="settings">settings</div>
</div>
</body>

<script type="text/javascript">
	$('#myTab a').click(function(e) {
  e.preventDefault();
  $(this).tab('show');
});

// store the currently selected tab in the hash value
$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
  var id = $(e.target).attr("href").substr(1);
  window.location.hash = id;
});

// on load of the page: switch to the currently selected tab
var hash = window.location.hash;
$('#myTab a[href="' + hash + '"]').tab('show');
</script>