<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>D3 Demo: 5-div bar chart</title>
		<link rel="stylesheet" href="widget.css" />
		<script type="text/javascript" src="d3/d3.js"></script>
	</head>
	
	<body>
	
	
	<div class = "widget_AmadeusOverallIncidentBacklog">
	 <div class = "firstRow">
	    <div class = "KPIName">Amadeus Overall Incident Backlog</div>
		<div class = "monthlyKPI">Monthly KPI: <br/> kpi_Value</div>
	</div>
	<div class = "SecondRow">
		<div class = "trend">Trend</div>
		<div class = "indicatorTrend">
		Indicator of KPI: <br/> 
		trendImage
		</div>
	 </div>
	</div>
	<br/>
	
	
<canvas id="myCanvas" width="400" height="300" style="border:1px solid black;">
    Votre navigateur ne supporte pas canvas.
</canvas>

<div id="div_canvas_Incidents">
<canvas id="Canvas_Incident" width="150" height="50" style="border:1px solid black;">
    Votre navigateur ne supporte pas canvas.
</canvas>
</div>

<script type="text/javascript">
// canvas link:
// https://openclassrooms.com/courses/la-balise-canvas-avec-javascript

// When the window has finished loading all the components... Manipulate the canvas to draw a ball moving in a rectangle.
window.onload = function()
{

	   var canvas_incidents = document.getElementById("Canvas_Incident");
	    if(!canvas_incidents)
	    {
	        alert("Impossible de récupérer le canvas");
	        return;
	    }
	    
	    var context_incidents = canvas_incidents.getContext("2d");
	    if(!context_incidents)
	    {
	        alert("Impossible de récupérer le context");
	        return;
	    }

	    context_incidents.clearRect(0, 0, canvas_incidents.width, canvas_incidents.height);

	    // Draw the rect Incidents.
	    //On n'oublie pas de récupérer le canvas et son context.

	    var degrade = context_incidents.createLinearGradient(0,0,300,100);//Délimitation du début et de la fin du dégradé.
	        degrade.addColorStop(0,"#005EB8");//Ajout d'une première couleur.
	        degrade.addColorStop(1,"#00A9E0");//Ajout de la seconde couleur.

	    context_incidents.fillStyle = degrade;//On passe notre dégradé au fillStyle();
	    context_incidents.fillRect(0, 0, canvas_incidents.width, canvas_incidents.height);
	    context_incidents.fill();

		 var text = "INCIDENTS";
		 var textLenght = getWidthOfText(text,"18px", "Helvetica");
		 
		    
		 context_incidents.fillStyle = "#ff0000"; //Toutes les prochaines formes pleines seront rouges.   
		 context_incidents.font = "18px Helvetica";//On passe à l'attribut "font" de l'objet context une simple chaîne de caractères composé de la taille de la police, puis de son nom.
		 context_incidents.fillText("INCIDENTS", (canvas_incidents.width/2)-textLenght, canvas_incidents.height/2);//strokeText(); fonctionne aussi, vous vous en doutez.
		   
	
	// We get the canvas and we get the context of the canvas to be able to draw in it.
    var canvas = document.getElementById("myCanvas");
    if(!canvas)
    {
        alert("Impossible de récupérer le canvas");
        return;
    }
    
    var context = canvas.getContext("2d");
    if(!context)
    {
        alert("Impossible de récupérer le context");
        return;
    }

    // Definition of the variables for the ball.
    var diametreBalle = 20;
    
    var posX = 1+diametreBalle/2; // ie posX = 1 + R;
    var posY = 1+diametreBalle/2; // ie posY = 1 + R;
    var vitesseX = 3; // Speed on the X axis.
    var vitesseY = 3; // Speed on the Y axis.

    //var myInterval = setInterval(animate, 1000/30);
    
    // The animation loop.
    var animationLoop = function animate()
    {
        // Clear the canvas.
        context.clearRect(0, 0, canvas.width, canvas.height);
        
        // Draw the ball.
        context.beginPath();
        context.arc(posX, posY, diametreBalle/2, 0, Math.PI*2);
        context.fill();
        
        //On va vérifier si la balle à toucher l'un des bords du canvas.
        if(posX+diametreBalle/2 >= canvas.width || posX <= 0+diametreBalle/2)//Si on touche le bord gauche ou droit
        {
            vitesseX *= -1;//On inverse la vitesse de déplacement sur l'axe horizontal.
        }

        if(posY+diametreBalle/2 >= canvas.height || posY <= 0+diametreBalle/2)//Si on touche le bord du bas ou du haut
        {
            vitesseY *= -1;//On inverse la vitesse de déplacement sur l'axe vertical.
        }
        
        //On additionne les vitesses de déplacement avec les positions
        posX += vitesseX;
        posY += vitesseY;

        requestAnimationFrame(animationLoop); //loop again.
    }
    requestAnimationFrame(animationLoop); // Do the loop for the animation.
    
}

function getWidthOfText(txt, fontname, fontsize){
	  // Create a dummy canvas (render invisible with css)
	  var c=document.createElement('canvas');
	  // Get the context of the dummy canvas
	  var ctx=c.getContext('2d');
	  // Set the context.font to the font that you are using
	  ctx.font = fontsize + fontname;
	  // Measure the string 
	  // !!! <CRUCIAL>  !!!
	  var length = ctx.measureText(txt).width;
	  // !!! </CRUCIAL> !!!
	  // Return width
	  return length;
	}

</script>

<script type="text/javascript">
	// Exemple of D3 js. Draw a bar chart with D3 js and SVG.
	// D3 js link :
	//http://alignedleft.com/tutorials/d3/drawing-svgs

			//Width and height
			var w = 250;
			var h = 129;
			var barPadding = 1;

			// The dataSet. Can be more complicate and can be in other format (JSON, etc...).
			var dataset = [ 5, 10, 13, 19, 21, 25, 22, 18, 15, 13,
							11, 12 ];
			
			//Create SVG element, and put it in the body.
			var svg = d3.select(".trend")
						.append("svg")
						.attr("width", w) // Set the width of the SVG.
						.attr("height", h); // Set the height of the SVG.

			svg.selectAll("rect")
			   .data(dataset)
			   .enter()
			   .append("rect")
			   .attr("x", function(d, i) { // Add attributes: set the abscisse of the graph.
			   		return i * (w / dataset.length);
			   })
			   .attr("y", function(d) { // Set the ordonnee of the graph.
			   		return h - (d * 4);
			   })
			   .attr("width", w / dataset.length - barPadding) // Set the width of each bar.
			   .attr("height", function(d) { // Set the heigth of each bar.
			   		return d * 4;
			   })
			   .attr("fill", function(d) { // Set the color of the bar (depending on the value of the data).
					return "rgb(0, 0, " + (d * 10) + ")";
			   });

		    // Set the text (we want to display the value of the data).
			svg.selectAll("text")
			   .data(dataset)
			   .enter()
			   .append("text")
			   .text(function(d) { // Add the value of the data.
			   		return d;
			   })
			   .attr("text-anchor", "middle")
			   .attr("x", function(d, i) {
			   		return i * (w / dataset.length) + (w / dataset.length - barPadding) / 2;
			   })
			   .attr("y", function(d) {
			   		return h - (d * 4) + 14;
			   })
			   .attr("font-family", "sans-serif")
			   .attr("font-size", "11px")
			   .attr("fill", "white");

		</script>

</body>
</html>