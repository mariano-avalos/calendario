

      document.addEventListener('DOMContentLoaded', function() {
 	$('#evento').on('shown.bs.modal', function() {
  map.invalidateSize();
});
      	var map = L.map('map').setView([-27.33056,  -55.86667], 13);
     
           var layerGroup = L.layerGroup().addTo(map);
           var point = new L.marker([0,  0], {draggable:'true'}).addTo(map);
           var marker;
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
              edgeBufferTiles: 5,
          }).addTo(map);
         
			 function onMapClick(e) {
                map.removeLayer(point);
                layerGroup.clearLayers();
                marker = L.marker(e.latlng).addTo(map);
                marker.addTo(layerGroup);
                document.getElementById('lat').value = marker.getLatLng().lat;
                document.getElementById('lon').value = marker.getLatLng().lng;

            }
            map.on('click', onMapClick);
            
		let formulario = document.querySelector('#formularioEventos'); //guarda los datos en la BD     
    let formularioConfirmacion = document.querySelector('#formularioConfirmacion')	
      	var calendarEl = document.getElementById('agenda');
      	var calendar = new FullCalendar.Calendar(calendarEl, {
      		initialView: 'dayGridMonth',
      		locale: "es", //traduce a español
      		displayEventTime:false,

      		headerToolbar: {
      			left: 'prev,next today', //batones de navegacion
      			center: 'title', //titulo
      			right: 'dayGridMonth,timeGridWeek,listWeek', //botones que permite ver diferente lista

      		},

      		//events: baseURL+"/evento/mostrar" ,

      		eventSources:{
      		 url: baseURL+"/evento/mostrar",
      		 method: "POST",
      		 extraParams:{
      		 	_token: formulario._token.value,
      		 }
      		},

      		dateClick:function (info){

				    formulario.reset();
				    map.removeLayer(point);	
				    point = new L.marker([-27.33056,  -55.86667], {draggable:'true'}).addTo(map);
      			document.getElementById('lat').value = point.getLatLng().lat;
                document.getElementById('lon').value = point.getLatLng().lng;
      			formulario.start.value=info.dateStr;
      			formulario.end.value=info.dateStr;


      			$("#evento").modal("show"); //devuelve info del dia que presionas



      	},
      	eventClick: function (info){
      		

      		var evento= info.event;
      		console.log(evento);
 			axios.post(baseURL+"/evento/editar/"+ info.event.id).
      		then(
      			(respuesta)=>{
				formulario.id.value= respuesta.data.id;
      			formulario.title.value=respuesta.data.title;
      			formulario.lat.value=respuesta.data.lat;
      			formulario.lon.value=respuesta.data.lon;
      			formulario.descripcion.value=respuesta.data.descripcion;
      			formulario.start.value=respuesta.data.start;
      			formulario.end.value=respuesta.data.end;
                layerGroup.clearLayers();
                map.removeLayer(point);
                point = new L.marker([respuesta.data.lat,  respuesta.data.lon], {draggable:'true'}).addTo(map);
                map.panTo([respuesta.data.lat,respuesta.data.lon]);
      			

      			$("#evento").modal("show");

      			formulario.id.value= respuesta.data.id;
      		}





      		).catch(
      			error=>{
      				if (error.response) {
      					console.log(error.response.data);
      				}
      			}


      		)


      	}



      	});

      	calendar.render();

      	document.getElementById("btnGuardar").addEventListener("click",function() {

      		enviarDatos ("/evento/agregar/");

      		});
      		document.getElementById("btnEliminar").addEventListener("click",function() {

      		enviarDatos ("/evento/borrar/"+formulario.id.value);
      		});

      		document.getElementById("btnModificar").addEventListener("click",function() {
      
      		enviarDatos ("/evento/actualizar/"+formulario.id.value);
      		});

          document.getElementById("btnConfirmar").addEventListener("click",function() {
      
          $("#confirmacion").modal("show");
          });

          document.getElementById("btnModificar").addEventListener("click",function() {
      
          enviarDatos ("/evento/actualizar/"+formulario.id.value);
          });

          document.getElementById("btnGuardarConfirmar").addEventListener("click",function() {
      
          confirmarParticipacion ("/confirmacion/agregar/");
          });

      		function confirmarParticipacion (url){

      		const datos= new FormData(formulario);

      		const nuevaURL=baseURL+url;

      		axios.post(nuevaURL, datos).
      		then(
      			(resuesta)=>{
      			
      			calendar.refetchEvents();

      			$("#evento").modal("hide");
      		}





      		).catch(
      			error=>{if (error.response) { console.log(error.response.data);
      				}
      			}


      		)

      		}
      		
          function confirmarParticipacion (url){

          const datos= new FormData(formularioConfirmacion);

          const nuevaURL=baseURL+url;

          axios.post(nuevaURL, datos).
          then(
            (resuesta)=>{
            
            calendar.refetchEvents();
            $("#confirmacion").modal("hide");
            
          }





          ).catch(
            error=>{if (error.response) { console.log(error.response.data);
              }
            }


          )

          }
      	});

     