<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        if ('<?= $this->session->flashdata('alert') ?>' == 'success') {
            var timerInterval;
            Swal.fire({
                title: "Berhasil!",
                icon: "success",
                html: '<?= $this->session->flashdata('message') ?> <br><b></b> milliseconds.',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            })

        } else if ('<?= $this->session->flashdata('alert') ?>' == 'error') {
            Swal.fire(
                'Gagal!',
                '<?= $this->session->flashdata('message') ?>',
                'error'
            )
        }
    })

    
</script>