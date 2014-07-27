


function cancelProp(prop){
	
	    var priceValue = document.getElementById('price').value ;
	var roomValue = document.getElementById('room').value;
	var cityareaValue = document.getElementById('cityarea').value;
	var typeValue = document.getElementById('type').value;
	var house_ageValue = document.getElementById('house_age').value;	
	var house_floorValue = document.getElementById('house_floor').value;	
	var catidValue = document.getElementById('catid').value;
	var dayValue = document.getElementById('day').value;
	var totalareaValue = document.getElementById('totalarea').value;
	
switch (prop)
   {
   case 'room':
     roomValue=''
	 break	
   case 'cityarea':
     cityareaValue=''
	 break
   case 'price':
     priceValue=''
	 break	 
   case 'type':
     typeValue=''
	 break
   case 'totalarea':
     totalareaValue=''
     break 
   case 'house_age':
     house_ageValue=''
     break
   case 'house_floor':
     house_floorValue=''
     break
   case 'catid':
     catidValue=''
     break
   case 'day':
     dayValue=''
     break  
 
 	 
}

location.href='list.php?p='+priceValue+'&r='+roomValue+'&areaid='+cityareaValue+'&day='+dayValue+'&catid='+catidValue+'&typeid='+typeValue+'&a='+totalareaValue+'&y='+house_ageValue+'&f='+house_floorValue;
	return false;
	
}