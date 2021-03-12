$(document).ready(function () {

    $('#user_table_filter input').attr('placeholder', 'Cari')

    var oTable = $('#user_table').DataTable({
        "dom": '<"top"<"pull-left"f><"pull-right"l>>rt<"bottom"<"pull-left"i><"pull-right"p>>',
        stateSave: true,
        scrollY: '25vh',
        "scrollX": true,
        scrollCollapse: false,
        paging: false,
        columns: [
            null,
            null,
            {
                orderable: false
            },
        ],
        "language": {
            search: "_INPUT_",
            searchPlaceholder: "Pencarian",
            "search": "",
            "zeroRecords": "Data kosong",
            "info": "Terdapat _END_ baris",
            "infoEmpty": "Data tidak ditemukan",
            "infoFiltered": "dari total _MAX_ baris"
        }
    });

    $('#user_table_filter input').addClass('form-control')
    $('#user_table_filter label').append(`
       <i class="fa fa-search" style="position:absolute; top:13px;left:5px"></i>
    `)

    var allPages = oTable.cells().nodes()

    $('#allcheck').click(function () {
        if ($(this).hasClass('allChecked')) {
            $(allPages).find('input[type="checkbox"]').prop('checked', false);
        } else {
            $(allPages).find('input[type="checkbox"]').prop('checked', true);
        }
        $(this).toggleClass('allChecked');
    })

    $('#pop').popover();

    function ajax(file, email_data, id) {
        var fd = new FormData(document.getElementById('form'));

        if (file.length > 0) {
            $.each(file, function (i, val) {
                fd.append('files[]', val)
            });
        }

        fd.append('email_data', JSON.stringify(email_data));

        $.ajax({
            url: "sendEmail",
            method: "POST",
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#' + id).html('Mengirim...');
                $('#' + id).removeClass('btn-primary')
                $('#' + id).addClass('btn-danger');
            },
            success: function (data) {
                if (data == 'ok' || data.includes(' 25MB.') || data.includes('Kode error upload file')) {
                    if (data.includes(' 25MB.')) {
                        $('#error-file').css('display', 'block')
                        $('#error-file').children().first().children().first().removeClass('alert-danger').addClass('alert-warning')
                        $('#error-file').children().first().children().first().html(data)
                    } else if (data.includes('Kode error upload file')) {
                        $('#error-file').css('display', 'block')
                        $('#error-file').children().first().children().first().html(data)
                    }
                    $('#msg-send').css('display', 'block')
                    $('#msg-send').children().first().children().first().removeClass('btn-danger').addClass('btn-success').css('text-align', 'center')
                    $('#msg-send').children().first().children().first().text('Email Berhasil Dikirim')
                } else {
                    $('#msg-send').css('display', 'block')
                    $('#msg-send').children().first().children().first().removeClass('btn-success').addClass('btn-danger').css('text-align', 'justify')
                    $('#msg-send').children().first().children().first().text(data)
                }
                $('#' + id).html(`
                  <i class="fa fa-send" style="margin-right: 10px;"></i>Kirim Pesan
                  `)
                $('#' + id).removeClass('btn-danger')
                $('#' + id).addClass('btn-primary');
                $('#' + id).attr('disabled', false)
                $('#' + id).css('cursor', 'pointer')
            }
        })
    }

    $('#btn-send').click(function (e) {
        var msg_empty = true
        $('#error-file').css('display', 'none')
        $('#error-file').css('display', 'none').children().first().children().first().removeClass('alert-warning').addClass('alert-danger')
        $('#msg-send').css('display', 'none')
        if (!$('#mail_body').val()) {
            $('#error-msg').css('display', 'block')
        } else {
            $('#error-msg').css('display', 'none')
            msg_empty = false
        }

        var id = $(this).attr("id")
        var email_data = []
        var cek_select = true
        $('.single_select').each(function () {
            if ($(this).prop("checked")) {
                email_data.push({
                    email: $(this).data("email"),
                    name: $(this).data('name')
                });
            }
        })
        if (email_data.length == 0) {
            $('#pop').popover('show')
            cek_select = false
        } else {
            $('#pop').popover('hide')
        }

        if (!cek_select || msg_empty) return

        var konfir = true;
        var total_size = 0;
        var file = $('#file')[0].files;
        if (file.length > 1) {
            konfir = false
            Array.from(file).forEach(el => {
                total_size += el['size'];
            });
        } else if (file.length == 1) {
            if (file[0]['size'] > 1048576) {
                $('#error-file').css('display', 'block')
                $('#error-file').children().first().children().first().text('Batas mengirim file 25MB.')
                $('#msg-send').css('display', 'block')
                $('#msg-send').children().first().children().first().removeClass('btn-success').addClass('btn-danger').css('text-align', 'center')
                $('#msg-send').children().first().children().first().text('Gagal mengirim email')
                return
            } else {
                konfir = true;
            }
        } else {
            konfir = true;
        }

        if (total_size > 1048576) {
            $('body').prepend(`
        <div id='konfir' style="position: fixed; top: 0; bottom: 0; right: 0; left: 0; z-index: 100; display: flex; justify-content: center; align-items: center; background-color:rgba(0, 0, 0,0.3);">
          <div style="transition: all 700ms; background-color: rgba(156, 163, 175, 0); margin-left: 20px; margin-right: 20px; display: none; opacity: 0;">
            <div style="background-color: white; border-radius: 0.6rem; display: flex; flex-direction: column; justify-content: center; justify-items: center; padding: 1rem 1rem 0.9rem 1rem; border-top: 7px solid rgb(55,93,255); box-shadow: rgba(0, 0, 0, 0.6) 0px 0px 4px 0px inset;">
              <p style="margin-bottom: 1.3rem; text-align: justify;font-weight: 600;">Beberapa file tidak akan terkirim. Batas kirim file 25MB. Yakin tetap mengirim email?</p>
              <div id="btn-konfir" style="color: white; display: flex; justify-content: flex-end;">
                <div style="font-weight: 700; border-radius: 1rem; width:5rem; margin-right: 0.5rem; font-size: 0.875rem; line-height: 1.25rem; display: flex; justify-content: center; align-items: center; cursor: pointer; padding-top: 0.25rem;padding-bottom: 0.25rem; transition: all 300ms;" class="buttonBatal">BATAL</div>
                <div class="buttonOk" style="border-radius: 1rem; width: 5rem; font-size: 0.875rem; line-height: 1.25rem; display: flex; justify-content: center; align-items: center; cursor: pointer; transition: all 300ms;" class="hover:bg-red-800 bg-red-600">OK</div>
              </div>
            </div>
          </div>
        </div>
        `)
            $('#konfir').children().first().css('display', 'block')
            setTimeout(function () {
                $('#konfir').children().first().css('opacity', '1')
            }, 10);
            var modal = document.getElementById('konfir')
            var batal = document.getElementsByClassName('buttonBatal')[0]
            var ok = document.getElementsByClassName('buttonOk')[0]

            $(window).click(function (e) {
                if (e.target === modal || e.target === batal) {
                    $('#konfir').children().first().css('opacity', '0')
                    $('#konfir').children().first().on('transitionend MSTransitionEnd webkitTransitionEnd oTransitionEnd', function () {
                        $('#konfir').children().first().css('display', 'none')
                    });
                    setTimeout(function () {
                        $('#konfir').remove()
                    }, 400);
                } else if (e.target === ok) {
                    $('#konfir').children().first().css('opacity', '0')
                    $('#konfir').children().first().on('transitionend MSTransitionEnd webkitTransitionEnd oTransitionEnd', function () {
                        $('#konfir').children().first().css('display', 'none')
                    });
                    setTimeout(function () {
                        $('#konfir').remove()
                        $('#btn-send').attr('disabled', 'disabled')
                        $('#btn-send').css('cursor', 'not-allowed')

                        ajax(file, email_data, id)
                    }, 400);
                }
            })
        }

        if (konfir) {
            $(this).attr('disabled', 'disabled')
            $(this).css('cursor', 'not-allowed')

            ajax(file, email_data, id)
        }
    });

    $('#file').change(function () {
        var file = $('#file')[0].files
        var arrFile = [],
            i = 0;
        Array.from(file).forEach(el => {
            (i == 0) ? arrFile[i] = el['name']: arrFile[i] = ' ' + el['name']
            i++
        })
        if (arrFile != '') {
            $(this).prev('label').text(arrFile + ' ')
        }
    })

})