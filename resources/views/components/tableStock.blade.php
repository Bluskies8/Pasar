<div class="table-responsive">
    <table class="table table-hover" id="table-transaksi">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Lapak</th>
                <th>Checker</th>
                <th>Tanggal</th>
                <th colspan="2">Total</th>
                <th>Deleted_at</th>
                <th style="width: 50px;"></th>
            </tr>
        </thead>
        <tbody>
            @isset($data)
            @foreach ($data as $item)
            @if ($item['deleted']!=null)
                <tr class = "disabled">
            @else
                <tr>
            @endif
                <td class="cell-id text-center">{{ $item->id }}</td>
                <td class="text-center">{{ $item->stand->seller_name }}</td>
                <td class="text-center">{{ $item->checker->name }}</td>
                <td class="text-center">{{ $item->created_at }}</td>
                <td>Rp</td>
                <td class="text-end thousand-separator">{{ $item->total_harga }}</td>
                <td class="text-center">{{ $item->deleted_at }}</td>
                <td class="position-relative" style="padding: 4px 8px;">
                    <button id="btn-{{ $item->id }}" class="btn btn-sm show-aksi" type="button" style="background: #38A34A;color: white;"><i class="fas fa-bars fa-lg"></i></button>
                </td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table>
    @isset($data)
    <div class="d-flex justify-content-between align-items-center px-2">
        Menampilkan {{ $data->firstItem() }} hingga {{ $data->lastItem() }} dari {{ $data->total() }}
        {{ $data->links() }}
    </div>
    @endisset
</div>

<style>
    .pagination {
        margin-bottom: 0;
    }
</style>
