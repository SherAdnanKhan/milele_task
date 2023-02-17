<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{asset('editableTableWidget.js')}}"></script>
</head>

<body>
    <div class="container my-4">
        <h1 class="text-center">Car Demand Filter</h1>
        <hr>
        <button id="nextStep">Next Step</button>
        <form id="filter-form" onsubmit="event.preventDefault();" class="mb-4">
            <div class="row step" id="step1">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <select class="form-control" name="supplier" id="supplier">
                            <option value="">-- Select Supplier --</option>

                            @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="whole_seller">Whole Seller</label>
                        <select class="form-control" name="whole_seller" id="whole_seller">
                            <option value="">-- Select Whole Seller --</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="steering_type">Steering Type</label>
                        <select class="form-control" name="steering_type" id="steering_type">
                            <option value="">-- Select Steering Type --</option>
                            @foreach($steeringTypes as $steering_type)
                            <option value="{{$steering_type->id}}">{{$steering_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row step" id="step2">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="car_model">Car Model</label>
                        <select class="form-control" name="car_model" id="car_model">
                            <option value="">-- Select Car Model --</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="car_sfx">Car SFX</label>
                        <select class="form-control" name="car_sfx" id="car_sfx">
                            <option value="">-- Select Car SFX --</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="car_variant">Car Variant</label>
                        <select class="form-control" name="car_variant" id="car_variant">
                            <option value="">-- Select Car Variant --</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="color">Color</label>
                        <select class="form-control" name="color" id="color">
                            <option value="">-- Select Color --</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row step" id="step3">
                <table class="table" id="editable-table">
                    <thead>
                        @foreach($months as $month)
                        <th>{{ $month }}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        <tr id="emptyrow">
                            <td contenteditable></td>
                            <td contenteditable></td>
                            <td contenteditable></td>
                            <td contenteditable></td>
                            <td contenteditable></td>
                            <td contenteditable></td>
                            <td contenteditable></td>
                            <td contenteditable></td>
                            <td contenteditable></td>
                            <td contenteditable></td>
                            <td contenteditable></td>
                            <td contenteditable></td>
                        </tr>
                        <tr id="buttonrow">
                            <td colspan="2"><button id="add-row" class="btn btn-success">Add Row</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function() {

                    var currentStep = 1;
                    $('.step').hide();
                    $('#step1').show();

                    $('#nextStep').click(function() {
                        if($('#steering_type').val() && currentStep == 1){   
                            $('.step').hide();
                            $('#step' + (++currentStep)).show();
                        }
                        else if($('#color').val() && currentStep == 2){   
                            console.log(currentStep);
                            $('.step').hide();
                            $('#step' + (++currentStep)).show();
                            $('#nextStep').hide();
                        }
                    });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#submit').prop('disabled', true)
                    $('#car_sfx').prop('disabled', true)
                    $('#car_variant').prop('disabled', true)
                    $('#car_model').prop('disabled', true)
                    $('#color').prop('disabled', true)
                    $("#add-row").prop('disabled', true);

                    $('#supplier').change(function() {
                        $('#editable-table tbody tr').not('#emptyrow, #buttonrow').empty();
                        var supplier_id = $(this).val();
                        if (supplier_id) {
                            $.ajax({
                                type: "GET",
                                url: "{{ route('getWholeSellers', ['supplier_id' => ':supplier_id']) }}".replace(':supplier_id', supplier_id),
                                success: function(res) {
                                    if (res) {
                                        $('#whole_seller').empty();
                                        $('#whole_seller').append('<option value="">-- Select Whole Seller --</option>');
                                        $.each(res, function(key, value) {
                                            $('#whole_seller').append('<option value="' + key + '">' + value + '</option>');
                                        });
                                        $('#whole_seller').prop('disabled', false);
                                    } else {
                                        $('#whole_seller').empty();
                                        $('#whole_seller').prop('disabled', true)
                                    }
                                }
                            });
                        } else {
                            $('#whole_seller').empty();
                            $('#whole_seller').prop('disabled', true)
                            $('#steering_type').empty();
                            $('#steering_type').prop('disabled', true)
                            $('#car_model').empty();
                            $('#car_model').prop('disabled', true)
                            $('#car_sfx').empty();
                            $('#car_sfx').prop('disabled', true)
                            $('#car_variant').empty();
                            $('#car_variant').prop('disabled', true)
                            $('#color').empty();
                            $('#color').prop('disabled', true)
                        }
                    });

                    $('#steering_type').on('change', function() {
                        $('#editable-table tbody tr').not('#emptyrow, #buttonrow').empty();
                        var steering_type_id = $(this).val();
                        if (steering_type_id) {
                            $.ajax({
                                url: "{{ route('getCarModels', ['steering_type_id' => ':steering_type_id']) }}".replace(':steering_type_id', steering_type_id),
                                type: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    $('#car_model').empty();
                                    $('#car_model').prop('disabled', false);
                                    $('#car_model').append('<option value="">-- Select Car Model --</option>');
                                    $.each(data, function(key, value) {
                                        $('#car_model').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                    $('#car_model').prop('disabled', false);
                                }
                            });
                        } else {
                            $('#car_model').empty();
                            $('#car_model').prop('disabled', true);
                        }
                    });

                    $('#car_model').on('change', function() {
                        $('#editable-table tbody tr').not('#emptyrow, #buttonrow').empty();
                        var car_model_id = $(this).val();
                        if (car_model_id) {
                            $.ajax({
                                url: "{{ route('getCarSFXs', ['car_model_id' => ':car_model_id']) }}".replace(':car_model_id', car_model_id),
                                type: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    $('#car_sfx').empty();
                                    $('#car_sfx').prop('disabled', false);
                                    $('#car_sfx').append('<option value="">-- Select Car SFX --</option>');
                                    $.each(data, function(key, value) {
                                        $('#car_sfx').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                    $('#car_sfx').prop('disabled', false);
                                }
                            });
                        } else {
                            $('#car_sfx').empty();
                            $('#car_sfx').prop('disabled', true);
                        }
                    });

                    $('#car_sfx').change(function() {
                        $('#editable-table tbody tr').not('#emptyrow, #buttonrow').empty();
                        var car_sfx = $(this).val();
                        if (car_sfx != '') {
                            $('#car_variant').prop('disabled', false);
                            $('#car_variant').empty();
                            $('#car_variant').append('<option value="">-- Select Car Variant --</option>');
                            $.ajax({
                                url: '{{ route("getCarVariant") }}',
                                type: 'post',
                                data: {
                                    car_sfx: car_sfx
                                },
                                dataType: 'json',
                                success: function(response) {
                                    var len = response.length;
                                    for (var i = 0; i < len; i++) {
                                        var car_variant_id = response[i]['id'];
                                        var car_variant_name = response[i]['name'];
                                        $('#car_variant').append("<option value='" + car_variant_id + "'>" + car_variant_name + "</option>");
                                    }
                                    $('#car_variant').prop('disabled', false);
                                }
                            });
                        } else {
                            $('#car_variant').empty();
                            $('#car_variant').prop('disabled', true);
                        }
                    });

                    // When car variant is selected
                    $('#car_variant').change(function() {
                        $('#editable-table tbody tr').not('#emptyrow, #buttonrow').empty();
                        var supplier = $('#supplier').val();
                        var whole_seller = $('#whole_seller').val();
                        var steering_type = $('#steering_type').val();
                        var car_model = $('#car_model').val();
                        var car_sfx = $('#car_sfx').val();
                        var car_variant = $(this).val();
                        if (car_variant != '') {
                            $('#color').prop('disabled', false);
                            $('#color').empty();
                            $('#color').append('<option value="">-- Select Color --</option>');
                            $.ajax({
                                url: '{{ route("getColor") }}',
                                type: 'post',
                                data: {
                                    car_variant: car_variant
                                },
                                dataType: 'json',
                                success: function(response) {
                                    var len = response.length;
                                    for (var i = 0; i < len; i++) {
                                        var id = response[i]['id'];
                                        var name = response[i]['name'];
                                        $('#color').append("<option value='" + id + "'>" + name + "</option>");
                                    }
                                    $('#color').prop('disabled', false);
                                }
                            });
                        } else {
                            $('#color').empty();
                            $('#color').prop('disabled', true);
                        }
                    });

                    $('#color').change(function() {
                        // Get the values of the three major selections
                        var supplier = $('#supplier').val();
                        var whole_seller = $('#whole_seller').val();
                        var steering_type = $('#steering_type').val();

                        // Get the values of the four minor selections
                        var car_model = $('#car_model').val();
                        var car_sfx = $('#car_sfx').val();
                        var car_variant = $('#car_variant').val();
                        var color = $('#color').val();
                        $('#submit').prop('disabled', false);
                        $("#add-row").prop('disabled', false);

                        // Load the filtered data using AJAX
                        $.ajax({
                            url: '{{ route("getFilteredData") }}',
                            type: 'post',
                            data: {
                                supplier: supplier,
                                whole_seller: whole_seller,
                                steering_type: steering_type,
                                car_model: car_model,
                                car_sfx: car_sfx,
                                car_variant: car_variant,
                                color: color
                            },
                            success: function(data) {
                                if (data) {
                                    last_row = $('#editable-table tbody tr').not('#emptyrow, #buttonrow').empty();
                                    first_row = $('#editable-table tbody tr').first();
                                    let oldData = '';
                                    data.forEach(element => {
                                        oldData += '<tr>';
                                        oldData += '<td contenteditable>' + element['jan'] + '</td><td contenteditable>' + element['feb'] + '</td>';
                                        oldData += '<td contenteditable>' + element['mar'] + '</td><td contenteditable>' + element['apr'] + '</td>';
                                        oldData += '<td contenteditable>' + element['may'] + '</td><td contenteditable>' + element['jun'] + '</td>';
                                        oldData += '<td contenteditable>' + element['jul'] + '</td><td contenteditable>' + element['aug'] + '</td>';
                                        oldData += '<td contenteditable>' + element['sep'] + '</td><td contenteditable>' + element['oct'] + '</td>';
                                        oldData += '<td contenteditable>' + element['nov'] + '</td><td contenteditable>' + element['dec'] + '</td>';
                                        oldData += '<td style="display:none">' + element['id'] + '</td>';
                                        oldData += '</tr>';
                                    });
                                    first_row.before(oldData);
                                }
                            }
                        });

                        // Initialize the editable table
                        //  $('#editable-table').editableTableWidget();

                        // Add a new empty row to the table
                        $('#add-row').on('click', function(e) {
                            e.preventDefault();
                            let emptyRow = '';
                            emptyRow = '<tr><td contenteditable></td><td contenteditable></td><td contenteditable></td><td contenteditable></td><td contenteditable></td><td contenteditable></td><td contenteditable></td><td contenteditable></td><td contenteditable></td><td contenteditable></td><td contenteditable></td><td contenteditable></td></tr>';
                            last_row = $('#editable-table tbody tr').last();
                            last_row.before(emptyRow);
                        });

                        // Save the changes made to the table using AJAX
                        $('#filter-form').on('click', function() {
                            var supplier = $('#supplier').val();
                            var whole_seller = $('#whole_seller').val();
                            var steering_type = $('#steering_type').val();

                            // Get the values of the four minor selections
                            var car_model = $('#car_model').val();
                            var car_sfx = $('#car_sfx').val();
                            var car_variant = $('#car_variant').val();
                            var color = $('#color').val();

                            if (supplier && whole_seller && steering_type && car_model && car_sfx && car_variant && color) {

                                var tableData = [];
                                let saveData = false;
                                $('#editable-table tbody tr').slice(0, -1).each(function(row, tr) {
                                    var rowData = {
                                        'supplier_id': supplier,
                                        'whole_seller_id': whole_seller,
                                        'steering_type_id': steering_type,
                                        'car_model_id': car_model,
                                        'car_sfx_id': car_sfx,
                                        'car_variant_id': car_variant,
                                        'color_id': color,
                                        'jan': $('td:eq(0)', tr).text(),
                                        'feb': $('td:eq(1)', tr).text(),
                                        'mar': $('td:eq(2)', tr).text(),
                                        'apr': $('td:eq(3)', tr).text(),
                                        'may': $('td:eq(4)', tr).text(),
                                        'jun': $('td:eq(5)', tr).text(),
                                        'jul': $('td:eq(6)', tr).text(),
                                        'aug': $('td:eq(7)', tr).text(),
                                        'sep': $('td:eq(8)', tr).text(),
                                        'oct': $('td:eq(9)', tr).text(),
                                        'nov': $('td:eq(10)', tr).text(),
                                        'dec': $('td:eq(11)', tr).text(),
                                        'id' : $('td:eq(12)', tr).text(),
                                    };
                                    if (rowData['jan'] || rowData['feb'] || rowData['mar'] || rowData['apr'] ||
                                        rowData['may'] || rowData['jun'] || rowData['jul'] || rowData['aug'] ||
                                        rowData['sep'] || rowData['oct'] || rowData['nov'] || rowData['dec']) {
                                        tableData.push(rowData);
                                        saveData = true;
                                    }
                                });
                                if (saveData) {
                                    $.ajax({
                                        url: "{{ route('saveTableData')}}",
                                        type: 'POST',
                                        data: {
                                            'tableData': tableData
                                        },
                                        success: function() {
                                            saveData = false;
                                        }
                                    });

                                }

                            }
                        });
                    });
                });
            </script>
</body>

</html>