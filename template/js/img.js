function handleFiles(files) {
 
        var i = 0;
        var auswahl_div = document.getElementById('auswahl');
 
        var imageType = /image.*/;
 
        var fileList = files;
        
 
        for(i = 0; i < fileList.length; i++)
        {
                var div = document.createElement("div");
                div.style.backgroundColor = "grey";
                div.style.borderRadius = "5px";
                div.style.height = "170px";
                div.style.width = "175px";
                div.style.textAlign = "center";
                div.style.padding = "5px";
                div.style.cssFloat = "left";
                div.style.styleFloat = "left";
                div.style.margin = "5px";
                var img = document.createElement("img");    
                img.width = 120;
                img.maxHeight = 120;
                img.style.borderRadius = "3px";
                img.file = fileList[i];
                img.name = img.file.name.split(".")[0];
                img.classList.add("obj");
                var progress_dat = document.createElement("span");
                progress_dat.innerHTML = img.name;
                
 
 
                var reader = new FileReader();
                reader.onload = (function(aImg) { return function(e) { 
                    aImg.src = e.target.result; 
                    }; })(img);
                reader.readAsDataURL(fileList[i]);
 
                div.appendChild(img); 
                div.appendChild(progress_dat);   
                auswahl_div.appendChild(div);
                
        }
}

function sendFiles(){
  var i = 0;
  var imgs = document.querySelectorAll(".obj");
  for(i = 0; i < imgs.length; i++)
   {
 
 
    new FileUpload(imgs[i], imgs[i].file);
  }
 
}

function FileUpload(img, file) {
 
  
 
  var xhr = new XMLHttpRequest();
  this.xhr = xhr;
  var name = file.name;
  var prozent;
  var id = document.getElementById('usrid').value;
  
  progress = img.parentNode;
  
var progress_bar = document.createElement("div");
progress_bar.style.width = "160px";
progress_bar.style.height = "15px";
progress_bar.style.backgroundColor = "white";
var vortschritt = document.createElement("progress");
vortschritt.setAttribute("max", "100");
vortschritt.style.width = "auto";
vortschritt.setAttribute("value", "0");
  
  progress.appendChild(progress_bar);
  progress_bar.appendChild(vortschritt);
  
  var ready = document.createElement("span");
  ready.style ="font-weight:bold; color:blue";
  
  progress.appendChild(ready);
  
  
 
  this.xhr.upload.addEventListener("progress", function(e) {
        if (e.lengthComputable) {
  
   prozent = Math.round((e.loaded * 100) / e.total);
   
    vortschritt.value = prozent;
	vortschritt.style.width = 160 / 100 * prozent + "px"
          
        }
      }, false);
  
  xhr.upload.addEventListener("load", function(e){
        prozent  = 100;
        vortschritt.value = prozent;
		vortschritt.style.width = 160 / 100 * prozent + "px"
 
      }, false);

	  this.xhr.addEventListener("readystatechange", function(e){
        switch (xhr.readyState)
        {
            case 4:
                if (xhr.status != 200)
                {
                    alert("Der Request ist leider fehlgeschlagen. Status: " + xhr.status);
                }
                else 
                {
                    ready.innerHTML = "Hochgeladen";
                }
        }
    }, false);
  
 
    var fd = new FormData;
    fd.append("File", file);
	fd.append("id", id);
    
 
    xhr.open("POST", "uploadg.php", true);
	xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
    xhr.send(fd);
}