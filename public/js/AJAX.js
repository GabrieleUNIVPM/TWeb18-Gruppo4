            $(function province(reg, prov, actionUrl, formName) {
                $('#'+reg).change(function (event) {
                    if ($('#'+reg).val() == "->Seleziona<-") {
                        $('#'+prov).find('option').remove();
                        return
                    }
                    $.ajax({
                        type: 'GET',
                        url : actionUrl,
                        data : $("#" + formName).serialize(),
                        dataType: 'json',
                        success: setProvince
                    });
                });
            });
            $(function comuni(prov, city, actionUrl, formName) {
             $('#'+prov).change(function (event){
                    if ($('#'+prov).val() == "->Seleziona<-"){
                        $('#'+city).find('option').remove(); 
                        return 
                    }
                    $.ajax({
                        type: 'GET',
                        url : actionUrl,
                        data : $("#" + formName).serialize(),
                        dataType: 'json',
                        success: setCity
                    });
                });
            });

            function setProvince(prov,data) {
                $('#'+prov).find('option').remove();
                $.each(data, function (key, val) {
                    $('#'+prov).append('<option>' + val + '</option>');
                });
            }
            function setCity(city,data) {
                $('#'+city).find('option').remove();
                $.each(data, function (key, val) {
                    $('#'+city).append('<option>' + val + '</option>');
                });
            }
