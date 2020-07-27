var logarray=[];
var count=0;
var judge=0;
window.onload = function(){
    var count_load = localStorage.getItem("count1");
    document.getElementById("dayCount").innerHTML = count_load;
    localStorage.setItem("count1", count_load + 1);
}
function MA_clickgo() {
   var material = document.getElementById("MA_name").value;
   var num =  document.getElementById("MA_num").value;   
    if (material==""||num==""){
      alert("空白部分を埋めてください！");
    }
    // else{
    //   document.getElementById("registfield").value =document.getElementById("registfield").value+material+num+"個"+"\n";
    //   logarray[count]=document.getElementById("registfield").value;
    //   count++;
    // }
  };
  function ME_clickgo() {
    
    var material = document.getElementById("ME_name").value;
    var num =  document.getElementById("ME_num").value;
    
     if (material==""||num==""){
       alert("空白部分を埋めてください！");
     }
     else{
       document.getElementById("registfield").value ="\n"+document.getElementById("registfield").value+material+num+"個";
       logarray[count]=document.getElementById("registfield").value;
       count++;
     }
   };
   function OT_clickgo() {
    var material = document.getElementById("OT_dname").value;
    var num =  document.getElementById("OT_dnum").value;
    
     if (material==""||num==""){
       alert("空白部分を埋めてください！");
     }
     else{
       document.getElementById("registfield").value ="\n"+document.getElementById("registfield").value+material+num+"個";
       logarray[count]=document.getElementById("registfield").value;
       count++;
     }
   };
   function clickback(){
     count--;
     if(count>0){
      document.getElementById("registfield").value =logarray[count-1];
     }
     else{
       document.getElementById("registfield").value ="";
       count=0;
     }
  }
  function EX_clickgo() {
    var material = document.getElementById("EX_name").value;
    var num =  document.getElementById("EX_num").value;
    
     if (material==""||num==""){
       alert("空白部分を埋めてください！");
     }
     else{
       document.getElementById("registfield").value ="\n"+document.getElementById("registfield").value+material+num+"個";
       logarray[count]=document.getElementById("registfield").value;
       count++;
     }
   };