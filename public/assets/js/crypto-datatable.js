//______Data-Table

$('#crypto-data-table').DataTable({
    "order": [
        [0, "desc"]
    ],
    order: [],
    columnDefs: [{ orderable: false, targets: [0, 4, 5] }],
    language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
    }
});

// Select2

$('.dataTables_length select').select2({
    minimumResultsForSearch: Infinity
});