 // To Encrypt the given paramters into AES-128 Bit encrypted values
	 function veolia_lms_payment_encrypt(first_name,last_name,mailid,lmspaydata,authtoken,ext_refernceno) {
 		// Convert text to bytes
		var paymentuskey = 'F3DECF5F7B47FAB2FF1B7DB0D18B4CC0';
		//var paymentuskey = 'EA0051D460B6803C37272FA8CA5CCE6C';
		var key = aesjs.utils.hex.toBytes(paymentuskey);
		var firstname = first_name;
	    var lastname=last_name;
	    if(lastname===undefined){
	      lastname='';
	    } 
		var vro_lms_pay_text='iframe:true;customer.firstName='+firstname+';customer.lastName='+lastname+';customer.email='+mailid+';customer.email2='+mailid+';';   
		var learning_str=''
		for(var i=0;i<lmspaydata.length;i++){
			var vro_lms_pay_id=lmspaydata[i]["id"];   
			var vro_lms_pay_amount=lmspaydata[i]["fees"];  
			var vro_lms_pay_name=lmspaydata[i]["name"];  
			var vro_lms_payname=getvrolms_payname(vro_lms_pay_name);
			learning_str=learning_str+","+ vro_lms_pay_id;
			if(vro_lms_payname!=""){
				vro_lms_pay_text=vro_lms_pay_text+'payments['+i+'].header.active=true;payments['+i+'].header.paymentTypeCode='+vro_lms_payname+';payments['+i+'].header.accountNumber='+mailid+';payments['+i+'].header.authToken1='+vro_lms_pay_id+';payments['+i+'].header.externalReferenceNumber='+ext_refernceno+';payments['+i+'].header.amount='+vro_lms_pay_amount+';';	
			}			
		}
		var learning_id = learning_str.substring(1);
		vro_lms_pay_text=vro_lms_pay_text+'header.accountToken='+authtoken+';customer.address.line1='+learning_id+';step=2;';
		var text =  padRightTo32(vro_lms_pay_text);
		var textBytes = aesjs.utils.utf8.toBytes(text);

		var aesEcb = new aesjs.ModeOfOperation.ecb(key);
		var encryptedBytes = aesEcb.encrypt(textBytes);

		// To print or store the binary data, you may convert it to hex
		var encryptedHex = aesjs.utils.hex.fromBytes(encryptedBytes);
		//Returns the encrypted key with the UPPERCASE.
		return encryptedHex.toUpperCase(); 
	}


//To ensure the given string is block size of 32
    function padRightTo32(str) { 
    	// ensure block size of 32
        var len=str.length;
        for(var i=len; i%32>0; i++) {
            str=str +' ';
        }
        // return the string which is divisble by 32
        return str;
    }
	function getvrolms_payname(payname){
		var payment_type='';
		if(payname.includes("Wastewater Collection")===true){
			payment_type='WASTECOL';
		}
		else if(payname.includes("Wastewater")===true){			
			payment_type='WASTETREAT';
		} 
		else if(payname.includes("Water Treatment")===true){
			payment_type='WATERTREAT';
		}		 
		else if(payname.includes("Water Distribution")===true){
			payment_type='WATERDIS';
		}
		else if(payname.includes("Ohio")===true){
			payment_type='WASTEOHIO';
		}
		else if(payname.includes("Akron")===true){
			payment_type='AKRONWATER';
		}
		else if(payname.includes("Laboratory")===true){
			payment_type='LAB';
		}
		else if(payname.includes("Maintenance")===true){
			payment_type='MAINTENANCE';
		}
		else if(payname.includes("Collection Systems")===true){
			payment_type='COLLECTIONSSYS';
		}
		
		
		return payment_type;
	} 
