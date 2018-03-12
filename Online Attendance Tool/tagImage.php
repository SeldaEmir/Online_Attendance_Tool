<?php
include( 'config.php' );
require_once "./connection.php";
include_once 'gpConfig.php';
include_once 'header.php';

$user=$_SESSION['userData']['email'];
echo $user;
?>
<!doctype html>
<html>
<head>

  <meta charset="utf-8">
  <title>Tag Student</title>

  <script src="tracking/build/tracking-min.js"></script>
  <script src="tracking/build/data/face-min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 

  <style>


  #photo:hover .rect {
    opacity: .75;
    transition: opacity .75s ease-out;
  }

  .rect:hover * {
    opacity: 1;
  }

  .rect {
    border-radius: 2px;
    border: 3px solid white;
    box-shadow: 0 16px 28px 0 rgba(0, 0, 0, 0.3);
    cursor: pointer;
    left: -1000px;
    opacity: 0;
    position: absolute;
    top: -1000px;
  }

  .arrow {
    border-bottom: 10px solid white;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    height: 0;
    width: 0;
    position: absolute;
    left: 50%;
    margin-left: -5px;
    bottom: -12px;
    opacity: 0;
  }

  input {
    border: 0px;
    bottom: -42px;
    color: #a64ceb;
    font-size: 15px;
    height: 30px;
    left: 50%;
    margin-left: -90px;
    opacity: 0;
    outline: none;
    position: absolute;
    text-align: center;
    width: 180px;
    transition: opacity .35s ease-out;
  }

  #img {
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -173px 0 0 -300px;
  }
  </style>
</head>
<body>

  <?php
	$ccode = $_GET['ccode']; 
	$code = $_GET['code']; 
	//echo $code;
  ?>
  <div class="demo-frame">
    <div class="demo-container">
      <span id="photo"><img id="img" src= <?php echo "images1/".$code."/".$ccode ?> /></span>
    </div>
  </div>

  

  <script>
    function tagStudent(id){
    	//alert(id);
    	jQuery.ajax({
		        url: 'saveTag.php?user=<?php echo $user?>&id='+id+'&code=<?php echo $code?>&image=<?php echo $ccode?>',
		        success: function (result) {

		        	alert(result);
		        	location.reload();
	        	},
	        async: false
	    });
    }

    window.onload = function() {
      var img = document.getElementById('img');

      var tracker = new tracking.ObjectTracker('face');

      tracking.track(img, tracker);

      tracker.on('track', function(event) {
      	var taggedFaces = "";
      	jQuery.ajax({
		        url: 'getTagged.php?code=<?php echo $code?>&image=<?php echo $ccode?>',
		        success: function (result) {
		        	taggedFaces = result;
		        	//alert(result);
	        	},
	        async: false
	    });

        event.data.forEach(function(rect) {
          plotRectangle(rect.x, rect.y, rect.width, rect.height, taggedFaces);
        });
      });

      //var friends = [ 'Thomas Middleditch', 'Martin Starr', 'Zach Woods' ];

      var plotRectangle = function(x, y, w, h, taggedFaces) {
        var rect = document.createElement('div');
        var arrow = document.createElement('div');
        var input = document.createElement('input');

        //input.value = friends.pop();

        rect.onclick = function name(asd) {
        	tagStudent(rect.id);
            input.select();
        };

        arrow.classList.add('arrow');
        rect.classList.add('rect');

        rect.appendChild(input);
        rect.appendChild(arrow);
        document.getElementById('photo').appendChild(rect);

        rect.style.width = w + 'px';
        rect.style.height = h + 'px';
        rect.style.left = (img.offsetLeft + x) + 'px';
        rect.style.top = (img.offsetTop + y) + 'px';
        rect.id = x.toString()+y.toString()+w.toString()+h.toString();
        var i = 1;
        JSON.parse(taggedFaces).forEach(function(tagData) {
        	if(rect.id == tagData.tagPosId){
        		input.value = tagData.taggedStudent;
            var table = document.getElementById("taggedStudents");
            var row = table.insertRow(i);
            var cell1 = row.insertCell(0);
            cell1.innerHTML = tagData.taggedStudent;
            i++;
        	}
        });
      };
    };
  </script>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<table class="table-fill" id="taggedStudents">
<thead>
<tr>
<th class="text-left">Tagged Students</th>
</tr>
</thead>
<tbody class="table-hover">
</tbody>
</table>

</body>
</html>












