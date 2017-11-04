function selectProvince() {
	$.ajax( {
		type : "post",
		url : "/index.php/Core/Region/getDataByParentId",
		data : {},
		success : function(msg) {
			$("#province").html("<option value=''>省</option>");
			for ( var i = 0; i < msg.length; i++) {
				$("#province").append("<option value=" + msg[i].id + ">" + msg[i].region_name+ "</option>");
					
			}
			if(typeof(isPCCEdit) != "undefined" && isPCCEdit==1){
				$('#province').val(province);
			}
			selectCity();
		}
	})
};
function selectCity() {
	$("#city").html("");
	
	if($('#province').val()==''){
		$("#city").html("<option value=''>市</option>");
		selectCountry();
		return;
	}
	$.ajax( {
		type : "post",
		url : "/index.php/Core/Region/getDataByParentId",
		data : {
			"parent_id" : $('#province').val()
		},
		success : function(msg) {
			$("#city").html("<option value=''>市</option>");
			for ( var i = 0; i < msg.length; i++) {
				$("#city").append("<option value=" + msg[i].id + ">" + msg[i].region_name+ "</option>");
			}
			if(typeof(isPCCEdit) != "undefined" && isPCCEdit==1){
				$('#city').val(city);
			}
			selectCountry();
		}
	})
};
function selectCountry() {
	$("#country").html("");
	if($('#city').val()==''){
		$("#country").html("<option value=''>县/区</option>");
		return;
	}
	$.ajax( {
		type : "post",
		url : "/index.php/Core/Region/getDataByParentId",
		data : {
			"parent_id" : $('#city').val()
		},
		success : function(msg) {
			$("#country").html("<option value=''>县/区</option>");
			for ( var i = 0; i < msg.length; i++) {
				$("#country").append("<option value=" + msg[i].id + ">" + msg[i].region_name+ "</option>");
			}
			if(typeof(isPCCEdit) != "undefined" && isPCCEdit==1){
				$('#country').val(country);
				isPCCEdit=0;
			}
		}
	})
};
$(function() {
	selectProvince();
	$('#province').bind("change", selectCity);
	$('#city').bind("change", selectCountry);
});