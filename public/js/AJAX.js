            $(function province(actionUrl, formName) {
                    if ($('#reg').val() === "->Seleziona<-") {
                        $('#prov').find('option').remove();
                        return
                    }
                    $.ajax({
                        type: 'POST',
                        url : actionUrl,
                        data : $("#" + formName).serialize(),
                        dataType: 'json',
                        success: setProvince
                    });
                });
            
            $(function comuni(actionUrl, formName) {
                    if ($('#prov').val() === "->Seleziona<-"){
                        $('#city').find('option').remove(); 
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

            function setProvince(data) {
                $('#prov').find('option').remove();
                $.each(data, function (key, val) {
                    $('#prov').append('<option>' + val + '</option>');
                });
            }
            function setCity(data) {
                $('#city').find('option').remove();
                $.each(data, function (key, val) {
                    $('#city').append('<option>' + val + '</option>');
                });
            }
