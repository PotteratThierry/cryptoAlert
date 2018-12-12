$(function() {

    // initial sort set using sortList option
    $(".table1").tablesorter({
        theme : 'blue',
        // sort on the first column and second column in ascending order
        sortList: [[0,0],[1,0]]
    });

    // initial sort set using data-sortlist attribute (see HTML below)
    $(".table2").tablesorter({
        theme : 'blue'
    });

});
/*$(function() {

    var $table = $('table').tablesorter({
        theme: 'blue',
        widgets: ["zebra", "filter"],
        widgetOptions : {
            // filter_anyMatch replaced! Instead use the filter_external option
            // Set to use a jQuery selector (or jQuery object) pointing to the
            // external filter (column specific or any match)
            filter_external : '.search',
            // add a default type search to the first name column
            filter_defaultFilter: { 1 : '~{query}' },
            // include column filters
            filter_columnFilters: true,
            filter_placeholder: { search : 'Search...' },

            // extra css class applied to the table row containing the filters & the inputs within that row
            filter_cssFilter   : '',

            // If there are child rows in the table (rows with class name from "cssChildRow" option)
            // and this option is true and a match is found anywhere in the child row, then it will make that row
            // visible; default is false
            filter_childRows   : false,

            // if true, filters are collapsed initially, but can be revealed by hovering over the grey bar immediately
            // below the header row. Additionally, tabbing through the document will open the filter row when an input gets focus
            filter_hideFilters : false,

            // Set this option to false to make the searches case sensitive
            filter_ignoreCase  : true,

            // jQuery selector string of an element used to reset the filters
            filter_reset : '.reset',

            // Use the $.tablesorter.storage utility to save the most recent filters
            filter_saveFilters : true,

            // Delay in milliseconds before the filter widget starts searching; This option prevents searching for
            // every character while typing and should make searching large tables faster.
            filter_searchDelay : 300,

            // Set this option to true to use the filter to find text from the start of the column
            // So typing in "a" will find "albert" but not "frank", both have a's; default is false
            filter_startsWith  : false,

            // Add select box to 4th column (zero-based index)
            // each option has an associated function that returns a boolean
            // function variables:
            // e = exact text from cell
            // n = normalized value returned by the column parser
            // f = search filter input value
            // i = column index
            filter_functions : {
                5: { sorter: "select" },
                // Add select menu to this column
                // set the column value to true, and/or add "filter-select" class name to header
                // '.first-name' : true,

                // Add these options to the select dropdown (regex example)
                2 : {
                    "A - D" : function(e, n, f, i, $r, c, data) { return /^[A-D]/.test(e); },
                    "E - H" : function(e, n, f, i, $r, c, data) { return /^[E-H]/.test(e); },
                    "I - L" : function(e, n, f, i, $r, c, data) { return /^[I-L]/.test(e); },
                    "M - P" : function(e, n, f, i, $r, c, data) { return /^[M-P]/.test(e); },
                    "Q - T" : function(e, n, f, i, $r, c, data) { return /^[Q-T]/.test(e); },
                    "U - X" : function(e, n, f, i, $r, c, data) { return /^[U-X]/.test(e); },
                    "Y - Z" : function(e, n, f, i, $r, c, data) { return /^[Y-Z]/.test(e); }
                },

                // Add these options to the select dropdown (numerical comparison example)
                // Note that only the normalized (n) value will contain numerical data
                // If you use the exact text, you'll need to parse it (parseFloat or parseInt)
                4 : {
                    "< $10"      : function(e, n, f, i, $r, c, data) { return n < 10; },
                    "$10 - $100" : function(e, n, f, i, $r, c, data) { return n >= 10 && n <=100; },
                    "> $100"     : function(e, n, f, i, $r, c, data) { return n > 100; }
                }
            }
        }
    });*/

  /*  // make demo search buttons work
    $('button[data-column]').on('click', function() {
        var $this = $(this),
            totalColumns = $table[0].config.columns,
            col = $this.data('column'), // zero-based index or "all"
            filter = [];

        // text to add to filter
        filter[ col === 'all' ? totalColumns : col ] = $this.text();
        $table.trigger('search', [ filter ]);
        return false;
    });

});*/