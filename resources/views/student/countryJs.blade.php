
<script>
    $(document).ready(function () {
    $('select[name="province"]').on('change', function () {
        var provinceID = $(this).val();
        var url = '{{ route("location.getDistricts", ":id") }}';
        if (provinceID) {
            $.ajax({
                url: url.replace(':id', provinceID),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="district"]').empty();
                    $('select[name="sector"]').empty();
                    $('select[name="cell"]').empty();
                    $('select[name="village"]').empty();

                    $('select[name="district"]').append('<option value="">Select</option>');
                    $.each(data, function (key, value) {
                        $('select[name="district"]').append('<option value="' +
                        value.district + '">' + value.district + '</option>');
                    });
                }
            });
        } else {
            $('select[name="district"]').empty();
        }
    });
});
$(document).ready(function () {
    $('select[name="district"]').on('change', function () {
        var districtID = $(this).val();
        var url = '{{ route("location.getSectors", ":id") }}';
        if (districtID) {
            $.ajax({
                url: url.replace(':id', districtID),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="sector"]').empty();
                    $('select[name="cell"]').empty();
                    $('select[name="village"]').empty();
                    $('select[name="sector"]').append('<option value="">Select</option>');
                    $.each(data, function (key, value) {
                        $('select[name="sector"]').append('<option value="' +
                        value.sector + '">' + value.sector + '</option>');
                    });
                }
            });
        } else {
            $('select[name="sector"]').empty();
        }
    });
});
$(document).ready(function () {
    $('select[name="sector"]').on('change', function () {
        var sectorID = $(this).val();
        var url = '{{ route("location.getCells", ":id") }}';
        if (sectorID) {
            $.ajax({
                url: url.replace(':id', sectorID),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="cell"]').empty();
                    $('select[name="village"]').empty();

                    $('select[name="cell"]').append('<option value="">Select</option>');
                    $.each(data, function (key, value) {
                        $('select[name="cell"]').append('<option value="' +
                            value.cell + '">' + value.cell + '</option>');
                    });
                }
            });
        } else {
            $('select[name="cell"]').empty();
        }
    });
});
$(document).ready(function () {
    $('select[name="cell"]').on('change', function () {
        var cellID = $(this).val();
        var url = '{{ route("location.getVillages", ":id") }}';
        if (cellID) {
            $.ajax({
                url: url.replace(':id', cellID),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="village"]').empty();
                    $('select[name="village"]').append('<option value="">Select</option>');
                    $.each(data, function (key, value) {
                        $('select[name="village"]').append('<option value="' +
                        value.village + '">' + value.village + '</option>');
                    });
                }
            });
        } else {
            $('select[name="village"]').empty();
        }
    });
});

</script>
