@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script>

        // var disable_dates = [];
        // $(document).ready(function () {
        //     $('#calendar').fullCalendar({
        //         selectable: true,
        //         // hiddenDays: [0],
        //         select: function (start, end, jsEvent, view) {
        //             var selectedDate = start.format('YYYY-MM-DD');
        //
        //             var numberToPush = selectedDate;
        //
        //             if (disable_dates.indexOf(numberToPush) === -1) {
        //                 disable_dates.push(numberToPush);
        //             }
        //             disable_date();
        //
        //         },
        //         dayRender: function (date, cell) {
        //
        //             if (date.day() === 0) {
        //                 cell.addClass('disabled');
        //             }
        //         },
        //     });
        //
        //     function handleDateSelection(date, cell) {
        //         var formattedDate = date.format('YYYY-MM-DD');
        //
        //         if ($.inArray(date.format('YYYY-MM-DD'), disable_dates) === -1) {
        //             cell.addClass('disabled');
        //         }
        //
        //         // console.log(formattedDate);
        //         // Perform any additional operations on the selected date
        //     }
        // });
        //
        // function disable_date() {
        //     console.log(disable_dates)
        //
        // }
    </script>

    <script>
        $(document).ready(function() {
            var start_date = '2023-05-01 10:35:24'
            console.log(start_date)
        })

    </script>

    <script>
        // var disable_dates = [];
        // $(document).ready(function() {
        //     function handleDateSelection(date,cell) {
        //         // cell.addClass('disabled');
        //         console.log('sdf')
        //         var formattedDate = date.format('YYYY-MM-DD');
        //
        //         if ($.inArray(date.format('YYYY-MM-DD'), disable_dates) === -1 ) {
        //             cell.addClass('disabled');
        //         }
        //
        //         // console.log(formattedDate);
        //         // Perform any additional operations on the selected date
        //     }
        //     $('#calendar').fullCalendar({
        //         header: false, // Hide the header with navigation buttons
        //         defaultView: 'month', // Show only a single month at a time
        //         selectable: true,
        //         select: function(start, end, jsEvent, view) {
        //             var selectedDate = start.format('YYYY-MM-DD');
        //             var numberToPush = selectedDate;
        //
        //             if (disable_dates.indexOf(numberToPush) === -1) {
        //                 disable_dates.push(numberToPush);
        //             }
        //             disable_date();
        //         },
        //
        //         dayClick: function(date, jsEvent, view) {
        //             var cell = $(jsEvent.target).closest('.fc-day');
        //             handleDateSelection(date,cell);
        //
        //         },
        //         dayRender: function(date, cell) {
        //
        //             if (date.day() === 0 ) {
        //                 cell.addClass('disabled');
        //             }
        //         },
        //         selectAllow: function(selectInfo) {
        //             var selectedDate = selectInfo.start.format('YYYY-MM-DD');
        //             var dayOfWeek = selectInfo.start.day();
        //             if (dayOfWeek === 0) {
        //                 return false; // Disable selection on Sundays
        //             }
        //             return true; // Allow selection on other days
        //         }
        //     });
        // });
        // function disable_date(){
        //     console.log(disable_dates)
        // }
    </script>
    <style>
        .disabled {
            opacity: 0.5;
            background-color: #f2f2f2;
            pointer-events: none;
        }
    </style>
@endpush
