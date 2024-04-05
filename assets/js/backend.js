(function ($) {

    $(document).ready(function () {

        //Select2
        $('.users').select2();
        
        $('#update_clients').DataTable();
        $('#global_predefined_tasks').DataTable();
        $('#local_predefined_tasks').DataTable();
        $('#show_quotes').DataTable();
        $('#show_quotes_to_invoice').DataTable();
        $('#show_invoices').DataTable();

        
    });
})(jQuery);




