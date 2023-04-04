<div class="table-responsive">
    <table class="table table-hover" id="table-transaksi">
        <thead>
            <tr>
                <th>NO. Stand</th>
                <th>Nama Lapak</th>
                <th>Nama Penjual</th>
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
                <td class="cell-id text-center">{{ $item->no_stand }}</td>
                <td class="text-center">{{ $item->badan_usaha }}</td>
                <td class="text-center">{{ $item->seller_name }}</td>
                <td class="position-relative" style="padding: 4px 8px;">
                    <button id="btn-{{ $item->id }}" class="btn btn-sm show-aksi" type="button" style="background: #38A34A;color: white;"><i class="fas fa-bars fa-lg"></i></button>
                </td>
            </tr>
            @endforeach
            {{-- {{ $data->links() }} --}}
            @endisset
        </tbody>
    </table>
</div>
