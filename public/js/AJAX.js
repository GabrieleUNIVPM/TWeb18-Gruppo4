            $(function () {
                $('#selReg').change(function (event) {
                    if ($('#selReg').val() == "->Seleziona<-") {
                        $('#selProv').find('option').remove();
                        return
                    }
                    $.ajax({
                        type: 'GET',
                        data: "nome=" + $('#selReg').val(),
                        dataType: 'json',
                        success: setProvince
                    });
                });
            });
            $(function () {
             $('#selProv').change(function (event){
                    if ($('#selProv').val() == "->Seleziona<-"){
                        $('#selCit').find('option').remove(); 
                        return 
                    }
                    $.ajax({
                        type: 'GET',
                        data: "nome=" + $('#selProv').val(),
                        dataType: 'json',
                        success: setCity
                    });
                });
            });

            function setProvince(data) {
                $('#selProv').find('option').remove();
                $.each(data, function (key, val) {
                    $('#selProv').append('<option>' + val + '</option>');
                });
            }
            function setCity(data) {
                $('#selCit').find('option').remove();
                $.each(data, function (key, val) {
                    $('#selCit').append('<option>' + val + '</option>');
                });
            }
