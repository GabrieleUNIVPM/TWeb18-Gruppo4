            $(function () {
                $('#reg').change(function (event) {
                    if ($('#reg').val() == "->Seleziona<-") {
                        $('#prov').find('option').remove();
                        return
                    }
                    $.ajax({
                        type: 'GET',
                        data: "nome=" + $('#reg').val(),
                        dataType: 'json',
                        success: setProvince
                    });
                });
            });
            $(function () {
             $('#selProv').change(function (event){
                    if ($('#prov').val() == "->Seleziona<-"){
                        $('#city').find('option').remove(); 
                        return 
                    }
                    $.ajax({
                        type: 'GET',
                        data: "nome=" + $('#prov').val(),
                        dataType: 'json',
                        success: setCity
                    });
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
