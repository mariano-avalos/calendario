 	

      document.addEventListener('DOMContentLoaded', function() {

		let formulario = document.querySelector('#formularioEventos') //guarda los datos en la BD      	
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

      			formulario.descripcion.value=respuesta.data.descripcion;

      			formulario.start.value=respuesta.data.start;
      			formulario.end.value=respuesta.data.end;

      			$("#evento").modal("show");
      			
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


      		function enviarDatos (url){

      		const datos= new FormData(formulario);

      		const nuevaURL=baseURL+url;

      		axios.post(nuevaURL, datos).
      		then(
      			(resuesta)=>{
      			calendar.refetchEvent();

      			$("#evento").modal("hide");
      		}





      		).catch(
      			error=>{if (error.response) { console.log(error.response.data);
      				}
      			}


      		)

      		}
      		
      	});

     