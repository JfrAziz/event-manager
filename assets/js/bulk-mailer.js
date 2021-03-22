$(document).ready(function () {

    let data_checked = {}
    $('#search').keyup(function () {
        let input = $(this).val()
        let nameEvent = $('#select-event select').val()

        $('.single_select').each(function () {
            data_checked[$(this).attr("name")] = $(this).data("checked")
        })

        $.ajax({
            type: "POST",
            url: "searchAjax",
            data: {
                input: input,
                nameEvent: nameEvent,
                data_checked: data_checked
            },
            success: function (response) {
                $('#user_table tbody').html(response)

                Array.from(document.getElementsByClassName('single_select')).forEach(el => {
                    if (el.getAttribute("data-checked") === "true") {
                        el.checked = true
                    }
                })

                $('.single_select').click(function () {
                    $(this).attr("data-checked", $(this).prop("checked") ? "true" : "false")
                })

            }
        })
    })

    $('#select-event select').change(function () {
        let input = $('#search').val()
        let nameEvent = $(this).val()

        $('.single_select').each(function () {
            data_checked[$(this).attr("name")] = $(this).data("checked")
        })

        $.ajax({
            type: "POST",
            url: 'changeEvent',
            data: {
                input: input,
                nameEvent: nameEvent,
                data_checked: data_checked
            },
            success: function (response) {
                $('#user_table tbody').html(response)
                Array.from(document.getElementsByClassName('single_select')).forEach(el => {
                    if (el.getAttribute("data-checked") === "true") {
                        el.checked = true
                    }
                })
                $('.single_select').click(function () {
                    $(this).attr("data-checked", $(this).prop("checked") ? "true" : "false")
                })
            }
        });
    })

    $('#allcheck').click(function () {
        $('.single_select').prop('checked', $(this).prop('checked'))
        $('.single_select').attr("data-checked", $('.single_select').prop("checked") ? "true" : "false")
        $(this).attr("data-checked", $(this).prop("checked") ? "true" : "false")
    })

    $('.single_select').click(function () {
        $(this).attr("data-checked", $(this).prop("checked") ? "true" : "false")
    })

    $('#user_table').DataTable({
        "dom": '<"top"<"pull-left"f><"pull-right"l>>rt<"bottom"<"pull-left"i><"pull-right"p>>',
        stateSave: true,
        scrollY: '25vh',
        "scrollX": true,
        filter: false,
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

    $('#pop').popover();

    function ajax(file, email_data, id) {
        var fd = new FormData(document.getElementById('form'))

        if (file.length > 0) {
            $.each(file, function (i, val) {
                fd.append('files[]', val)
            });
        }

        fd.append('email_data', JSON.stringify(email_data))

        $.ajax({
            url: "sendEmail",
            method: "POST",
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#' + id).toggleClass('d-none')
                $('.btn-loading').toggleClass('d-none').css('cursor', 'not-allowed')
            },
            success: function (data) {
                if (data == 'ok' || data.includes('maksimal upload di form html.') || data.includes('Kode error upload file')) {
                    if (data.includes('maksimal upload di form html.')) {
                        $('#error-file').removeClass('d-none')
                        $('#error-file').removeClass('alert-danger').addClass('alert-warning')
                        $('#error-file').children().first().html(data)
                    } else if (data.includes('Kode error upload file')) {
                        $('#error-file').removeClass('d-none')
                        $('#error-file').children().first().html(data)
                    }
                    $('#msg-send').removeClass('d-none')
                    $('#msg-send').removeClass('btn-danger').addClass('btn-success').css('text-align', 'center')
                    $('#msg-send').children().first().text('Email Berhasil Dikirim')
                    $('form').trigger('reset')
                    $('#file').prev('label').text('Pilih file')
                } else {
                    $('#msg-send').removeClass('d-none')
                    $('#msg-send').removeClass('btn-success').addClass('btn-danger').css('text-align', 'justify')
                    $('#msg-send').children().first().text(data)
                }
                $('#' + id).toggleClass('d-none')
                $('.btn-loading').toggleClass('d-none').css('cursor', 'pointer')
            }
        })
    }

    function confirm(msg) {
        return $('body').prepend(`
        <div id='konfir' style="position: fixed; top: 0; bottom: 0; right: 0; left: 0; z-index: 100; display: flex; justify-content: center; align-items: center; background-color:rgba(0, 0, 0,0.3);">
        <div style="transition: all 700ms; background-color: rgba(156, 163, 175, 0); margin-left: 20px; margin-right: 20px; display:none; opacity:0;">
          <div style="background-color: white; border-radius: 0.6rem; display: flex; flex-direction: column; justify-content: center; justify-items: center; padding: 1rem 1rem 0.9rem 1rem; border-top: 7px solid #bf4aa8; box-shadow: rgba(0, 0, 0, 0.6) 0px 0px 4px 0px inset;">
            <p style="margin-bottom: 1.3rem; text-align: justify;font-weight: 600;">${msg}</p>
            <div id="btn-konfir" style="color: white; display: flex; justify-content: flex-end;">
              <div style="font-weight: 700; border-radius: 1rem; width:5rem; margin-right: 0.5rem; font-size: 0.875rem; line-height: 1.25rem; display: flex; justify-content: center; align-items: center; cursor: pointer; padding-top: 0.25rem;padding-bottom: 0.25rem; transition: all 300ms;" class="buttonBatal">BATAL</div>
              <div class="buttonOk" style="border-radius: 1rem; width: 5rem; font-size: 0.875rem; line-height: 1.25rem; display: flex; justify-content: center; align-items: center; cursor: pointer; transition: all 300ms;">OK</div>
            </div>
          </div>
        </div>
      </div>
        `)
    }

    $('#btn-send').click(function () {
        var msg_empty = true
        $('#error-file').addClass('d-none').removeClass('alert-warning').addClass('alert-danger')
        $('#msg-send').addClass('d-none')
        if (!$('#mail_body').val()) {
            $('#error-msg').removeClass('d-none')
        } else {
            $('#error-msg').addClass('d-none')
            msg_empty = false
        }

        var id = $(this).attr("id"),
            email_data = [],
            cek_select = true
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

        var konfir = true,
            total_size = 0,
            file = $('#file')[0].files
        if (file.length >= 1) {

            var File = [],
                i = 0,
                j = 0,
                size_right_file = 0,
                File_unsend = []
            konfir = false
            Array.from(file).forEach(el => {
                if ((size_right_file + el['size']) <= 1048576) {
                    File[i] = el
                    i++
                    size_right_file += el['size']
                } else {
                    File_unsend[j] = el
                    j++
                }
                total_size += el['size']
            })

            if (File.length == file.length == 1) {
                konfir = true
            }
        }

        if (total_size > 1048576) {
            if (file.length == 1) {
                confirm('File tidak akan terkirim. Batas kirim file 25MB. Yakin tetap mengirim email?')
            } else if (File.length == 0 && file.length != 1) {
                confirm('Semua file tidak akan terkirim. Batas kirim file 25MB. Yakin tetap mengirim email?')
            } else {
                confirm('Beberapa file tidak akan terkirim. Batas kirim file 25MB. Yakin tetap mengirim email?')
            }
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
                        ajax(File, email_data, id)
                        let data = ``
                        $.each(File_unsend, function (i, el) {
                            data += `File <strong>${el['name']}</strong> tidak terkirim karena batas maksimal mengirim file 25MB. <br>`
                        })
                        $('#error-file').removeClass('d-none')
                        $('#error-file').removeClass('alert-danger').addClass('alert-warning')
                        $('#error-file').children().first().html(data)
                    }, 400);
                }
            })
        } else {
            konfir = true
        }

        if (konfir) {
            ajax(file, email_data, id)
        }
    })

    $('#file').change(function () {
        var file = $('#file')[0].files
        var arrFile = [],
            i = 0;
        Array.from(file).forEach((el, i) => {
            if (i == 0) {
                arrFile[i] = `<strong>${el['name']}</strong>`
            } else if (i > 0 && i % 2 == 1) {
                arrFile[i] = ` ${el['name']}`
            } else {
                arrFile[i] = `<strong>  ${el['name']}</strong>`
            }
        })
        if (arrFile != '') {
            $(this).prev('label').html(`${arrFile}`)
        }
    })

})