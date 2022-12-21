<div class="btn-group">
    <div class="ms-auto text-end">
        @if (auth()->user()->position=='Admin')
        <a class="btn btn-warning" href="{{ $edit }}"><i class="bi bi-pencil" aria-hidden="true"></i></a>
        <a class="btn btn-danger" href="#" onclick="showDeleteConfirm({{ $data->id }})"><i
                class="bi bi-trash"></i></a>
        <form id="delete-form{{ $data->id }}"
            action="{{ route('historyfeed.destroy', ['historyfeed' => $data->id]) }}" method="POST" class="d-none">
            <input type="hidden" name="_method" value="DELETE">
            @csrf
        @else
            <div class="text-center">
                <p>-</p>
            </div>
        @endif
        </form>
        {{-- <a class="btn btn-link text-success px-3 mb-0" data-bs-toggle="modal" data-bs-target="#jumlahPrint"
            onclick="jumlahPrint({{ $data->id }})"><i class="fa fa-qrcode text-success me-2"
                aria-hidden="true"></i>Cetak QR</a> --}}
    </div>
</div>
