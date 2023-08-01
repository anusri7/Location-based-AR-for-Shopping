<?php	
error_reporting(0);
		$conn = mysqli_connect("localhost", "root", "Qwerty123", "ar");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
        
$arr = array();
$res = $_REQUEST['res'];
$sql = "SELECT * FROM purchase";
if ($res = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($res) > 0) {
        
        while ($row = mysqli_fetch_array($res)) {
            $arr[] = $row;
           
        }
        mysqli_free_result($res);
    }
    else {
        echo "No matching records are found.";
    }
}		
		// Close connection
		mysqli_close($conn);
		?>
		</center>
<script>

    window.onload = () => {
     const button = document.querySelector('button[data-action="change"]');
     button.innerText = '﹖';
 	var res = <?= json_encode($arr) ?>;
     let places = staticLoadPlaces(JSON.stringify(res));
     renderPlaces(JSON.stringify(res));
 };
 
 function staticLoadPlaces(data) {
     return JSON.parse(data);
 }
 
var models = [
     {
         url: './assets/articuno/scene.gltf',
         scale: '120 120 120',
         info: 'Magnemite, Lv. 5, HP 10/10',
         rotation: '0 180 0',
     },
     {
         url: './assets/articuno/scene.gltf',
         scale: '120 120 120',
         rotation: '0 180 0',
         info: 'Articuno, Lv. 80, HP 100/100',
     },
     {
         url: './assets/dragonite/scene.gltf',
         scale: '120 120 120',
         rotation: '0 180 0',
         info: 'Dragonite, Lv. 99, HP 150/150',
     },
     {
         url: './assets/custom/repo.gltf',
         scale: '120 120 120',
         info: 'Magnemite 1, Lv. 5, HP 10/10',
         rotation: '0 180 0',
     },
     {
         url: './assets/articuno/scene.gltf',
         scale: '120 120 120',
         rotation: '0 180 0',
         info: 'Articuno 1, Lv. 80, HP 100/100',
     },
     {
         url: './assets/dragonite/scene.gltf',
         scale: '120 120 120',
         rotation: '0 180 0',
         info: 'Dragonite 1, Lv. 99, HP 150/150',
     },
     {
         url: './assets/dragonite/scene.gltf',
         scale: '120 120 120',
         rotation: '0 180 0',
         info: 'Dragonite 2, Lv. 99, HP 150/150',
     },
 ];
 
 var modelIndex = 0;
 var setModel = function (model, entity) {
     if (model.scale) {
         entity.setAttribute('scale', '0.001 0.001 0.001');
     }
 
     if (model.rotation) {
         entity.setAttribute('rotation', '0 180 0');
     }
 
     if (model.position) {
         entity.setAttribute('position', model.position);
     }
 
     entity.setAttribute('gltf-model', model.url);
 
     const div = document.querySelector('.instructions');
     div.innerText = model.info;
 };
 
 function renderPlaces(places) {
     let scene = document.querySelector('a-scene');
     places = JSON.parse(places);
     places.forEach((place) => {
        console.log(place.Latitude)
         let latitude = place.Latitude;
         let longitude = place.Longitude;
 
         let model = document.createElement('a-entity');
         model.setAttribute('gps-entity-place', `latitude: ${latitude}; longitude: ${longitude};`);
         model.setAttribute('scale', '2 2 2');
         model.setAttribute('rotation', '270 90 0');
         model.setAttribute('position', '0 3 0');
         model.setAttribute('gltf-model', './assets/custom/repo.gltf');
         model.setAttribute('id', place.Store_name);

        // setModel(models[modelIndex], model);
 
         model.setAttribute('animation-mixer', '');
 
        //  document.querySelector('button[data-action="change"]').addEventListener('click', function () {
            
        //      var entity = document.querySelector('[gps-entity-place]');
        //      modelIndex++;
        //      var newIndex = modelIndex % models.length;
        //      console.log('newIndex', newIndex)
        //      setModel(models[newIndex+1], entity);
        //  });
 
         scene.appendChild(model);
     });
 }
 


</script> 
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>GeoAR.js demo</title>
    <script src='https://aframe.io/releases/0.9.2/aframe.min.js'></script>
    <script src="https://raw.githack.com/jeromeetienne/AR.js/master/aframe/build/aframe-ar.min.js"></script>
    <script src="https://raw.githack.com/donmccurdy/aframe-extras/master/dist/aframe-extras.loaders.min.js"></script>
    <script>
        THREEx.ArToolkitContext.baseURL = 'https://raw.githack.com/jeromeetienne/ar.js/master/three.js/'
    </script>
    <!-- <script src="./script.js"></script> -->
    <link rel="stylesheet" type="text/css" href="./style.css"/>
</head>

<body style='margin: 0; overflow: hidden;'>
    <div class="centered instructions"></div>
    <a-scene 
        vr-mode-ui='enabled: false' 
        embedded
        arjs='sourceType: webcam; sourceWidth:1280; sourceHeight:960; displayWidth: 1280; displayHeight: 960; debugUIEnabled: false;'>
    <a-camera gps-camera rotation-reader></a-camera>
</a-scene>
<div class="centered">
    <button data-action="change"></button>
    <center>     
</div>
</body>
