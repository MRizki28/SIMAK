function paramsUrl(url, params) {
    if (params) {
        return url + '?' + $.param(params)
    }
    return url
}

function paginationLink(element, params) {
    params.data.links.forEach((link, index) => {
        if (index === 0) {
            element.append(`
                <li class="page-item ${params.data.prev_page_url ? '' : 'disabled'}">
                    <a class="page-link" href="${params.data.prev_page_url || '#'}" aria-label="Previous" id="pagination-prev" >
                        <span aria-hidden="true">«</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            `)
        } else if (index === params.data.links.length - 1) {
            element.append(`
                <li class="page-item ${params.data.next_page_url ? '' : 'disabled'}">
                    <a class="page-link" href="${params.data.next_page_url || '#'}" aria-label="Next" id="pagination-next" >
                        <span aria-hidden="true">»</span></span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            `)
        } else {
            element.append(`
                <li class="page-item ${link.active ? 'active' : ''}"><a class="page-link" href="${link.url}">${link.label}</a></li>
            `)
        }
    })
}

function dateRangePickerSetup(element) {
    element.daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'YYYY-MM-DD',
            cancelLabel: 'Bersihkan',
            applyLabel: 'Gunakan'
        },
    })

    element.on('apply.daterangepicker', function (ev, picker) {
        const startDate = picker.startDate.format('YYYY-MM-DD');
        const endDate = picker.endDate.format('YYYY-MM-DD');
        console.log("Start Date:", startDate);
        console.log("End Date:", endDate);

        console.log($(this).data('start-date'));
        console.log($(this).data('end-date'));

        $(this).val(startDate + ' s/d ' + endDate);
        $(this).data('start-date', startDate);
        $(this).data('end-date', endDate);
    });


    element.on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
        $(this).data('start-date', '')
        $(this).data('end-date', '')
    });
}

function successAlert() {
    return Swal.fire({
        title: 'Success',
        text: 'Data berhasil ditambahkan',
        icon: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
    })
}

function successResetPasswordAlert() {
    return Swal.fire({
        title: 'Success',
        text: 'Password berhasil direset',
        icon: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
    })
}

function successSettingPasswordAlert() {
    return Swal.fire({
        title: 'Success',
        text: 'Password berhasil diperbaharui',
        icon: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
    })
}

function errorAlert() {
    Swal.fire({
        title: 'Error!',
        text: 'Terjadi kesalahan',
        icon: 'error',
        timer: 5000,
        showConfirmButton: true
    }).then(function () {
        window.location.reload();
    });
}

function warningAlert() {
    Swal.fire({
        title: 'Peringatan',
        text: 'Input tidak boleh kosong !',
        icon: 'warning',
        timer: 5000,
        showConfirmButton: true
    });
}

function protectedAlert() {
    Swal.fire({
        title: 'warning',
        text: 'Anda telah melakukan perubahan terhadap sistem, anda akan di kembalikan ke halaman home!',
        icon: 'warning',
        timer: 5000,
        showConfirmButton: false
    });
}

function warningExtentionAlert() {
    Swal.fire({
        title: 'Peringatan',
        text: 'Format file tidak di dukung !',
        icon: 'warning',
        timer: 5000,
        showConfirmButton: true
    });
}

function deleteAlert() {
    return Swal.fire({
        title: 'Hapus ?',
        text: 'Anda tidak dapat mengembalikan  ini',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Ya',
        reverseButtons: true,
    })
}

function failedDeleteDataAlert() {
    Swal.fire({
        title: 'Gagal menghapus data',
        text: 'Data sedang digunakan !',
        icon: 'error',
        timer: 5000,
        showConfirmButton: true
    });
}

function successDeleteAlert() {
    return Swal.fire({
        title: 'Success',
        text: 'Data berhasil dihapus',
        icon: 'success',
        timer: 5000,
        showConfirmButton: true
    })
}

$(document).ready(function () {
    $.validator.addMethod("fileExtension", function (value, element) {
        return this.optional(element) || /\.(docx|png|jpg|jpeg|xlsx|xls|csv|doc|pdf)$/i.test(value);
    },
        "Hanya file dengan ekstensi docx, png, jpg, jpeg, xlsx, xls, csv, doc, atau pdf yang diperbolehkan."
    );
});

function encryptToken(token, key) {
    return CryptoJS.AES.encrypt(token, key).toString();
}

function decryptToken(tokenEncrpyt, key) {
    let bytes = CryptoJS.AES.decrypt(tokenEncrpyt, key);
    return bytes.toString(CryptoJS.enc.Utf8)
}

function protectedModificationSystem(event) {
    if (event.originalEvent.storageArea === localStorage) {
        protectedAlert();
        setTimeout(function () {
            window.location.href = "/";
        }, 3000);
    }
}

function insertLineBreaks(text, wordsPerLine) {
    const words = text.split(' ');
    let newText = '';
    let wordCount = 0;

    for (let i = 0; i < words.length; i++) {
        newText += words[i] + ' ';
        wordCount++;

        if (wordCount === wordsPerLine) {
            newText += '<br>';
            wordCount = 0;
        }
    }

    return newText.trim();
}