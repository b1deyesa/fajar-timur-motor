<section class="edit">
    <div class="container">
        <div class="heading">
            <p>{{ $title }}</p>
        </div>
        <div class="content">
            <div class="button">
               {{ $button }}
            </div>
            <hr>
            <form method="POST" action="{{ $route }}">
                @csrf
                @method('PUT')
                <table>
                    {{ $slot }}
                    <tr>
                        <td colspan="3">
                            <div class="navigation">
                                {{ $navigation }}
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>