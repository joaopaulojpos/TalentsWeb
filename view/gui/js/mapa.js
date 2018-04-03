var geocoder;
var map;
var marker;
var lat;
var lng;

function initialize() {

	var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
	var options = {
		zoom: 5,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	map = new google.maps.Map(document.getElementById("mapa"), options);
	
	geocoder = new google.maps.Geocoder();
	
	marker = new google.maps.Marker({
		map: map,
		draggable: true,
	});
	
	marker.setPosition(latlng);
	
}



$(document).ready(function () {

	try{
		$('#loader').show();

		initialize();
		
		function carregarNoMapa(endereco) {
			geocoder.geocode({ 'address': endereco + ', Brasil', 'region': 'BR' }, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						var latitude = results[0].geometry.location.lat();
						var longitude = results[0].geometry.location.lng();
			
						$('#txtEndereco').val(results[0].formatted_address);
						$('#txtLatitude').val(latitude);
	                   	$('#txtLongitude').val(longitude);
			
						var location = new google.maps.LatLng(latitude, longitude);
						marker.setPosition(location);
						map.setCenter(location);
						map.setZoom(16);
					}
				}
			})
		}

		if (navigator.geolocation)
	    {
	    	navigator.geolocation.getCurrentPosition(showPosition);

	    }else{
	    	//alert("O seu navegador não suporta Geolocalização.");
	    	$('#loader').hide();
	    }

	    function showPosition(position){
			lat = position.coords.latitude; 
			lng = position.coords.longitude;

			$('#txtLatitude').val(lat);
	       	$('#txtLongitude').val(lng);

	       	$.ajax({      //Função AJAX
	        url:"carrega_endereco_latitude_longitude.php",      //Arquivo php
	        type:"post",        //Método de envio
	        data: "latitude="+lat+"&longitude="+lng, //Dados
	          success: function (result){     //Sucesso no AJAX
	               $('#txtEndereco').val(result);
	          }
	        });

			var location = new google.maps.LatLng(lat, lng);
			marker.setPosition(location);
			map.setCenter(location);
			map.setZoom(16);

			$('#loader').hide();
		}

		$("#btnEndereco").click(function() {
			if($(this).val() != "")
				carregarNoMapa($("#txtEndereco").val());
		})
		
		$("#txtEndereco").blur(function() {
			if($(this).val() != "")
				carregarNoMapa($(this).val());
		})
		
		google.maps.event.addListener(marker, 'drag', function () {
			geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {  
						$('#txtEndereco').val(results[0].formatted_address);
						$('#txtLatitude').val(marker.getPosition().lat());
						$('#txtLongitude').val(marker.getPosition().lng());
					}
				}
			});
		});
		
		$("#txtEndereco").autocomplete({
			source: function (request, response) {
				geocoder.geocode({ 'address': request.term + ', Brasil', 'region': 'BR' }, function (results, status) {
					response($.map(results, function (item) {
						return {
							label: item.formatted_address,
							value: item.formatted_address,
							latitude: item.geometry.location.lat(),
	          				longitude: item.geometry.location.lng()
						}
					}));
				})
			},
			select: function (event, ui) {
				$("#txtLatitude").val(ui.item.latitude);
	    		$("#txtLongitude").val(ui.item.longitude);
				var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
				marker.setPosition(location);
				map.setCenter(location);
				map.setZoom(16);
			}
		});
		
		/*$("form").submit(function(event) {
			event.preventDefault();
			
			var endereco = $("#txtEndereco").val();
			var latitude = $("#txtLatitude").val();
			var longitude = $("#txtLongitude").val();
			
			alert("Endereço: " + endereco + "\nLatitude: " + latitude + "\nLongitude: " + longitude);
		});*/
	}catch(err) {
    	//
	}finally{
		$('#loader').hide();
	}
});