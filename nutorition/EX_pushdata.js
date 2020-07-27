var logarray=[];
var count=0;
var judge=0;

  function EX_clickgo() {
    var material = document.getElementById("EX_name").value;
    var num =  document.getElementById("EX_num").value;
    
     if (material==""||num==""){
       alert("空白部分を埋めてください！");
     }
     else{
       document.getElementById("registfield").value ="\n"+document.getElementById("registfield").value+material+num+"分";
       logarray[count]=document.getElementById("registfield").value;
       count++;
     }
   };