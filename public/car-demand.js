$(document).ready(function () {
    // Load the suppliers dropdown
    $.ajax({
        url: "{{ route('suppliers.index') }}",
        type: "GET",
        success: function (response) {
            var options = '<option value="">Select Supplier</option>';
            $.each(response, function (index, supplier) {
                options +=
                    '<option value="' +
                    supplier.id +
                    '">' +
                    supplier.name +
                    "</option>";
            });
            $("#supplier").html(options);
        },
    });

    // Load the whole sellers dropdown
    $("#supplier").change(function () {
        var supplierId = $(this).val();
        if (supplierId) {
            $.ajax({
                url: "{{ route('whole-sellers.index') }}",
                type: "GET",
                data: { supplier_id: supplierId },
                success: function (response) {
                    var options =
                        '<option value="">Select Whole Seller</option>';
                    $.each(response, function (index, wholeSeller) {
                        options +=
                            '<option value="' +
                            wholeSeller.id +
                            '">' +
                            wholeSeller.name +
                            "</option>";
                    });
                    $("#whole_seller").html(options);
                },
            });
        }
    });

    // Load the car models dropdown
    $("#whole_seller").change(function () {
        var supplierId = $("#supplier").val();
        var wholeSellerId = $(this).val();
        if (supplierId && wholeSellerId) {
            $.ajax({
                url: "{{ route('car-models.index') }}",
                type: "GET",
                data: {
                    supplier_id: supplierId,
                    whole_seller_id: wholeSellerId,
                },
                success: function (response) {
                    var options = '<option value="">Select Car Model</option>';
                    $.each(response, function (index, carModel) {
                        options +=
                            '<option value="' +
                            carModel.id +
                            '">' +
                            carModel.name +
                            "</option>";
                    });
                    $("#car_model").html(options);
                },
            });
        }
    });

    // Load the car SFX dropdown
    $("#car_model").change(function () {
        var supplierId = $("#supplier").val();
        var wholeSellerId = $("#whole_seller").val();
        var carModelId = $(this).val();
        if (supplierId && wholeSellerId && carModelId) {
            $.ajax({
                url: "{{ route('car-sfx.index') }}",
                type: "GET",
                data: {
                    supplier_id: supplierId,
                    whole_seller_id: wholeSellerId,
                    car_model_id: carModelId,
                },
                success: function (response) {
                    var options = '<option value="">Select Car SFX</option>';
                    $.each(response, function (index, carSFX) {
                        options +=
                            '<option value="' +
                            carSFX.id +
                            '">' +
                            carSFX.name +
                            "</option>";
                    });
                    $("#car_sfx").html(options);
                },
            });
        }
    });

    // Load the car variants dropdown
    $("#car_sfx").change(function () {
        var supplierId = $("#supplier").val();
        var wholeSellerId = $("#whole_seller").val();
        var carModelId = $("#car_model").val();
        var carSFXId = $("#car_sfx").val();
        Id = $(this).val();
        if (supplierId && wholeSellerId && carModelId && carSFXId) {
            $.ajax({
                url: "{{ route('car-variants.index') }}",
                type: "GET",
                data: {
                    supplier_id: supplierId,
                    whole_seller_id: wholeSellerId,
                    car_model_id: carModelId,
                    car_sfx_id: carSFXId,
                },
                success: function (response) {
                    var options =
                        '<option value="">Select Car Variant</option>';
                    $.each(response, function (index, carVariant) {
                        options +=
                            '<option value="' +
                            carVariant.id +
                            '">' +
                            carVariant.name +
                            "</option>";
                    });
                    $("#car_variant").html(options);
                },
            });
        }
    });

    // Load the car colors dropdown
    $("#car_variant").change(function () {
        var supplierId = $("#supplier").val();
        var wholeSellerId = $("#whole_seller").val();
        var carModelId = $("#car_model").val();
        var carSFXId = $("#car_sfx").val();
        var carVariantId = $(this).val();
        if (
            supplierId &&
            wholeSellerId &&
            carModelId &&
            carSFXId &&
            carVariantId
        ) {
            $.ajax({
                url: "{{ route('car-colors.index') }}",
                type: "GET",
                data: {
                    supplier_id: supplierId,
                    whole_seller_id: wholeSellerId,
                    car_model_id: carModelId,
                    car_sfx_id: carSFXId,
                    car_variant_id: carVariantId,
                },
                success: function (response) {
                    var options = '<option value="">Select Color</option>';
                    $.each(response, function (index, color) {
                        options +=
                            '<option value="' +
                            color.name +
                            '">' +
                            color.name +
                            "</option>";
                    });
                    $("#color").html(options);
                },
            });
        }
    });

    // Load the car demands
    $("#filter-form").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('car-demands.filter') }}",
            type: "POST",
            data: formData,
            success: function (response) {
                var carDemandRows = "";
                $.each(response, function (index, carDemand) {
                    carDemandRows += renderCarDemandRow(carDemand);
                });
                $("#car-demand-table tbody").html(carDemandRows);
            },
        });
    });

    // Add a new empty row to the table
    $("#add-row-btn").click(function () {
        var carDemand = {
            supplier: $("#supplier option:selected").text(),
            whole_seller: $("#whole_seller option:selected").text(),
            steering_type: $("#steering_type option:selected").text(),
            car_model: $("#car_model option:selected").text(),
            car_sfx: $("#car_sfx option:selected").text(),
            car_variant: $("#car_variant option:selected").text(),
            color: $("#color option:selected").text(),
        };
        var newRow = renderCarDemandRow(carDemand, true);
        $("#car-demand-table tbody").append(newRow);
    });

    // Save the new row to the database
    $("#car-demand-table").on("click", ".save-row-btn", function () {
        var row = $(this).closest("tr");
        var formData = row.find("form").serialize();
        $.ajax({
            url: "{{ route('car-demands.store') }}",
            type: "POST",
            data: formData,
            success: function (response) {
                row.find(".save-row-btn").hide();
                row.find(".edit-row-btn").show();
                row.find(".cancel-row-btn").hide();
                row.find(".delete-row-btn").show();
                row.find(".input-field").attr("disabled", true);
                row.find(".row-action-btn").removeClass("hidden");
                row.attr("data-row-id", response.id);
            },
            error: function (response) {
                alert("Error saving the car demand");
            },
        });
    });

    // Edit a row
    $("#car-demand-table").on("click", ".edit-row-btn", function () {
        var row = $(this).closest("tr");
        row.find(".save-row-btn").show();
        row.find(".edit-row-btn").hide();
        row.find(".cancel-row-btn").show();
        row.find(".delete-row-btn").hide();
        row.find(".input-field").attr("disabled", false);
    });

    // Cancel editing a row
    $("#car-demand-table").on("click", ".cancel-row-btn", function () {
        var row = $(this).closest("tr");
        var id = row.attr("data-row-id");
        if (id) {
            $.ajax({
                url: "{{ route('car-demands.show', ['car_demand' => ':id']) }}".replace(
                    ":id",
                    id
                ),
                type: "GET",
                success: function (response) {
                    var rowHtml = renderCarDemandRow(response, false);
                    row.replaceWith(rowHtml);
                },
            });
        } else {
            row.remove();
        }
    });

    // Delete a row
    $("#car-demand-table").on("click", ".delete-row-btn", function () {
        var row = $(this).closest("tr");
        var id = row.attr("data-row-id");
        if (confirm("Are you sure you want to delete this row?")) {
            if (id) {
                $.ajax({
                    url: "{{ route('car-demands.destroy', ['car_demand' => ':id']) }}".replace(
                        ":id",
                        id
                    ),
                    type: "DELETE",
                    success: function (response) {
                        row.remove();
                    },
                    error: function (response) {
                        alert("Error deleting the car demand");
                    },
                });
            } else {
                row.remove();
            }
        }
    });

    // Render a row of the car demand table
    function renderCarDemandRow(carDemand, isNew) {
        var id = "";
        var deleteBtn = "";
        var saveBtn = "";
        var editBtn = "";
        var cancelBtn = "";
        var inputDisabled = "";
        if (carDemand.id) {
            id = 'data-row-id="' + carDemand.id + '"';
            deleteBtn =
                '<button type="button" class="btn btn-sm btn-danger delete-row-btn row-action-btn">Delete</button>';
            editBtn =
                '<button type="button" class="btn btn-sm btn-primary edit-row-btn row-action-btn">Edit</button>';
        } else if (isNew) {
            saveBtn =
                '<button type="button" class="btn btn-sm btn-success save-row-btn row-action-btn">Save</button>';
            cancelBtn =
                '<button type="button" class="btn btn-sm btn-secondary cancel-row-btn row-action-btn">Cancel</button>';
            inputDisabled = "";
        } else {
            inputDisabled = "disabled";
        }

        var row =
            "<tr " +
            id +
            ">" +
            "<td>" +
            carDemand.supplier +
            "</td>" +
            "<td>" +
            carDemand.whole_seller +
            "</td>" +
            "<td>" +
            carDemand.steering_type +
            "</td>" +
            "<td>" +
            carDemand.car_model +
            "</td>" +
            "<td>" +
            carDemand.car_sfx +
            "</td>" +
            "<td>" +
            carDemand.car_variant +
            "</td>" +
            "<td>" +
            carDemand.color +
            "</td>" +
            '<td><form class="row-form">' +
            '<input type="hidden" name="supplier_id" value="' +
            carDemand.supplier_id +
            '">' +
            '<input type="hidden" name="whole_seller_id" value="' +
            carDemand.whole_seller_id +
            '">' +
            '<input type="hidden" name="steering_type" value="' +
            carDemand.steering_type +
            '">' +
            '<input type="hidden" name="car_model_id" value="' +
            carDemand.car_model_id +
            '">' +
            '<input type="hidden" name="car_sfx_id" value="' +
            carDemand.car_sfx_id +
            '">' +
            '<input type="hidden" name="car_variant_id" value="' +
            carDemand.car_variant_id +
            '">' +
            '<input type="hidden" name="color" value="' +
            carDemand.color +
            '">' +
            '<input type="number" class="form-control input-field" name="jan_23" value="' +
            carDemand.jan_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="feb_23" value="' +
            carDemand.feb_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="mar_23" value="' +
            carDemand.mar_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="apr_23" value="' +
            carDemand.apr_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="may_23" value="' +
            carDemand.may_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="jun_23" value="' +
            carDemand.jun_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="jul_23" value="' +
            carDemand.jul_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="aug_23" value="' +
            carDemand.aug_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="sep_23" value="' +
            carDemand.sep_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="oct_23" value="' +
            carDemand.oct_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="nov_23" value="' +
            carDemand.nov_23 +
            '" ' +
            inputDisabled +
            ">" +
            '<input type="number" class="form-control input-field" name="dec_23" value="' +
            carDemand.dec_23 +
            '" ' +
            inputDisabled +
            ">" +
            "</form></td>" +
            '<td class="text-center">' +
            saveBtn +
            " " +
            editBtn +
            " " +
            cancelBtn +
            " " +
            deleteBtn +
            "</td>" +
            "</tr>";
        return row;
    }
});
