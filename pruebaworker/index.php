<html>
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width initial-scale-1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<meta http-equiv="refresh" content="5">
	<title>Document</title>
	</head>
	<body>
		<button id="iniciar">Iniciar Worker</button>
		<button id="detener">Detener Worker</button>
		Número: <span id="numero">0</span>
		<script id="workerScript" type="javascript/worker">
			console.log("hola mundo");
		</script>
		<script>
			var iniciar=document.querySelector("#iniciar");
			var finalizar=document.querySelector("#detener");
			var miworker;
			var num = 0;
			var miblob = new Blob([document.querySelector("#workerScript").textContent]);
			var bloburl= window.URL.createObjectURL(miblob);
			console.log(bloburl);
			iniciar.addEventListener("click",function(){
				//miworker = new Worker("miworker.js");
				miworker = new Worker(bloburl);
				miworker.postMessage(num);
				miworker.onmessage=function(e){
					num=e.data;
					//document.querySelector("#numero").innerHTML=e.data;
					document.querySelector("#numero").innerHTML=num;

				}

			});
			finalizar.addEventListener("click",function(){
				miworker.terminate();
				miworker = undefined;
			});
		</script>

	</body>
</html>