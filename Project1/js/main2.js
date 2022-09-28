function selects(){  
	var ele=document.getElementsByName('checkbox-user[]');  
	for(var i=0; i<ele.length; i++){  
		if(ele[i].type=='checkbox')  
			ele[i].checked=true;  
	}  
}  
function deSelect(){  
	var ele=document.getElementsByName('checkbox-user[]');  
	for(var i=0; i<ele.length; i++){  
		if(ele[i].type=='checkbox')  
			ele[i].checked=false;  
		  
	}  
} 
function openForm() {
    document.getElementById("popupForm").style.display = "block";
    }
function closeForm() {
    document.getElementById("popupForm").style.display = "none";
    }
function openForm2() {
    document.getElementById("popupForm2").style.display = "block";
    }
function closeForm2() {
    document.getElementById("popupForm2").style.display = "none";
    }
function openForm3(x) {
    document.getElementById(x).style.display = "block";
    }
function closeForm3(x) {
    document.getElementById(x).style.display = "none";
    }
function openForm4() {
    document.getElementById("popupForm4").style.display = "block";
    }
function closeForm4() {
    document.getElementById("popupForm4").style.display = "none";
    }