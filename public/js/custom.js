
$(function() {
    // $.ajaxSetup({
    //     headers: {
    //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    //     }
    // });
    // $("#createCompany").submit(function(e) {
    //     e.preventDefault();
    //     var formData = new FormData(this);
    //     $.ajax({
    //         type: "POST",
    //         dataType: "json",
    //         //url: "{{ route('createCompany') }}",
    //         url: "{{url('createCompany')}}",
    //         data: formData,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         success: data => {
    //             this.reset();
    //             alert("Image has been uploaded using jQuery ajax successfully");
    //         },
    //         error: function(data) {
    //             console.log(data);
    //         }
    //     });
    // });
});

$("#createCompany").validate({
    rules: {
        name: "required",
        email: {
            email: true
        }
    },
    messages: {
        name: "Company Name is required.",
        email: "Please enter a valid email address"
    }
});
function previewImage(image) {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("logo").files[0]);

    oFReader.onload = function(oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
}

/**
 * That functions delete selected company
 * @param {int} companyId
 */
function deleteCompany(companyId) {
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: "/home/" + companyId + "/delete",
        type: "DELETE",
        data: {
            companyId: companyId,
            _token: token
        },
        success: function(response) {
            if (response.success) {
                alert(response.success);
                location.reload();
            }
        }
    });
}
