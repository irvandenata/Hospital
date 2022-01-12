<script>
    const child_url = "{!! Request::url() !!}";
    var titles = ""
    var methods = ""
    var ids = 0
    function setForm(saved, method, title) {
        save_method = saved;
        titles = title
        methods = method
        $('input[name=_method]').val(method);
        $('#modalForm form')[0].reset();
        $(':input[name=id]').val('');
        $('#modalFormTitle').text(title);
        $('#modalForm').modal('show');
    }

    function editData(id) {
        $.ajax({
            url: child_url + "/" + id + "/edit",
            type: "GET",
            dataType: "json",
            success: function(result) {

                setData(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
    }

    function setUrl() {
        var id = $('#id').val();
        ids = id
        if (save_method == "create") url = child_url;
        else url = child_url + '/' + id;

        return url;
    }

    /** ambil data error**/
    function getError(errors) {
        $.each(errors, function(index, value) {
            value.filter(function(obj) {
                return error = obj;
            });
            toastr.error(error, 'Error', {
                closeButton: true,
                progressBar: true,
            });
        });
    }

    /** save data onsubmit**/
    $(function() {
        $('#modalForm form').on('submit', function(e) {

            if (!e.isDefaultPrevented()) {
                saveAjax(setUrl());
                return false;
            }

        });
    });
    function updateProgress(percentage){
    if(percentage > 100) percentage = 100;
    $('#progressBar').css('width', percentage+'%');
    $('#progressBar').html(percentage+'%');
}
        var file ;
        $('#file').change(function(e){
            var fileName = e.target.files[0].name;
           file = e.target.files[0];

            // alert('The file "' + fileName +  '" has been selected.');
        });
    function saveAjax(url) {


        // alert(file)
        if(titles=="Tambah Model" || titles=="Ubah Model"){

            let simpan = $('#simp')
                var resumable = new Resumable({
                target:child_url,
                // uploadMethod:methods,
                // method:'multipart',
                query:{
                    _token:'{{ csrf_token() }}',
                   data: $('#nama').val(),
                   id: ids

                     },
                headers:{
                    'Accept' : 'application/json'
                },
                testChunks:false,
                throttleProgressCallbacks:1

            });


            // alert(file);
            resumable.addFile(file);
            resumable.on('fileAdded', function (file) { // trigger when file picked
                showProgress();
                // console.log(file);
                // if(methods == "PUT"){
                //     // console.log(file);

                //     resumable.upload()
                // }else{
                    resumable.upload()
                // }
                 // to actually start uploading.
            });

            resumable.on('fileProgress', function (file) { // trigger when file progress update
                updateProgress(Math.floor(file.progress() * 100));
            });

            resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
                response = JSON.parse(response)
                // resumable.abort()

                $('#modalForm').modal('hide');
                reloadDatatable();

                Toast.fire({
                    icon: 'success',
                    title: 'successfully'
                })
            });

            resumable.on('fileError', function (file, response) { // trigger when there is any error
                alert('file uploading error.')
            });


            let progress = $('.progress');
            function showProgress() {
                progress.find('.progress-bar').css('width', '0%');
                progress.find('.progress-bar').html('0%');
                progress.find('.progress-bar').removeClass('bg-success');
                progress.show();
            }

            function updateProgress(value) {
                progress.find('.progress-bar').css('width', `${value}%`)
                progress.find('.progress-bar').html(`${value}%`)
            }

            function hideProgress() {
                progress.hide();
            }


            }else{
        Swal.fire({
            type: 'warning',
            html:`<div class="progress"> <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div> </div>`,
            text: 'Please wait.',
            showCancelButton: false,
            confirmButtonText: "ok",
            allowOutsideClick: false,
            allowEscapeKey: false
        })
        Swal.showLoading()

        $.ajax({
            url: url,
            type: "post",
            cache: false,
            dataType: 'json',
            data: new FormData($('#modalForm form')[0]),
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: true,
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                //Upload Progress
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                    var percentComplete = (evt.loaded / evt.total) * 100; $('div.progress > div.progress-bar').css({ "width": percentComplete + "%" }); } }, false);

            //Download progress
            xhr.addEventListener("progress", function (evt)
            {
            if (evt.lengthComputable)
            { var percentComplete = (evt.loaded / evt.total) *100;
            $("div.progress > div.progress-bar").css({ "width": percentComplete + "%" }); } },
            false);
            return xhr;
            },
            success: function(result) {
                $('#modalForm').modal('hide');
                reloadDatatable();

                Toast.fire({
                    icon: 'success',
                    title: 'successfully'
                })

                // toastr.success('Berhasil Disimpan', 'Success');
            },
            error: function(result) {
                $('#modalForm').modal('hide');

                if (result.responseJSON) {
                    getError(result.responseJSON.errors);
                } else {
                    console.log(result);
                }
            },
        })
    }
    }

    /** konfirmasi hapus data **/
    function deleteConfirm(id) {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true,
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Kamu Akan Menghapus Data Ini!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus!',
            cancelButtonText: 'No, Keluar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                deleteData(id);
                swalWithBootstrapButtons.fire(
                    'Dihapus!',
                    'Data Telah Dihapus',
                    'success'
                )

            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Batal',
                    'Proses Telah dibatalkan',
                    'error'
                )
            }
        })
    }

    /** hapus data dari database **/
    function deleteData(id) {
        var url = child_url + '/' + id;
        Swal.fire({
            type: 'warning',
            text: 'Please wait.',
            showCancelButton: false,
            confirmButtonText: "ok",
            allowOutsideClick: false,
            allowEscapeKey: false
        })
        Swal.showLoading()
        $.ajax({
            url: url,
            type: "DELETE",

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_token": "{{ csrf_token() }}",

            },

            success: function(result) {
                reloadDatatable();
                Toast.fire({
                    icon: 'success',
                    title: 'Delete successfully'
                })

                // toastr.success('Berhasil Dihapus', 'Success');
            },
            error: function(errors) {
                getError(errors.responseJSON.errors);
            }
        });
    }

</script>
