$(function () {
                $('table tr:nth-child(even)').addClass('striped');
                $('#attiva').on('load', function () {
                    $('tr').toggleClass('striped');
                })
            });