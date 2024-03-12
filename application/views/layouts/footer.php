</div>
<!-- Footer -->
<!-- End of Footer -->
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    flashdata = <?php echo json_encode($this->session->flashdata())?>;
        if(!Array.isArray(flashdata)){
            if(flashdata.success == true){
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    timer: 5000,
                    timerProgressBar: true,
                    title: flashdata.message,
                    icon: "success",
                    showConfirmButton: false,
                })
            }else{
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    timer: 3000,
                    timerProgressBar: true,
                    title: flashdata.message,
                    icon: "error",
                    showConfirmButton: false,
                })
            }
        }
</script>
</html>