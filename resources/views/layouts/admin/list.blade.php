@extends("layouts.admin.app")

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alertBox">
                    <div class="alertIcon">
                        <iconify-icon icon="ion:alert-circle-outline"></iconify-icon>
                    </div>
                    <p>Are you sure you want to delete this item?</p>
                    <div class="alertBtn">
                        {!! html()->form('DELETE')->attributes(['id' => 'delete-form'])->open() !!}

                        <button class="finalDelete" type="button">Delete</button>
                        {!! html()->form()->close() !!}
                        <button class="cancel" data-bs-dismiss="modal" aria-label="Close" class="btn-close">Cancel</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push("scripts")
<!-- DataTables  & Plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/r-2.5.0/datatables.min.js"></script>
<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/r-2.5.0/datatables.min.css" rel="stylesheet">
<script>
    $(document).ready(function() {
        $(".delete").on("click", function(e) {
            //console.log("delete event");
            $("#delete-form").attr('action', this.getAttribute("data-route"));
            //console.log($("#delete-form").attr("action"));

        });
        $(".finalDelete").on("click", function(e) {
            e.preventDefault();
            //console.log("final delete event");

            //console.log($("#delete-form").attr("action"));
            $("#delete-form").submit();
        });
    });

    $(document).ready(function() {
        $("#example1")
            .DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                order: [],
                // buttons: [
                //     "copy",
                //     "csv",
                //     "excel",
                //     "pdf",
                //     "print",
                //     "colvis",
                // ],
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");

        $("#example2").DataTable({
            dom: 'Bfrtip',
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            searching: true,
            buttons: ['csv', 'excel', 'pdf']
        });
    });
</script>
@endpush