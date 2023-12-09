{{-- CSS --}}
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
@endpush

{{-- Table --}}
<section class="table">
    <div class="container">
        <div class="heading">
            <p>{{ $title }}</p>
        </div>
        <div class="content">
            <div class="navigation">
                {{ $button }}
            </div>
            <hr>
            <table id="myTable" class="cell-border compact">
                <thead class="{{ $color }}">
                    {{ $head }}
                </thead>
                <tbody>
                    {{ $body }}
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Script --}}
@push('script')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            "ordering": false
        });
    } );
</script>
@endpush